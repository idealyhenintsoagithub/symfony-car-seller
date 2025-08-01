<?php

namespace App\Command;

use App\Entity\Product;
use App\Repository\BrandRepository;
use App\Repository\VendorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create:products',
    description: 'Add a short description for your command',
)]
class CreateProductsCommand extends Command
{
    const PRODUCTS = [
        [
            "title" => "Mercedes-Benz",
            "gender" => "Citan",
            "type" => "van",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
            "priceTtc" => 10000,
            "brand" => "Mercedes-benz",
            "image" => "image.png",
            "vendor" => "Mercedes-benz",
        ],
        [
            "title" => "Lexus",
            "gender" => "GX",
            "type" => "4WD",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
            "priceTtc" => 50000,
            "brand" => "Lexus",
            "image" => "image.png",
            "vendor" => "Lexus",
        ],
        [
            "title" => "Toyota",
            "gender" => "RAV4",
            "type" => "crossover",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
            "priceTtc" => 15000,
            "brand" => "Toyota",
            "image" => "image.png",
            "vendor" => "Toyota",
        ],
        [
            "title" => "Hyundai",
            "gender" => "Grand i10 Nios",
            "type" => "hatchback",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
            "brand" => "Hyundai",
            "image" => "image.png",
            "priceTtc" => 43600,
            "vendor" => "hyundai_i10.webp",
        ],
        [
            "title" => "Honda",
            "gender" => "Civic",
            "type" => "sedan",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
            "priceTtc" => 25000,
            "brand" => "Honda",
            "image" => "image.png",
            "vendor" => "Honda",
        ],
        [
            "title" => "peugeot 106",
            "gender" => "plaisir",
            "type" => "sedan",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
            "priceTtc" => 25300,
            "brand" => "Peugeot",
            "image" => "image.png",
            "vendor" => "Peugeot",
        ],
        [
            "title" => "peugeot 206",
            "gender" => "plaisir",
            "type" => "sedan",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
            "priceTtc" => 35300,
            "brand" => "Peugeot",
            "image" => "image.png",
            "vendor" => "Peugeot",
        ],
        [
            "title" => "Hyundai elantra",
            "gender" => "plaisir",
            "type" => "sedan",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
            "priceTtc" => 105300,
            "brand" => "Hyundai",
            "image" => "image.png",
            "vendor" => "Hyundai",
        ],
        [
            "title" => "peugeot 306",
            "gender" => "plaisir",
            "type" => "sedan",
            "description" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos officiis delectus nostrum, excepturi",
            "priceTtc" => 30300,
            "brand" => "Peugeot",
            "image" => "image.png",
            "vendor" => "Peugeot",
        ],
        [ 
            "title" => "Toyota Camry", 
            "gender" => "unisex", 
            "type" => "sedan", 
            "description" => "A reliable and fuel-efficient midsize sedan ideal for families and city driving.", 
            "priceTtc" => "32000", 
            "brand" => "Toyota", 
            "image" => "image.png", 
            "vendor" => "Toyota Motor Corporation", 
        ],
        [ 
            "title" => "Ford Mustang", 
            "gender" => "unisex", 
            "type" => "sports car", 
            "description" => "An iconic American muscle car known for its powerful performance and bold design.", 
            "priceTtc" => "45000", 
            "brand" => "Ford", 
            "image" => "image.png", 
            "vendor" => "Ford Motor Company", 
        ],
        [ 
            "title" => "Tesla Model 3", 
            "gender" => "unisex", 
            "type" => "electric sedan", 
            "description" => "A high-tech electric car offering impressive range, minimal design, and autopilot features.", 
            "priceTtc" => "39000", 
            "brand" => "Tesla", 
            "image" => "image.png", 
            "vendor" => "Tesla Inc.", 
        ],
        [ 
            "title" => "BMW X5", 
            "gender" => "unisex", 
            "type" => "SUV", 
            "description" => "A luxury SUV combining comfort, performance, and cutting-edge technology.", 
            "priceTtc" => "65000", 
            "brand" => "BMW", 
            "image" => "image.png", 
            "vendor" => "BMW AG", 
        ],
        [ 
            "title" => "Honda Civic", 
            "gender" => "unisex", 
            "type" => "compact sedan", 
            "description" => "A compact car with a reputation for reliability, efficiency, and affordability.", 
            "priceTtc" => "25000", 
            "brand" => "Honda", 
            "image" => "image.png", 
            "vendor" => "Honda Motor Co., Ltd.", 
        ],
        [ 
            "title" => "Audi Q7", 
            "gender" => "unisex", 
            "type" => "luxury SUV", 
            "description" => "A premium SUV with a spacious interior and advanced driver-assistance systems.", 
            "priceTtc" => "72000", 
            "brand" => "Audi", 
            "image" => "image.png", 
            "vendor" => "Audi AG", 
        ],
        [ 
            "title" => "Chevrolet Silverado", 
            "gender" => "unisex", 
            "type" => "pickup truck", 
            "description" => "A durable and capable pickup truck designed for heavy-duty tasks and hauling.", 
            "priceTtc" => "48000", 
            "brand" => "Chevrolet", 
            "image" => "image.png", 
            "vendor" => "General Motors", 
        ],
        [ 
            "title" => "Hyundai Tucson", 
            "gender" => "unisex", 
            "type" => "compact SUV", 
            "description" => "A stylish and practical SUV with modern features and a smooth ride.", 
            "priceTtc" => "31000", 
            "brand" => "Hyundai", 
            "image" => "image.png", 
            "vendor" => "Hyundai Motor Company", 
        ],
        [ 
            "title" => "Mercedes-Benz C-Class", 
            "gender" => "unisex", 
            "type" => "luxury sedan", 
            "description" => "An elegant and high-performance sedan combining luxury and innovation.", 
            "priceTtc" => "60000", 
            "brand" => "Mercedes-Benz", 
            "image" => "image.png", 
            "vendor" => "Mercedes-Benz Group AG", 
        ],
        [ 
            "title" => "Nissan Leaf", 
            "gender" => "unisex", 
            "type" => "electric hatchback", 
            "description" => "An affordable electric car with zero emissions and everyday practicality.", 
            "priceTtc" => "29000", 
            "brand" => "Nissan", 
            "image" => "image.png", 
            "vendor" => "Nissan Motor Co., Ltd.", 
        ],
        [
            "title" => "Lexus Model-149",
            "gender" => "unisex",
            "type" => "compact SUV",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "53021",
            "brand" => "Lexus",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Ford Model-805",
            "gender" => "unisex",
            "type" => "minivan",
            "description" => "A compact car ideal for small families.",
            "priceTtc" => "72636",
            "brand" => "Ford",
            "image" => "image.png",
            "vendor" => "Ford Motor Company"
        ],
        [
            "title" => "Chevrolet Model-245",
            "gender" => "unisex",
            "type" => "hatchback",
            "description" => "A performance-driven car with a sleek design.",
            "priceTtc" => "68197",
            "brand" => "Chevrolet",
            "image" => "image.png",
            "vendor" => "General Motors"
        ],
        [
            "title" => "Chevrolet Model-417",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "66815",
            "brand" => "Chevrolet",
            "image" => "image.png",
            "vendor" => "General Motors"
        ],
        [
            "title" => "Jeep Model-836",
            "gender" => "unisex",
            "type" => "sedan",
            "description" => "A sporty model designed for speed enthusiasts.",
            "priceTtc" => "25204",
            "brand" => "Jeep",
            "image" => "image.png",
            "vendor" => "Stellantis"
        ],
        [
            "title" => "Lexus Model-553",
            "gender" => "unisex",
            "type" => "pickup truck",
            "description" => "A compact car ideal for small families.",
            "priceTtc" => "86568",
            "brand" => "Lexus",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Honda Model-328",
            "gender" => "unisex",
            "type" => "pickup truck",
            "description" => "A stylish and modern vehicle with advanced tech.",
            "priceTtc" => "74840",
            "brand" => "Honda",
            "image" => "image.png",
            "vendor" => "Honda Motor Co., Ltd."
        ],
        [
            "title" => "Mercedes-Benz Model-467",
            "gender" => "unisex",
            "type" => "compact SUV",
            "description" => "A luxurious vehicle offering comfort and performance.",
            "priceTtc" => "23991",
            "brand" => "Mercedes-Benz",
            "image" => "image.png",
            "vendor" => "Mercedes-Benz Group AG"
        ],
        [
            "title" => "Hyundai Model-856",
            "gender" => "unisex",
            "type" => "coupe",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "26020",
            "brand" => "Hyundai",
            "image" => "image.png",
            "vendor" => "Hyundai Motor Company"
        ],
        [
            "title" => "Toyota Model-226",
            "gender" => "unisex",
            "type" => "minivan",
            "description" => "A performance-driven car with a sleek design.",
            "priceTtc" => "70742",
            "brand" => "Toyota",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Volkswagen Model-231",
            "gender" => "unisex",
            "type" => "compact SUV",
            "description" => "A stylish and modern vehicle with advanced tech.",
            "priceTtc" => "53409",
            "brand" => "Volkswagen",
            "image" => "image.png",
            "vendor" => "Volkswagen AG"
        ],
        [
            "title" => "Volkswagen Model-481",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A compact car ideal for small families.",
            "priceTtc" => "47975",
            "brand" => "Volkswagen",
            "image" => "image.png",
            "vendor" => "Volkswagen AG"
        ],
        [
            "title" => "Subaru Model-574",
            "gender" => "unisex",
            "type" => "hatchback",
            "description" => "A rugged vehicle built for off-road adventures.",
            "priceTtc" => "50538",
            "brand" => "Subaru",
            "image" => "image.png",
            "vendor" => "Subaru Corporation"
        ],
        [
            "title" => "Toyota Model-524",
            "gender" => "unisex",
            "type" => "luxury SUV",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "40278",
            "brand" => "Toyota",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Nissan Model-143",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A stylish and modern vehicle with advanced tech.",
            "priceTtc" => "83060",
            "brand" => "Nissan",
            "image" => "image.png",
            "vendor" => "Nissan Motor Co., Ltd."
        ],
        [
            "title" => "Lexus Model-852",
            "gender" => "unisex",
            "type" => "compact SUV",
            "description" => "A reliable and efficient car suitable for city driving.",
            "priceTtc" => "89343",
            "brand" => "Lexus",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Nissan Model-535",
            "gender" => "unisex",
            "type" => "coupe",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "61585",
            "brand" => "Nissan",
            "image" => "image.png",
            "vendor" => "Nissan Motor Co., Ltd."
        ],
        [
            "title" => "Volkswagen Model-219",
            "gender" => "unisex",
            "type" => "compact SUV",
            "description" => "An electric car known for its technology and range.",
            "priceTtc" => "73721",
            "brand" => "Volkswagen",
            "image" => "image.png",
            "vendor" => "Volkswagen AG"
        ],
        [
            "title" => "Renault Model-696",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "32151",
            "brand" => "Renault",
            "image" => "image.png",
            "vendor" => "Renault Group"
        ],
        [
            "title" => "Volkswagen Model-986",
            "gender" => "unisex",
            "type" => "pickup truck",
            "description" => "An electric car known for its technology and range.",
            "priceTtc" => "60696",
            "brand" => "Volkswagen",
            "image" => "image.png",
            "vendor" => "Volkswagen AG"
        ],
        [
            "title" => "Ford Model-612",
            "gender" => "unisex",
            "type" => "minivan",
            "description" => "An electric car known for its technology and range.",
            "priceTtc" => "32711",
            "brand" => "Ford",
            "image" => "image.png",
            "vendor" => "Ford Motor Company"
        ],
        [
            "title" => "Tesla Model-239",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "87485",
            "brand" => "Tesla",
            "image" => "image.png",
            "vendor" => "Tesla Inc."
        ],
        [
            "title" => "Lexus Model-318",
            "gender" => "unisex",
            "type" => "minivan",
            "description" => "A luxurious vehicle offering comfort and performance.",
            "priceTtc" => "22853",
            "brand" => "Lexus",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Lexus Model-392",
            "gender" => "unisex",
            "type" => "luxury SUV",
            "description" => "A sporty model designed for speed enthusiasts.",
            "priceTtc" => "48341",
            "brand" => "Lexus",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Ford Model-263",
            "gender" => "unisex",
            "type" => "pickup truck",
            "description" => "A performance-driven car with a sleek design.",
            "priceTtc" => "65942",
            "brand" => "Ford",
            "image" => "image.png",
            "vendor" => "Ford Motor Company"
        ],
        [
            "title" => "Kia Model-770",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "52026",
            "brand" => "Kia",
            "image" => "image.png",
            "vendor" => "Kia Corporation"
        ],
        [
            "title" => "Volvo Model-940",
            "gender" => "unisex",
            "type" => "luxury SUV",
            "description" => "A performance-driven car with a sleek design.",
            "priceTtc" => "65207",
            "brand" => "Volvo",
            "image" => "image.png",
            "vendor" => "Volvo Cars"
        ],
        [
            "title" => "Nissan Model-753",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A performance-driven car with a sleek design.",
            "priceTtc" => "43059",
            "brand" => "Nissan",
            "image" => "image.png",
            "vendor" => "Nissan Motor Co., Ltd."
        ],
        [
            "title" => "Jeep Model-799",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "An electric car known for its technology and range.",
            "priceTtc" => "49684",
            "brand" => "Jeep",
            "image" => "image.png",
            "vendor" => "Stellantis"
        ],
        [
            "title" => "Porsche Model-374",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A luxurious vehicle offering comfort and performance.",
            "priceTtc" => "64103",
            "brand" => "Porsche",
            "image" => "image.png",
            "vendor" => "Porsche AG"
        ],
        [
            "title" => "Honda Model-299",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A sporty model designed for speed enthusiasts.",
            "priceTtc" => "82814",
            "brand" => "Honda",
            "image" => "image.png",
            "vendor" => "Honda Motor Co., Ltd."
        ],
        [
            "title" => "Kia Model-486",
            "gender" => "unisex",
            "type" => "minivan",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "36308",
            "brand" => "Kia",
            "image" => "image.png",
            "vendor" => "Kia Corporation"
        ],
        [
            "title" => "BMW Model-461",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "A stylish and modern vehicle with advanced tech.",
            "priceTtc" => "47102",
            "brand" => "BMW",
            "image" => "image.png",
            "vendor" => "BMW AG"
        ],
        [
            "title" => "Jeep Model-488",
            "gender" => "unisex",
            "type" => "hatchback",
            "description" => "A rugged vehicle built for off-road adventures.",
            "priceTtc" => "37895",
            "brand" => "Jeep",
            "image" => "image.png",
            "vendor" => "Stellantis"
        ],
        [
            "title" => "Subaru Model-607",
            "gender" => "unisex",
            "type" => "pickup truck",
            "description" => "A stylish and modern vehicle with advanced tech.",
            "priceTtc" => "89453",
            "brand" => "Subaru",
            "image" => "image.png",
            "vendor" => "Subaru Corporation"
        ],
        [
            "title" => "Nissan Model-551",
            "gender" => "unisex",
            "type" => "SUV",
            "description" => "A sporty model designed for speed enthusiasts.",
            "priceTtc" => "59945",
            "brand" => "Nissan",
            "image" => "image.png",
            "vendor" => "Nissan Motor Co., Ltd."
        ],
        [
            "title" => "Toyota Model-779",
            "gender" => "unisex",
            "type" => "sedan",
            "description" => "A sporty model designed for speed enthusiasts.",
            "priceTtc" => "63056",
            "brand" => "Toyota",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Ford Model-471",
            "gender" => "unisex",
            "type" => "hatchback",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "74925",
            "brand" => "Ford",
            "image" => "image.png",
            "vendor" => "Ford Motor Company"
        ],
        [
            "title" => "Mazda Model-552",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A sporty model designed for speed enthusiasts.",
            "priceTtc" => "53060",
            "brand" => "Mazda",
            "image" => "image.png",
            "vendor" => "Mazda Motor Corporation"
        ],
        [
            "title" => "Volvo Model-289",
            "gender" => "unisex",
            "type" => "hatchback",
            "description" => "A sporty model designed for speed enthusiasts.",
            "priceTtc" => "65952",
            "brand" => "Volvo",
            "image" => "image.png",
            "vendor" => "Volvo Cars"
        ],
        [
            "title" => "Jeep Model-827",
            "gender" => "unisex",
            "type" => "coupe",
            "description" => "A rugged vehicle built for off-road adventures.",
            "priceTtc" => "88525",
            "brand" => "Jeep",
            "image" => "image.png",
            "vendor" => "Stellantis"
        ],
        [
            "title" => "Hyundai Model-135",
            "gender" => "unisex",
            "type" => "coupe",
            "description" => "A luxurious vehicle offering comfort and performance.",
            "priceTtc" => "63267",
            "brand" => "Hyundai",
            "image" => "image.png",
            "vendor" => "Hyundai Motor Company"
        ],
        [
            "title" => "Audi Model-446",
            "gender" => "unisex",
            "type" => "pickup truck",
            "description" => "A reliable and efficient car suitable for city driving.",
            "priceTtc" => "58123",
            "brand" => "Audi",
            "image" => "image.png",
            "vendor" => "Audi AG"
        ],
        [
            "title" => "Chevrolet Model-291",
            "gender" => "unisex",
            "type" => "hatchback",
            "description" => "A stylish and modern vehicle with advanced tech.",
            "priceTtc" => "24258",
            "brand" => "Chevrolet",
            "image" => "image.png",
            "vendor" => "General Motors"
        ],
        [
            "title" => "Jeep Model-838",
            "gender" => "unisex",
            "type" => "sedan",
            "description" => "A reliable and efficient car suitable for city driving.",
            "priceTtc" => "35154",
            "brand" => "Jeep",
            "image" => "image.png",
            "vendor" => "Stellantis"
        ],
        [
            "title" => "Hyundai Model-269",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "73710",
            "brand" => "Hyundai",
            "image" => "image.png",
            "vendor" => "Hyundai Motor Company"
        ],
        [
            "title" => "Audi Model-936",
            "gender" => "unisex",
            "type" => "hatchback",
            "description" => "An electric car known for its technology and range.",
            "priceTtc" => "72462",
            "brand" => "Audi",
            "image" => "image.png",
            "vendor" => "Audi AG"
        ],
        [
            "title" => "Peugeot Model-686",
            "gender" => "unisex",
            "type" => "luxury SUV",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "76986",
            "brand" => "Peugeot",
            "image" => "image.png",
            "vendor" => "Stellantis"
        ],
        [
            "title" => "Tesla Model-260",
            "gender" => "unisex",
            "type" => "SUV",
            "description" => "A sporty model designed for speed enthusiasts.",
            "priceTtc" => "89671",
            "brand" => "Tesla",
            "image" => "image.png",
            "vendor" => "Tesla Inc."
        ],
        [
            "title" => "Mazda Model-919",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "30202",
            "brand" => "Mazda",
            "image" => "image.png",
            "vendor" => "Mazda Motor Corporation"
        ],
        [
            "title" => "Subaru Model-866",
            "gender" => "unisex",
            "type" => "coupe",
            "description" => "A luxurious vehicle offering comfort and performance.",
            "priceTtc" => "39297",
            "brand" => "Subaru",
            "image" => "image.png",
            "vendor" => "Subaru Corporation"
        ],
        [
            "title" => "Toyota Model-290",
            "gender" => "unisex",
            "type" => "compact SUV",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "27781",
            "brand" => "Toyota",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Mazda Model-142",
            "gender" => "unisex",
            "type" => "SUV",
            "description" => "An electric car known for its technology and range.",
            "priceTtc" => "32192",
            "brand" => "Mazda",
            "image" => "image.png",
            "vendor" => "Mazda Motor Corporation"
        ],
        [
            "title" => "Volvo Model-107",
            "gender" => "unisex",
            "type" => "SUV",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "25506",
            "brand" => "Volvo",
            "image" => "image.png",
            "vendor" => "Volvo Cars"
        ],
        [
            "title" => "Volkswagen Model-365",
            "gender" => "unisex",
            "type" => "luxury SUV",
            "description" => "A performance-driven car with a sleek design.",
            "priceTtc" => "50903",
            "brand" => "Volkswagen",
            "image" => "image.png",
            "vendor" => "Volkswagen AG"
        ],
        [
            "title" => "Honda Model-192",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "An electric car known for its technology and range.",
            "priceTtc" => "28667",
            "brand" => "Honda",
            "image" => "image.png",
            "vendor" => "Honda Motor Co., Ltd."
        ],
        [
            "title" => "BMW Model-537",
            "gender" => "unisex",
            "type" => "coupe",
            "description" => "A performance-driven car with a sleek design.",
            "priceTtc" => "24655",
            "brand" => "BMW",
            "image" => "image.png",
            "vendor" => "BMW AG"
        ],
        [
            "title" => "Audi Model-809",
            "gender" => "unisex",
            "type" => "hatchback",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "62410",
            "brand" => "Audi",
            "image" => "image.png",
            "vendor" => "Audi AG"
        ],
        [
            "title" => "Lexus Model-404",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A luxurious vehicle offering comfort and performance.",
            "priceTtc" => "87765",
            "brand" => "Lexus",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Porsche Model-965",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "55565",
            "brand" => "Porsche",
            "image" => "image.png",
            "vendor" => "Porsche AG"
        ],
        [
            "title" => "Hyundai Model-436",
            "gender" => "unisex",
            "type" => "compact SUV",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "56848",
            "brand" => "Hyundai",
            "image" => "image.png",
            "vendor" => "Hyundai Motor Company"
        ],
        [
            "title" => "Mercedes-Benz Model-223",
            "gender" => "unisex",
            "type" => "pickup truck",
            "description" => "A performance-driven car with a sleek design.",
            "priceTtc" => "54388",
            "brand" => "Mercedes-Benz",
            "image" => "image.png",
            "vendor" => "Mercedes-Benz Group AG"
        ],
        [
            "title" => "Lexus Model-392",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A reliable and efficient car suitable for city driving.",
            "priceTtc" => "53410",
            "brand" => "Lexus",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Hyundai Model-665",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "A luxurious vehicle offering comfort and performance.",
            "priceTtc" => "86145",
            "brand" => "Hyundai",
            "image" => "image.png",
            "vendor" => "Hyundai Motor Company"
        ],
        [
            "title" => "Nissan Model-437",
            "gender" => "unisex",
            "type" => "luxury SUV",
            "description" => "A compact car ideal for small families.",
            "priceTtc" => "67658",
            "brand" => "Nissan",
            "image" => "image.png",
            "vendor" => "Nissan Motor Co., Ltd."
        ],
        [
            "title" => "Lexus Model-557",
            "gender" => "unisex",
            "type" => "pickup truck",
            "description" => "A rugged vehicle built for off-road adventures.",
            "priceTtc" => "84499",
            "brand" => "Lexus",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Hyundai Model-339",
            "gender" => "unisex",
            "type" => "sedan",
            "description" => "An electric car known for its technology and range.",
            "priceTtc" => "66394",
            "brand" => "Hyundai",
            "image" => "image.png",
            "vendor" => "Hyundai Motor Company"
        ],
        [
            "title" => "Kia Model-848",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A rugged vehicle built for off-road adventures.",
            "priceTtc" => "35239",
            "brand" => "Kia",
            "image" => "image.png",
            "vendor" => "Kia Corporation"
        ],
        [
            "title" => "Kia Model-160",
            "gender" => "unisex",
            "type" => "hatchback",
            "description" => "An electric car known for its technology and range.",
            "priceTtc" => "62756",
            "brand" => "Kia",
            "image" => "image.png",
            "vendor" => "Kia Corporation"
        ],
        [
            "title" => "Toyota Model-107",
            "gender" => "unisex",
            "type" => "SUV",
            "description" => "A luxurious vehicle offering comfort and performance.",
            "priceTtc" => "53887",
            "brand" => "Toyota",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Porsche Model-532",
            "gender" => "unisex",
            "type" => "SUV",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "31934",
            "brand" => "Porsche",
            "image" => "image.png",
            "vendor" => "Porsche AG"
        ],
        [
            "title" => "Volkswagen Model-204",
            "gender" => "unisex",
            "type" => "sedan",
            "description" => "A performance-driven car with a sleek design.",
            "priceTtc" => "55640",
            "brand" => "Volkswagen",
            "image" => "image.png",
            "vendor" => "Volkswagen AG"
        ],
        [
            "title" => "Kia Model-436",
            "gender" => "unisex",
            "type" => "coupe",
            "description" => "A sporty model designed for speed enthusiasts.",
            "priceTtc" => "20142",
            "brand" => "Kia",
            "image" => "image.png",
            "vendor" => "Kia Corporation"
        ],
        [
            "title" => "Mazda Model-404",
            "gender" => "unisex",
            "type" => "sedan",
            "description" => "A compact car ideal for small families.",
            "priceTtc" => "53866",
            "brand" => "Mazda",
            "image" => "image.png",
            "vendor" => "Mazda Motor Corporation"
        ],
        [
            "title" => "Subaru Model-580",
            "gender" => "unisex",
            "type" => "minivan",
            "description" => "A compact car ideal for small families.",
            "priceTtc" => "68765",
            "brand" => "Subaru",
            "image" => "image.png",
            "vendor" => "Subaru Corporation"
        ],
        [
            "title" => "Peugeot Model-327",
            "gender" => "unisex",
            "type" => "minivan",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "21419",
            "brand" => "Peugeot",
            "image" => "image.png",
            "vendor" => "Stellantis"
        ],
        [
            "title" => "Renault Model-550",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A reliable and efficient car suitable for city driving.",
            "priceTtc" => "75938",
            "brand" => "Renault",
            "image" => "image.png",
            "vendor" => "Renault Group"
        ],
        [
            "title" => "Tesla Model-539",
            "gender" => "unisex",
            "type" => "sports car",
            "description" => "A compact car ideal for small families.",
            "priceTtc" => "73184",
            "brand" => "Tesla",
            "image" => "image.png",
            "vendor" => "Tesla Inc."
        ],
        [
            "title" => "Volvo Model-719",
            "gender" => "unisex",
            "type" => "convertible",
            "description" => "A compact car ideal for small families.",
            "priceTtc" => "27886",
            "brand" => "Volvo",
            "image" => "image.png",
            "vendor" => "Volvo Cars"
        ],
        [
            "title" => "Peugeot Model-268",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "A compact car ideal for small families.",
            "priceTtc" => "29088",
            "brand" => "Peugeot",
            "image" => "image.png",
            "vendor" => "Stellantis"
        ],
        [
            "title" => "Subaru Model-819",
            "gender" => "unisex",
            "type" => "SUV",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "58494",
            "brand" => "Subaru",
            "image" => "image.png",
            "vendor" => "Subaru Corporation"
        ],
        [
            "title" => "Porsche Model-268",
            "gender" => "unisex",
            "type" => "minivan",
            "description" => "A stylish and modern vehicle with advanced tech.",
            "priceTtc" => "33328",
            "brand" => "Porsche",
            "image" => "image.png",
            "vendor" => "Porsche AG"
        ],
        [
            "title" => "Jeep Model-634",
            "gender" => "unisex",
            "type" => "SUV",
            "description" => "An electric car known for its technology and range.",
            "priceTtc" => "64491",
            "brand" => "Jeep",
            "image" => "image.png",
            "vendor" => "Stellantis"
        ],
        [
            "title" => "Mercedes-Benz Model-989",
            "gender" => "unisex",
            "type" => "sedan",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "59467",
            "brand" => "Mercedes-Benz",
            "image" => "image.png",
            "vendor" => "Mercedes-Benz Group AG"
        ],
        [
            "title" => "Volkswagen Model-702",
            "gender" => "unisex",
            "type" => "pickup truck",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "88654",
            "brand" => "Volkswagen",
            "image" => "image.png",
            "vendor" => "Volkswagen AG"
        ],
        [
            "title" => "Jeep Model-319",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "A rugged vehicle built for off-road adventures.",
            "priceTtc" => "49951",
            "brand" => "Jeep",
            "image" => "image.png",
            "vendor" => "Stellantis"
        ],
        [
            "title" => "Ford Model-471",
            "gender" => "unisex",
            "type" => "pickup truck",
            "description" => "A reliable and efficient car suitable for city driving.",
            "priceTtc" => "23476",
            "brand" => "Ford",
            "image" => "image.png",
            "vendor" => "Ford Motor Company"
        ],
        [
            "title" => "Hyundai Model-820",
            "gender" => "unisex",
            "type" => "SUV",
            "description" => "A luxurious vehicle offering comfort and performance.",
            "priceTtc" => "23458",
            "brand" => "Hyundai",
            "image" => "image.png",
            "vendor" => "Hyundai Motor Company"
        ],
        [
            "title" => "Volkswagen Model-671",
            "gender" => "unisex",
            "type" => "pickup truck",
            "description" => "A reliable and efficient car suitable for city driving.",
            "priceTtc" => "81441",
            "brand" => "Volkswagen",
            "image" => "image.png",
            "vendor" => "Volkswagen AG"
        ],
        [
            "title" => "Renault Model-964",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "61054",
            "brand" => "Renault",
            "image" => "image.png",
            "vendor" => "Renault Group"
        ],
        [
            "title" => "Volkswagen Model-604",
            "gender" => "unisex",
            "type" => "luxury SUV",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "26014",
            "brand" => "Volkswagen",
            "image" => "image.png",
            "vendor" => "Volkswagen AG"
        ],
        [
            "title" => "Mercedes-Benz Model-942",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "A performance-driven car with a sleek design.",
            "priceTtc" => "50658",
            "brand" => "Mercedes-Benz",
            "image" => "image.png",
            "vendor" => "Mercedes-Benz Group AG"
        ],
        [
            "title" => "Chevrolet Model-402",
            "gender" => "unisex",
            "type" => "electric sedan",
            "description" => "A rugged vehicle built for off-road adventures.",
            "priceTtc" => "61795",
            "brand" => "Chevrolet",
            "image" => "image.png",
            "vendor" => "General Motors"
        ],
        [
            "title" => "Jeep Model-129",
            "gender" => "unisex",
            "type" => "luxury SUV",
            "description" => "An affordable option with impressive safety features.",
            "priceTtc" => "73540",
            "brand" => "Jeep",
            "image" => "image.png",
            "vendor" => "Stellantis"
        ],
        [
            "title" => "Toyota Model-554",
            "gender" => "unisex",
            "type" => "sedan",
            "description" => "A luxurious vehicle offering comfort and performance.",
            "priceTtc" => "47094",
            "brand" => "Toyota",
            "image" => "image.png",
            "vendor" => "Toyota Motor Corporation"
        ],
        [
            "title" => "Subaru Model-752",
            "gender" => "unisex",
            "type" => "coupe",
            "description" => "A luxurious vehicle offering comfort and performance.",
            "priceTtc" => "25114",
            "brand" => "Subaru",
            "image" => "image.png",
            "vendor" => "Subaru Corporation"
        ],
        [
            "title" => "Nissan Model-750",
            "gender" => "unisex",
            "type" => "convertible",
            "description" => "A compact car ideal for small families.",
            "priceTtc" => "37873",
            "brand" => "Nissan",
            "image" => "image.png",
            "vendor" => "Nissan Motor Co., Ltd."
        ],
        [
            "title" => "Volkswagen Model-448",
            "gender" => "unisex",
            "type" => "coupe",
            "description" => "A practical and versatile vehicle for daily use.",
            "priceTtc" => "57691",
            "brand" => "Volkswagen",
            "image" => "image.png",
            "vendor" => "Volkswagen AG"
        ],
        [
            "title" => "Subaru Model-305",
            "gender" => "unisex",
            "type" => "compact SUV",
            "description" => "An electric car known for its technology and range.",
            "priceTtc" => "43370",
            "brand" => "Subaru",
            "image" => "image.png",
            "vendor" => "Subaru Corporation"
        ],
        [
            "title" => "Chevrolet Model-829",
            "gender" => "unisex",
            "type" => "luxury SUV",
            "description" => "A performance-driven car with a sleek design.",
            "priceTtc" => "29353",
            "brand" => "Chevrolet",
            "image" => "image.png",
            "vendor" => "General Motors"
        ]
    ];

    public function __construct(
        private BrandRepository $brandRepository,
        private EntityManagerInterface $em,
        private VendorRepository $vendorRepository,
    )
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

        foreach (self::PRODUCTS as $productArray) {
            $product = new Product();

            $brand = $this->brandRepository->findOneByName($productArray['brand']);
            $vendor = $this->vendorRepository->findOneByName($productArray['vendor']);
            $product->setTitle($productArray['title']);
            
            $product->setPriceTtc($productArray['priceTtc']);
            $product->setType($productArray['type']);
            
            $product->setGender($productArray['gender']);
            $product->setDescription($productArray['description']);
            
            if ($brand) {
              $product->setBrand($brand);
            }

            if ($vendor) {
                $product->setVendor($vendor);
            }

            $product->setStock(rand(1, 100));
            $product->setImage($productArray['image']);

            $this->em->persist($product);
        }

        $this->em->flush();
        $io->success(sprintf('%s products create', count(self::PRODUCTS)));

        return Command::SUCCESS;
    }
}
