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
111
75	Roma Tomatoes

57
104	Russet Potatoes

82	Shiitake Mushrooms
107	Cremini Mushrooms
34	Sliced Cremini Mushrooms

129	Crispy Fried Onions
84	Crispy JalapeÃ±os

44	Dijon Mustard
65	Grained Dijon Mustard

18	Grated Parmesan
100	Shaved Parmesan
12	Shredded Asiago Cheese

92	Heads of Baby Bok Choy
168	Sliced Bok Choy

134	Panko Breadcrumbs
81	Italian Panko Blend

60	Lime
54	Lemon

36	Shredded Cheddar-Jack Cheese
151	Shredded White Cheddar Cheese

77	Zucchini
58	Zucchinis
20	Sliced Zucchini

42	Trimmed Green Beans
56	Green Beans

//*/

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