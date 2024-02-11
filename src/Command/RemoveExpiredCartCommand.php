<?php

namespace App\Command;

use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RemoveExpiredCartCommand extends Command
{

    /**
     * @param EntityManagerInterface $entityManager
     */
    private $entityManager;

    /**
     * @param OrderRepository $name
     */
    private $orderRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface, OrderRepository $orderRepository) 
    {
        parent::__construct();

        $this->entityManager = $entityManagerInterface;
        $this->orderRepository = $orderRepository;
    }
    protected static $defaultName = 'app:remove-expired-carts';
    protected static $defaultDescription = 'Add a short description for your command';

    protected function configure(): void
    {
        $this
            ->setDescription('Remove cart unused 1 day')
            ->addArgument(
                'days',
                InputArgument::OPTIONAL,
                'The number of days a cart can remain inactive',
                1
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $days = $input->getArgument('days');

        if ($days) {
            $io->note(sprintf('You passed an argument: %s', $days));
        }

        // Subtracts the number of days from the current date.
        $limitDate = new \DateTimeImmutable("- $days days");
        $expiredCartsCount = 0;

        while($carts = $this->orderRepository->findCartsNotModifiedSince($limitDate)) {
            foreach ($carts as $cart) {
                // Items will be deleted on cascade
                $this->entityManager->remove($cart);
            }

            $this->entityManager->flush(); // Executes all deletions
            $this->entityManager->clear(); // Detaches all object from Doctrine

            $expiredCartsCount += count($carts);
        };

        if ($expiredCartsCount) {
            $io->success("$expiredCartsCount cart(s) have been deleted.");
        } else {
            $io->info('No expired carts.');
        }

        return Command::SUCCESS;
    }
}
