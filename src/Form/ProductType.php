<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Vendor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProductType extends AbstractType
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => $this->translator->trans('product.label.name', [], 'admin'),
            ])
            ->add('description', TextareaType::class, [
                'label' => $this->translator->trans('product.label.description', [], 'admin'),
            ])
            ->add('stock', NumberType::class, [
                'label' => 'Nombre de stock'
            ])
            ->add('priceTtc', MoneyType::class, [
                'label' => 'Prix (TTC)'
            ])
            ->add('brand', EntityType::class, [
                'label' => 'Marque',
                'class' => Vendor::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Photo de vehicule',
                'required' => false,
                // 'attr' => [
                //     'required' => false
                // ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
