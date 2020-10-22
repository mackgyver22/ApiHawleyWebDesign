<?php

$servername = "";
$username = "";
$password = "";
$dbName = "";

die("don't run again");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

/*/
$ingredientIdsArr = [
    75 => [
      111,
      75
    ],
    104 => [
        57,
        104
    ],
    82 => [
        82,
        107,
        34
    ],
    129 => [
        129,
        84
    ],
    44 => [
        44,
        65
    ],
    100 => [
        18,
        100,
        12
    ],
    168 => [
        92,
        168
    ],
    134 => [
        134,
        81
    ],
    54 => [
        60,
        54
    ],
    36 => [
        36,
        151
    ],
    58 => [
        77,
        58,
        20
    ],
    56 => [
        42,
        56
    ]
];
//*/

$ingredientIdsArr = [
    31 => [
        40,
        31
    ]
];

foreach ($ingredientIdsArr as $mainIngredId => $ingredIds) {

    $sql = "UPDATE ri_recipe_ingredient 
            SET ingredient_id = $mainIngredId
            WHERE ingredient_id in (" . implode(",", $ingredIds) . ") ";

    echo $sql . "\n\n";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

echo "script completed \n";




function printStr($str) {

    for ($i = 0; $i < strlen($str); $i++) {
        echo substr($str, $i, 1) . " - " . ord(substr($str, $i, 1)) . "\n";
    }
}