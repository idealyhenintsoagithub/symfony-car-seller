<?php

namespace App\Command;

use App\Entity\Brand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:brand:create',
    description: 'Add a short description for your command',
)]
class BrandCreateCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        $brands = [
            [
                "name" => "9ff",
                "logo" => "9ff.jpg"
            ],
            [
                "name" => "Abadal",
                "logo" => "abadal.jpg"
            ],
            [
                "name" => "Abarth",
                "logo" => "abarth.jpg"
            ],
            [
                "name" => "Abbott-Detroit",
                "logo" => "abbott-detroit.jpg"
            ],
            [
                "name" => "ABT",
                "logo" => "abt.jpg"
            ],
            [
                "name" => "AC",
                "logo" => "ac.jpg"
            ],
            [
                "name" => "Acura",
                "logo" => "acura.jpg"
            ],
            [
                "name" => "Aiways",
                "logo" => "aiways.png"
            ],
            [
                "name" => "Aixam",
                "logo" => "aixam.jpg"
            ],
            [
                "name" => "Alfa Romeo",
                "logo" => "alfa-romeo.jpg"
            ],
            [
                "name" => "Alpina",
                "logo" => "alpina.jpg"
            ],
            [
                "name" => "Alpine",
                "logo" => "alpine.jpg"
            ],
            [
                "name" => "Alta",
                "logo" => "alta.jpg"
            ],
            [
                "name" => "Alvis",
                "logo" => "alvis.jpg"
            ],
            [
                "name" => "AMC",
                "logo" => "amc.jpg"
            ],
            [
                "name" => "Apollo",
                "logo" => "apollo.jpg"
            ],
            [
                "name" => "Arash",
                "logo" => "arash.jpg"
            ],
            [
                "name" => "Arcfox",
                "logo" => "arcfox.png"
            ],
            [
                "name" => "Ariel",
                "logo" => "ariel.jpg"
            ],
            [
                "name" => "ARO",
                "logo" => "aro.jpg"
            ],
            [
                "name" => "Arrinera",
                "logo" => "arrinera.jpg"
            ],
            [
                "name" => "Arrival",
                "logo" => "arrival.png"
            ],
            [
                "name" => "Artega",
                "logo" => "artega.jpg"
            ],
            [
                "name" => "Ascari",
                "logo" => "ascari.jpg"
            ],
            [
                "name" => "Askam",
                "logo" => "askam.jpg"
            ],
            [
                "name" => "Aspark",
                "logo" => "aspark.png"
            ],
            [
                "name" => "Aston Martin",
                "logo" => "aston-martin.jpg"
            ],
            [
                "name" => "Atalanta",
                "logo" => "atalanta.jpg"
            ],
            [
                "name" => "Auburn",
                "logo" => "auburn.png"
            ],
            [
                "name" => "Audi",
                "logo" => "audi.jpg"
            ],
            [
                "name" => "Audi Sport",
                "logo" => "audi-sport.jpg"
            ],
            [
                "name" => "Austin",
                "logo" => "austin.jpg"
            ],
            [
                "name" => "Autobacs",
                "logo" => "autobacs.jpg"
            ],
            [
                "name" => "Autobianchi",
                "logo" => "autobianchi.jpg"
            ],
            [
                "name" => "Axon",
                "logo" => "axon.jpg"
            ],
            [
                "name" => "BAC",
                "logo" => "bac.jpg"
            ],
            [
                "name" => "BAIC Motor",
                "logo" => "baic-motor.jpg"
            ],
            [
                "name" => "Baojun",
                "logo" => "baojun.jpg"
            ],
            [
                "name" => "BeiBen",
                "logo" => "beiben.png"
            ],
            [
                "name" => "Bentley",
                "logo" => "bentley.jpg"
            ],
            [
                "name" => "Berkeley",
                "logo" => "berkeley.png"
            ],
            [
                "name" => "Berliet",
                "logo" => "berliet.jpg"
            ],
            [
                "name" => "Bertone",
                "logo" => "bertone.jpg"
            ],
            [
                "name" => "Bestune",
                "logo" => "bestune.png"
            ],
            [
                "name" => "BharatBenz",
                "logo" => "bharatbenz.jpg"
            ],
            [
                "name" => "Bitter",
                "logo" => "bitter.jpg"
            ],
            [
                "name" => "Bizzarrini",
                "logo" => "bizzarrini.jpg"
            ],
            [
                "name" => "BMW",
                "logo" => "bmw.png"
            ],
            [
                "name" => "BMW M",
                "logo" => "bmw-m.jpg"
            ],
            [
                "name" => "Borgward",
                "logo" => "borgward.jpg"
            ],
            [
                "name" => "Bowler",
                "logo" => "bowler.jpg"
            ],
            [
                "name" => "Brabus",
                "logo" => "brabus.jpg"
            ],
            [
                "name" => "Brammo",
                "logo" => "brammo.jpg"
            ],
            [
                "name" => "Brilliance",
                "logo" => "brilliance.jpg"
            ],
            [
                "name" => "Bristol",
                "logo" => "bristol.png"
            ],
            [
                "name" => "Brooke",
                "logo" => "brooke.jpg"
            ],
            [
                "name" => "Bufori",
                "logo" => "bufori.jpg"
            ],
            [
                "name" => "Bugatti",
                "logo" => "bugatti.jpg"
            ],
            [
                "name" => "Buick",
                "logo" => "buick.jpg"
            ],
            [
                "name" => "BYD",
                "logo" => "byd.jpg"
            ],
            [
                "name" => "Byton",
                "logo" => "byton.png"
            ],
            [
                "name" => "Cadillac",
                "logo" => "cadillac.jpg"
            ],
            [
                "name" => "CAMC",
                "logo" => "camc.png"
            ],
            [
                "name" => "Canoo",
                "logo" => "canoo.png"
            ],
            [
                "name" => "Caparo",
                "logo" => "caparo.jpg"
            ],
            [
                "name" => "Carlsson",
                "logo" => "carlsson.jpg"
            ],
            [
                "name" => "Caterham",
                "logo" => "caterham.jpg"
            ],
            [
                "name" => "Changan",
                "logo" => "changan.jpg"
            ],
            [
                "name" => "Changfeng",
                "logo" => "changfeng.jpg"
            ],
            [
                "name" => "Chery",
                "logo" => "chery.jpg"
            ],
            [
                "name" => "Chevrolet",
                "logo" => "chevrolet.jpg"
            ],
            [
                "name" => "Chevrolet Corvette",
                "logo" => "chevrolet-corvette.jpg"
            ],
            [
                "name" => "Chrysler",
                "logo" => "chrysler.jpg"
            ],
            [
                "name" => "Cisitalia",
                "logo" => "cisitalia.png"
            ],
            [
                "name" => "Citroën",
                "logo" => "citroen.jpg"
            ],
            [
                "name" => "Cizeta",
                "logo" => "cizeta.jpg"
            ],
            [
                "name" => "Cole",
                "logo" => "cole.png"
            ],
            [
                "name" => "Corre La Licorne",
                "logo" => "corre-la-licorne.jpg"
            ],
            [
                "name" => "Dacia",
                "logo" => "dacia.jpg"
            ],
            [
                "name" => "Daewoo",
                "logo" => "daewoo.jpg"
            ],
            [
                "name" => "DAF",
                "logo" => "daf.jpg"
            ],
            [
                "name" => "Daihatsu",
                "logo" => "daihatsu.png"
            ],
            [
                "name" => "Daimler",
                "logo" => "daimler.jpg"
            ],
            [
                "name" => "Dartz",
                "logo" => "dartz.jpg"
            ],
            [
                "name" => "Datsun",
                "logo" => "datsun.jpg"
            ],
            [
                "name" => "David Brown",
                "logo" => "david-brown.jpg"
            ],
            [
                "name" => "Dayun",
                "logo" => "dayun.png"
            ],
            [
                "name" => "De Tomaso",
                "logo" => "de-tomaso.jpg"
            ],
            [
                "name" => "Delage",
                "logo" => "delage.jpg"
            ],
            [
                "name" => "DeSoto",
                "logo" => "desoto.png"
            ],
            [
                "name" => "Detroit Electric",
                "logo" => "detroit-electric.jpg"
            ],
            [
                "name" => "Devel Sixteen",
                "logo" => "devel-sixteen.jpg"
            ],
            [
                "name" => "Diatto",
                "logo" => "diatto.jpg"
            ],
            [
                "name" => "DINA",
                "logo" => "dina.jpg"
            ],
            [
                "name" => "DKW",
                "logo" => "dkw.jpg"
            ],
            [
                "name" => "DMC",
                "logo" => "dmc.jpg"
            ],
            [
                "name" => "Dodge",
                "logo" => "dodge.jpg"
            ],
            [
                "name" => "Dodge Viper",
                "logo" => "dodge-viper.jpg"
            ],
            [
                "name" => "Dongfeng",
                "logo" => "dongfeng.jpg"
            ],
            [
                "name" => "Donkervoort",
                "logo" => "donkervoort.jpg"
            ],
            [
                "name" => "Drako",
                "logo" => "drako.png"
            ],
            [
                "name" => "DS",
                "logo" => "ds.jpg"
            ],
            [
                "name" => "Duesenberg",
                "logo" => "duesenberg.png"
            ],
            [
                "name" => "Eagle",
                "logo" => "eagle.jpg"
            ],
            [
                "name" => "EDAG",
                "logo" => "edag.jpg"
            ],
            [
                "name" => "Edsel",
                "logo" => "edsel.jpg"
            ],
            [
                "name" => "Eicher",
                "logo" => "eicher.jpg"
            ],
            [
                "name" => "Elemental",
                "logo" => "elemental.jpg"
            ],
            [
                "name" => "Elfin",
                "logo" => "elfin.jpg"
            ],
            [
                "name" => "Elva",
                "logo" => "elva.png"
            ],
            [
                "name" => "Englon",
                "logo" => "englon.jpg"
            ],
            [
                "name" => "ERF",
                "logo" => "erf.jpg"
            ],
            [
                "name" => "Eterniti",
                "logo" => "eterniti.jpg"
            ],
            [
                "name" => "Exeed",
                "logo" => "exeed.png"
            ],
            [
                "name" => "Facel Vega",
                "logo" => "facel-vega.jpg"
            ],
            [
                "name" => "Faraday Future",
                "logo" => "faraday-future.jpg"
            ],
            [
                "name" => "FAW",
                "logo" => "faw.jpg"
            ],
            [
                "name" => "FAW Jiefang",
                "logo" => "faw-jiefang.png"
            ],
            [
                "name" => "Ferrari",
                "logo" => "ferrari.png"
            ],
            [
                "name" => "Fiat",
                "logo" => "fiat.jpg"
            ],
            [
                "name" => "Fioravanti",
                "logo" => "fioravanti.jpg"
            ],
            [
                "name" => "Fisker",
                "logo" => "fisker.jpg"
            ],
            [
                "name" => "Foden",
                "logo" => "foden.png"
            ],
            [
                "name" => "Force Motors",
                "logo" => "force-motors.jpg"
            ],
            [
                "name" => "Ford",
                "logo" => "ford.png"
            ],
            [
                "name" => "Ford Mustang",
                "logo" => "ford-mustang.jpg"
            ],
            [
                "name" => "Foton",
                "logo" => "foton.jpg"
            ],
            [
                "name" => "FPV",
                "logo" => "fpv.jpg"
            ],
            [
                "name" => "Franklin",
                "logo" => "franklin.jpg"
            ],
            [
                "name" => "Freightliner",
                "logo" => "freightliner.jpg"
            ],
            [
                "name" => "FSO",
                "logo" => "fso.png"
            ],
            [
                "name" => "GAC Group",
                "logo" => "gac-group.jpg"
            ],
            [
                "name" => "Gardner Douglas",
                "logo" => "gardner-douglas.jpg"
            ],
            [
                "name" => "GAZ",
                "logo" => "gaz.jpg"
            ],
            [
                "name" => "Geely",
                "logo" => "geely.jpg"
            ],
            [
                "name" => "General Motors",
                "logo" => "general-motors.png"
            ],
            [
                "name" => "Genesis",
                "logo" => "genesis.jpg"
            ],
            [
                "name" => "Geo",
                "logo" => "geo.jpg"
            ],
            [
                "name" => "Geometry",
                "logo" => "geometry.png"
            ],
            [
                "name" => "Gilbern",
                "logo" => "gilbern.png"
            ],
            [
                "name" => "Gillet",
                "logo" => "gillet.png"
            ],
            [
                "name" => "Ginetta",
                "logo" => "ginetta.jpg"
            ],
            [
                "name" => "GMC",
                "logo" => "gmc.jpg"
            ],
            [
                "name" => "Golden Dragon",
                "logo" => "golden-dragon.png"
            ],
            [
                "name" => "Gonow",
                "logo" => "gonow.jpg"
            ],
            [
                "name" => "Great Wall",
                "logo" => "great-wall.jpg"
            ],
            [
                "name" => "Grinnall",
                "logo" => "grinnall.jpg"
            ],
            [
                "name" => "Gumpert",
                "logo" => "gumpert.jpg"
            ],
            [
                "name" => "Hafei",
                "logo" => "hafei.jpg"
            ],
            [
                "name" => "Haima",
                "logo" => "haima.jpg"
            ],
            [
                "name" => "Haval",
                "logo" => "haval.jpg"
            ],
            [
                "name" => "Hawtai",
                "logo" => "hawtai.jpg"
            ],
            [
                "name" => "Hennessey",
                "logo" => "hennessey.png"
            ],
            [
                "name" => "Higer",
                "logo" => "higer.png"
            ],
            [
                "name" => "Hillman",
                "logo" => "hillman.jpg"
            ],
            [
                "name" => "Hindustan Motors",
                "logo" => "hindustan-motors.jpg"
            ],
            [
                "name" => "Hino",
                "logo" => "hino.jpg"
            ],
            [
                "name" => "HiPhi",
                "logo" => "hiphi.png"
            ],
            [
                "name" => "Hispano-Suiza",
                "logo" => "hispano-suiza.jpg"
            ],
            [
                "name" => "Holden",
                "logo" => "holden.jpg"
            ],
            [
                "name" => "Hommell",
                "logo" => "hommell.jpg"
            ],
            [
                "name" => "Honda",
                "logo" => "honda.png"
            ],
            [
                "name" => "Hongqi",
                "logo" => "hongqi.png"
            ],
            [
                "name" => "Hongyan",
                "logo" => "hongyan.png"
            ],
            [
                "name" => "Horch",
                "logo" => "horch.jpg"
            ],
            [
                "name" => "HSV",
                "logo" => "hsv.jpg"
            ],
            [
                "name" => "Hudson",
                "logo" => "hudson.jpg"
            ],
            [
                "name" => "Hummer",
                "logo" => "hummer.png"
            ],
            [
                "name" => "Hupmobile",
                "logo" => "hupmobile.jpg"
            ],
            [
                "name" => "Hyundai",
                "logo" => "hyundai.jpg"
            ],
            [
                "name" => "IC Bus",
                "logo" => "ic-bus.jpg"
            ],
            [
                "name" => "IH",
                "logo" => "ih.jpg"
            ],
            [
                "name" => "IKCO",
                "logo" => "ikco.jpg"
            ],
            [
                "name" => "Infiniti",
                "logo" => "infiniti.jpg"
            ],
            [
                "name" => "Innocenti",
                "logo" => "innocenti.png"
            ],
            [
                "name" => "Intermeccanica",
                "logo" => "intermeccanica.png"
            ],
            [
                "name" => "International",
                "logo" => "international.jpg"
            ],
            [
                "name" => "Irizar",
                "logo" => "irizar.jpg"
            ],
            [
                "name" => "Isdera",
                "logo" => "isdera.jpg"
            ],
            [
                "name" => "Iso",
                "logo" => "iso.jpg"
            ],
            [
                "name" => "Isuzu",
                "logo" => "isuzu.jpg"
            ],
            [
                "name" => "Iveco",
                "logo" => "iveco.jpg"
            ],
            [
                "name" => "JAC",
                "logo" => "jac.jpg"
            ],
            [
                "name" => "Jaguar",
                "logo" => "jaguar.jpg"
            ],
            [
                "name" => "Jawa",
                "logo" => "jawa.jpg"
            ],
            [
                "name" => "JBA Motors",
                "logo" => "jba-motors.jpg"
            ],
            [
                "name" => "Jeep",
                "logo" => "jeep.jpg"
            ],
            [
                "name" => "Jensen",
                "logo" => "jensen.jpg"
            ],
            [
                "name" => "Jetta",
                "logo" => "jetta.png"
            ],
            [
                "name" => "JMC",
                "logo" => "jmc.jpg"
            ],
            [
                "name" => "Kaiser",
                "logo" => "kaiser.jpg"
            ],
            [
                "name" => "Kamaz",
                "logo" => "kamaz.jpg"
            ],
            [
                "name" => "Karlmann King",
                "logo" => "karlmann-king.png"
            ],
            [
                "name" => "Karma",
                "logo" => "karma.jpg"
            ],
            [
                "name" => "Keating",
                "logo" => "keating.jpg"
            ],
            [
                "name" => "Kenworth",
                "logo" => "kenworth.jpg"
            ],
            [
                "name" => "Kia",
                "logo" => "kia.jpg"
            ],
            [
                "name" => "King Long",
                "logo" => "king-long.png"
            ],
            [
                "name" => "Koenigsegg",
                "logo" => "koenigsegg.jpg"
            ],
            [
                "name" => "KTM",
                "logo" => "ktm.jpg"
            ],
            [
                "name" => "Lada",
                "logo" => "lada.jpg"
            ],
            [
                "name" => "Lagonda",
                "logo" => "lagonda.jpg"
            ],
            [
                "name" => "Lamborghini",
                "logo" => "lamborghini.png"
            ],
            [
                "name" => "Lancia",
                "logo" => "lancia.jpg"
            ],
            [
                "name" => "Land Rover",
                "logo" => "land-rover.jpg"
            ],
            [
                "name" => "Landwind",
                "logo" => "landwind.jpg"
            ],
            [
                "name" => "Laraki",
                "logo" => "laraki.jpg"
            ],
            [
                "name" => "Leapmotor",
                "logo" => "leapmotor.png"
            ],
            [
                "name" => "LEVC",
                "logo" => "levc.jpg"
            ],
            [
                "name" => "Lexus",
                "logo" => "lexus.jpg"
            ],
            [
                "name" => "Leyland",
                "logo" => "leyland.jpg"
            ],
            [
                "name" => "Li Auto",
                "logo" => "li-auto.png"
            ],
            [
                "name" => "Lifan",
                "logo" => "lifan.jpg"
            ],
            [
                "name" => "Ligier",
                "logo" => "ligier.jpg"
            ],
            [
                "name" => "Lincoln",
                "logo" => "lincoln.jpg"
            ],
            [
                "name" => "Lister",
                "logo" => "lister.jpg"
            ],
            [
                "name" => "Lloyd",
                "logo" => "lloyd.jpg"
            ],
            [
                "name" => "Lobini",
                "logo" => "lobini.jpg"
            ],
            [
                "name" => "Lordstown",
                "logo" => "lordstown.png"
            ],
            [
                "name" => "Lotus",
                "logo" => "lotus.jpg"
            ],
            [
                "name" => "Lucid",
                "logo" => "lucid.jpg"
            ],
            [
                "name" => "Luxgen",
                "logo" => "luxgen.jpg"
            ],
            [
                "name" => "Lynk & Co",
                "logo" => "lynk-and-co.png"
            ],
            [
                "name" => "Mack",
                "logo" => "mack.jpg"
            ],
            [
                "name" => "Mahindra",
                "logo" => "mahindra.jpg"
            ],
            [
                "name" => "MAN",
                "logo" => "man.jpg"
            ],
            [
                "name" => "Mansory",
                "logo" => "mansory.jpg"
            ],
            [
                "name" => "Marcos",
                "logo" => "marcos.jpg"
            ],
            [
                "name" => "Marlin",
                "logo" => "marlin.jpg"
            ],
            [
                "name" => "Maserati",
                "logo" => "maserati.jpg"
            ],
            [
                "name" => "Mastretta",
                "logo" => "mastretta.jpg"
            ],
            [
                "name" => "Maxus",
                "logo" => "maxus.jpg"
            ],
            [
                "name" => "Maybach",
                "logo" => "maybach.jpg"
            ],
            [
                "name" => "MAZ",
                "logo" => "maz.jpg"
            ],
            [
                "name" => "Mazda",
                "logo" => "mazda.jpg"
            ],
            [
                "name" => "Mazzanti",
                "logo" => "mazzanti.jpg"
            ],
            [
                "name" => "McLaren",
                "logo" => "mclaren.jpg"
            ],
            [
                "name" => "Melkus",
                "logo" => "melkus.jpg"
            ],
            [
                "name" => "Mercedes-AMG",
                "logo" => "mercedes-amg.jpg"
            ],
            [
                "name" => "Mercedes-Benz",
                "logo" => "mercedes-benz.jpg"
            ],
            [
                "name" => "Mercury",
                "logo" => "mercury.jpg"
            ],
            [
                "name" => "Merkur",
                "logo" => "merkur.jpg"
            ],
            [
                "name" => "MEV",
                "logo" => "mev.jpg"
            ],
            [
                "name" => "MG",
                "logo" => "mg.jpg"
            ],
            [
                "name" => "Microcar",
                "logo" => "microcar.jpg"
            ],
            [
                "name" => "Mini",
                "logo" => "mini.jpg"
            ],
            [
                "name" => "Mitsubishi",
                "logo" => "mitsubishi.jpg"
            ],
            [
                "name" => "Mitsuoka",
                "logo" => "mitsuoka.jpg"
            ],
            [
                "name" => "MK",
                "logo" => "mk.png"
            ],
            [
                "name" => "Morgan",
                "logo" => "morgan.jpg"
            ],
            [
                "name" => "Morris",
                "logo" => "morris.jpg"
            ],
            [
                "name" => "Mosler",
                "logo" => "mosler.png"
            ],
            [
                "name" => "Navistar",
                "logo" => "navistar.jpg"
            ],
            [
                "name" => "NEVS",
                "logo" => "nevs.png"
            ],
            [
                "name" => "Nikola",
                "logo" => "nikola.png"
            ],
            [
                "name" => "NIO",
                "logo" => "nio.png"
            ],
            [
                "name" => "Nissan",
                "logo" => "nissan.png"
            ],
            [
                "name" => "Nissan GT-R",
                "logo" => "nissan-gt-r.jpg"
            ],
            [
                "name" => "Nissan Nismo",
                "logo" => "nissan-nismo.jpg"
            ],
            [
                "name" => "Noble",
                "logo" => "noble.jpg"
            ],
            [
                "name" => "Oldsmobile",
                "logo" => "oldsmobile.jpg"
            ],
            [
                "name" => "Oltcit",
                "logo" => "oltcit.png"
            ],
            [
                "name" => "Opel",
                "logo" => "opel.jpg"
            ],
            [
                "name" => "OSCA",
                "logo" => "osca.png"
            ],
            [
                "name" => "Paccar",
                "logo" => "paccar.jpg"
            ],
            [
                "name" => "Packard",
                "logo" => "packard.png"
            ],
            [
                "name" => "Pagani",
                "logo" => "pagani.jpg"
            ],
            [
                "name" => "Panhard",
                "logo" => "panhard.png"
            ],
            [
                "name" => "Panoz",
                "logo" => "panoz.jpg"
            ],
            [
                "name" => "Pegaso",
                "logo" => "pegaso.jpg"
            ],
            [
                "name" => "Perodua",
                "logo" => "perodua.jpg"
            ],
            [
                "name" => "Peterbilt",
                "logo" => "peterbilt.jpg"
            ],
            [
                "name" => "Peugeot",
                "logo" => "peugeot.jpg"
            ],
            [
                "name" => "PGO",
                "logo" => "pgo.jpg"
            ],
            [
                "name" => "Pierce-Arrow",
                "logo" => "pierce-arrow.jpg"
            ],
            [
                "name" => "Pininfarina",
                "logo" => "pininfarina.jpg"
            ],
            [
                "name" => "Plymouth",
                "logo" => "plymouth.jpg"
            ],
            [
                "name" => "Polestar",
                "logo" => "polestar.jpg"
            ],
            [
                "name" => "Pontiac",
                "logo" => "pontiac.jpg"
            ],
            [
                "name" => "Porsche",
                "logo" => "porsche.png"
            ],
            [
                "name" => "Praga",
                "logo" => "praga.jpg"
            ],
            [
                "name" => "Premier",
                "logo" => "premier.jpg"
            ],
            [
                "name" => "Prodrive",
                "logo" => "prodrive.jpg"
            ],
            [
                "name" => "Proton",
                "logo" => "proton.jpg"
            ],
            [
                "name" => "Qoros",
                "logo" => "qoros.jpg"
            ],
            [
                "name" => "Radical",
                "logo" => "radical.jpg"
            ],
            [
                "name" => "RAM",
                "logo" => "ram.jpg"
            ],
            [
                "name" => "Rambler",
                "logo" => "rambler.jpg"
            ],
            [
                "name" => "Ranz",
                "logo" => "ranz.jpg"
            ],
            [
                "name" => "Renault",
                "logo" => "renault.jpg"
            ],
            [
                "name" => "Renault Samsung",
                "logo" => "renault-samsung.jpg"
            ],
            [
                "name" => "Rezvani",
                "logo" => "rezvani.jpg"
            ],
            [
                "name" => "Riley",
                "logo" => "riley.png"
            ],
            [
                "name" => "Rimac",
                "logo" => "rimac.jpg"
            ],
            [
                "name" => "Rinspeed",
                "logo" => "rinspeed.jpg"
            ],
            [
                "name" => "Rivian",
                "logo" => "rivian.png"
            ],
            [
                "name" => "Roewe",
                "logo" => "roewe.jpg"
            ],
            [
                "name" => "Rolls-Royce",
                "logo" => "rolls-royce.jpg"
            ],
            [
                "name" => "Ronart",
                "logo" => "ronart.jpg"
            ],
            [
                "name" => "Rossion",
                "logo" => "rossion.jpg"
            ],
            [
                "name" => "Rover",
                "logo" => "rover.jpg"
            ],
            [
                "name" => "RUF",
                "logo" => "ruf.jpg"
            ],
            [
                "name" => "Saab",
                "logo" => "saab.jpg"
            ],
            [
                "name" => "SAIC Motor",
                "logo" => "saic-motor.jpg"
            ],
            [
                "name" => "Saipa",
                "logo" => "saipa.jpg"
            ],
            [
                "name" => "Saleen",
                "logo" => "saleen.jpg"
            ],
            [
                "name" => "Saturn",
                "logo" => "saturn.jpg"
            ],
            [
                "name" => "Scania",
                "logo" => "scania.jpg"
            ],
            [
                "name" => "Scion",
                "logo" => "scion.jpg"
            ],
            [
                "name" => "SEAT",
                "logo" => "seat.jpg"
            ],
            [
                "name" => "Setra",
                "logo" => "setra.jpg"
            ],
            [
                "name" => "Shacman",
                "logo" => "shacman.png"
            ],
            [
                "name" => "Simca",
                "logo" => "simca.jpg"
            ],
            [
                "name" => "Singer",
                "logo" => "singer.png"
            ],
            [
                "name" => "Singulato",
                "logo" => "singulato.png"
            ],
            [
                "name" => "Sinotruk",
                "logo" => "sinotruk.png"
            ],
            [
                "name" => "Sisu",
                "logo" => "sisu.jpg"
            ],
            [
                "name" => "Škoda",
                "logo" => "skoda.jpg"
            ],
            [
                "name" => "Smart",
                "logo" => "smart.jpg"
            ],
            [
                "name" => "Soueast",
                "logo" => "soueast.jpg"
            ],
            [
                "name" => "Spania GTA",
                "logo" => "spania-gta.jpg"
            ],
            [
                "name" => "Spirra",
                "logo" => "spirra.jpg"
            ],
            [
                "name" => "Spyker",
                "logo" => "spyker.jpg"
            ],
            [
                "name" => "SsangYong",
                "logo" => "ssangyong.jpg"
            ],
            [
                "name" => "SSC",
                "logo" => "ssc.jpg"
            ],
            [
                "name" => "Sterling",
                "logo" => "sterling.jpg"
            ],
            [
                "name" => "Studebaker",
                "logo" => "studebaker.jpg"
            ],
            [
                "name" => "Stutz",
                "logo" => "stutz.png"
            ],
            [
                "name" => "Subaru",
                "logo" => "subaru.jpg"
            ],
            [
                "name" => "Suffolk",
                "logo" => "suffolk.jpg"
            ],
            [
                "name" => "Suzuki",
                "logo" => "suzuki.jpg"
            ],
            [
                "name" => "Talbot",
                "logo" => "talbot.jpg"
            ],
            [
                "name" => "Tata",
                "logo" => "tata.jpg"
            ],
            [
                "name" => "Tatra",
                "logo" => "tatra.jpg"
            ],
            [
                "name" => "Tauro",
                "logo" => "tauro.jpg"
            ],
            [
                "name" => "TechArt",
                "logo" => "techart.jpg"
            ],
            [
                "name" => "Tesla",
                "logo" => "tesla.png"
            ],
            [
                "name" => "Toyota",
                "logo" => "toyota.png"
            ],
            [
                "name" => "Toyota Alphard",
                "logo" => "toyota-alphard.png"
            ],
            [
                "name" => "Toyota Century",
                "logo" => "toyota-century.png"
            ],
            [
                "name" => "Toyota Crown",
                "logo" => "toyota-crown.jpg"
            ],
            [
                "name" => "Tramontana",
                "logo" => "tramontana.jpg"
            ],
            [
                "name" => "Trion",
                "logo" => "trion.jpg"
            ],
            [
                "name" => "Triumph",
                "logo" => "triumph.jpg"
            ],
            [
                "name" => "Troller",
                "logo" => "troller.jpg"
            ],
            [
                "name" => "Tucker",
                "logo" => "tucker.png"
            ],
            [
                "name" => "TVR",
                "logo" => "tvr.jpg"
            ],
            [
                "name" => "UAZ",
                "logo" => "uaz.jpg"
            ],
            [
                "name" => "UD",
                "logo" => "ud.jpg"
            ],
            [
                "name" => "Ultima",
                "logo" => "ultima.jpg"
            ],
            [
                "name" => "Vandenbrink",
                "logo" => "vandenbrink.jpg"
            ],
            [
                "name" => "Vauxhall",
                "logo" => "vauxhall.jpg"
            ],
            [
                "name" => "Vector",
                "logo" => "vector.jpg"
            ],
            [
                "name" => "Vencer",
                "logo" => "vencer.jpg"
            ],
            [
                "name" => "Venturi",
                "logo" => "venturi.png"
            ],
            [
                "name" => "Venucia",
                "logo" => "venucia.jpg"
            ],
            [
                "name" => "VinFast",
                "logo" => "vinfast.png"
            ],
            [
                "name" => "VLF",
                "logo" => "vlf.png"
            ],
            [
                "name" => "Volkswagen",
                "logo" => "volkswagen.jpg"
            ],
            [
                "name" => "Volvo",
                "logo" => "volvo.jpg"
            ],
            [
                "name" => "W Motors",
                "logo" => "w-motors.jpg"
            ],
            [
                "name" => "Wanderer",
                "logo" => "wanderer.jpg"
            ],
            [
                "name" => "Wartburg",
                "logo" => "wartburg.jpg"
            ],
            [
                "name" => "Weltmeister",
                "logo" => "weltmeister.png"
            ],
            [
                "name" => "Western Star",
                "logo" => "western-star.jpg"
            ],
            [
                "name" => "Westfield",
                "logo" => "westfield.jpg"
            ],
            [
                "name" => "WEY",
                "logo" => "wey.png"
            ],
            [
                "name" => "Wiesmann",
                "logo" => "wiesmann.jpg"
            ],
            [
                "name" => "Willys-Overland",
                "logo" => "willys-overland.jpg"
            ],
            [
                "name" => "Workhorse",
                "logo" => "workhorse.png"
            ],
            [
                "name" => "Wuling",
                "logo" => "wuling.jpg"
            ],
            [
                "name" => "XPeng",
                "logo" => "xpeng.png"
            ],
            [
                "name" => "Yulon",
                "logo" => "yulon.jpg"
            ],
            [
                "name" => "Yutong",
                "logo" => "yutong.png"
            ],
            [
                "name" => "Zarooq Motors",
                "logo" => "zarooq-motors.jpg"
            ],
            [
                "name" => "Zastava",
                "logo" => "zastava.jpg"
            ],
            [
                "name" => "ZAZ",
                "logo" => "zaz.jpg"
            ],
            [
                "name" => "Zeekr",
                "logo" => "zeekr.png"
            ],
            [
                "name" => "Zenos",
                "logo" => "zenos.jpg"
            ],
            [
                "name" => "Zenvo",
                "logo" => "zenvo.jpg"
            ],
            [
                "name" => "Zhongtong",
                "logo" => "zhongtong.png"
            ],
            [
                "name" => "Zinoro",
                "logo" => "zinoro.png"
            ],
            [
                "name" => "Zotye",
                "logo" => "zotye.jpg"
            ]
        ];

        foreach ($brands as $brand) {
            $newBrand = new Brand();
            $newBrand->setName($brand['name']);
            $newBrand->setLogo($brand['logo']);
            $this->em->persist($newBrand);
        }

        $this->em->flush();
        $io->success(sprintf('%s brans created', count($brands)));

        return Command::SUCCESS;
    }
}
