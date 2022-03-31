<?php

declare(strict_types=1);

use Dodocanfly\SunreefTasks\Task3\Tree;

require_once __DIR__ . '/../vendor/autoload.php';


$list = [
    1 => ['parent' => 0, 'value' => 'Audi'],
    2 => ['parent' => 0, 'value' => 'BMW'],
    3 => ['parent' => 0, 'value' => 'Ford'],
    4 => ['parent' => 0, 'value' => 'Opel'],
    5 => ['parent' => 1, 'value' => 'Kompakt'],
    6 => ['parent' => 1, 'value' => 'Sedan'],
    7 => ['parent' => 1, 'value' => 'SUV'],
    8 => ['parent' => 5, 'value' => 'A3'],
    9 => ['parent' => 6, 'value' => 'A4'],
    10 => ['parent' => 6, 'value' => 'A6'],
    11 => ['parent' => 6, 'value' => 'A8'],
    12 => ['parent' => 7, 'value' => 'Q3'],
    13 => ['parent' => 7, 'value' => 'Q5'],
    14 => ['parent' => 7, 'value' => 'Q7'],
    15 => ['parent' => 2, 'value' => 'Kompakt'],
    16 => ['parent' => 2, 'value' => 'Sedan'],
    17 => ['parent' => 2, 'value' => 'SUV'],
    18 => ['parent' => 15, 'value' => 'Seria 1'],
    19 => ['parent' => 15, 'value' => 'i3'],
    20 => ['parent' => 16, 'value' => 'Seria 3'],
    21 => ['parent' => 16, 'value' => 'Seria 5'],
    22 => ['parent' => 17, 'value' => 'X3'],
    23 => ['parent' => 17, 'value' => 'X5'],
    24 => ['parent' => 17, 'value' => 'X7'],
    25 => ['parent' => 3, 'value' => 'Kompakt'],
    26 => ['parent' => 3, 'value' => 'Sedan'],
    27 => ['parent' => 3, 'value' => 'SUV'],
    28 => ['parent' => 25, 'value' => 'Focus'],
    29 => ['parent' => 25, 'value' => 'Fiesta'],
    30 => ['parent' => 26, 'value' => 'Mondeo'],
    31 => ['parent' => 27, 'value' => 'EcoSport'],
    32 => ['parent' => 27, 'value' => 'Kuga'],
    33 => ['parent' => 27, 'value' => 'Edge'],
    34 => ['parent' => 4, 'value' => 'Kompakt'],
    35 => ['parent' => 4, 'value' => 'Sedan'],
    36 => ['parent' => 4, 'value' => 'SUV'],
    37 => ['parent' => 34, 'value' => 'Astra'],
    38 => ['parent' => 34, 'value' => 'Corsa'],
    39 => ['parent' => 35, 'value' => 'Insignia'],
    40 => ['parent' => 35, 'value' => 'Omega'],
    41 => ['parent' => 35, 'value' => 'Vectra'],
    42 => ['parent' => 36, 'value' => 'Crossland'],
    43 => ['parent' => 36, 'value' => 'Mokka'],
    44 => ['parent' => 36, 'value' => 'Grandland'],
    45 => ['parent' => 32, 'value' => 'Trend'],
    46 => ['parent' => 32, 'value' => 'Titanium'],
    47 => ['parent' => 32, 'value' => 'Individual'],
];


$tree = new Tree($list);


if ($tree->isListValid()) {


    echo "LIST IS VALID\n";


    echo "Tree:\n";
    $tree->printTree();


    echo "\n==============================================\n\n";
    $needle = 'Opel';
    echo "Level of first found item searched for '$needle': " . $tree->findFirst($needle) . "\n";
    $needle = 'SUV';
    echo "Level of first found item searched for '$needle': " . $tree->findFirst($needle) . "\n";
    $needle = 'Focus';
    echo "Level of first found item searched for '$needle': " . $tree->findFirst($needle) . "\n";
    $needle = 'Trend';
    echo "Level of first found item searched for '$needle': " . $tree->findFirst($needle) . "\n";
    $needle = 'Jaguar';
    echo "Level of first found item searched for '$needle': " . $tree->findFirst($needle) . "\n";


    echo "\n==============================================\n\n";
    $needle = 'Sedan';
    echo "All items with value '$needle':\n";
    print_r($tree->search($needle));


    echo "\n==============================================\n\n";
    # move Opel/Kompakt into Ford/SUV/Kuga/Titanium
    $tree->moveItem(34, 46);
    echo "Changed tree:\n";
    $tree->printTree();


    echo "\n==============================================\n\n";
    $needle = 'Corsa';
    echo "Level of first found item searched for '$needle': " . $tree->findFirst($needle) . "\n";


    echo "\n==============================================\n\n";
    # trying to move Ford/SUV into Ford/SUV/Kuga/Trend
    if ($tree->moveItem(27, 45)) {
        echo "Item moved\n";
    } else {
        echo "Item 'Ford / SUV' cant be moved into himself (Ford / SUV / Kuga / Trend)\n\n";
    }


} else {


    echo "INVALID LIST\n";


}
