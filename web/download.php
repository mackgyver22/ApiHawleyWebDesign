<?php

$servername = "";
$username = "";
$password = "";
$dbName = "";

die("dont run again \n");

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


$sql = "SELECT * FROM ri_recipe WHERE title = :title ";
$stmt_sel_recipe = $conn->prepare($sql);

$sql = "INSERT INTO ri_recipe (title) VALUES (:title) ";
$stmt_ins_recipe = $conn->prepare($sql);

$sql = "SELECT * FROM ri_ingredient WHERE title = :title ";
$stmt_sel_ingredient = $conn->prepare($sql);

$sql = "INSERT INTO ri_ingredient (title) VALUES (:title) ";
$stmt_ins_ingredient = $conn->prepare($sql);

$sql = "SELECT * FROM ri_recipe_ingredient WHERE recipe_id = :recipe_id AND ingredient_id = :ingredient_id ";
$stmt_sel_recipe_ingredient = $conn->prepare($sql);

$sql = "INSERT INTO ri_recipe_ingredient (recipe_id, ingredient_id) VALUES (:recipe_id, :ingredient_id) ";
$stmt_ins_recipe_ingredient = $conn->prepare($sql);

$lastRecipe = 49;
//$lastRecipe = 2;
for ($y = 1; $y < $lastRecipe; $y++) {



    $recipe_id = 0;
    echo "counter: $y \n";
    $fileName = "recipe" . $y . ".html";
    $filePath = "RecipesDownloaderApp/" . $fileName;

    $fh = fopen($filePath, 'r');
    $html = fread($fh, filesize($filePath));

    $dom = new DOMDocument;

    @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

    $xpath = new DOMXPath($dom);

    // Find any element with the style attribute
    //$nodes = $xpath->query('//*[@style]');

    $H1s = $dom->getElementsByTagName('h1');
    $i = 0;
    foreach ($H1s as $getH1) {

        echo 'Recipe Name: ' . stripWhitespace($getH1->nodeValue) . "\n";

        $recipe_title = stripWhitespace($getH1->nodeValue);

        $sql = "SELECT * FROM ri_recipe WHERE title = :title ";
        $stmt_sel_recipe->execute([
           "title" => $recipe_title
        ]);
        $Recipe = $stmt_sel_recipe->fetch(2);

        if (!$Recipe) {

            $sql = "INSERT INTO ri_recipe (title) VALUES (:title) ";
            $stmt_ins_recipe->execute([
                "title" => $recipe_title
            ]);

            $recipe_id = $conn->lastInsertId();
        } else {
            $recipe_id = $Recipe['id'];
        }

        break;
        $i++;
    }

    echo "recipe_id: $recipe_id \n";
    if ($recipe_id) {
        $nodes = $dom->getElementsByTagName('section');

        $i = 0;
        foreach ($nodes as $node) {
            if ($i == 6) {
                $divs = $node->getElementsByTagName('div');

                $t = 0;
                foreach ($divs as $getDiv) {

                    if ($t == 0) {

                        $nextDivs = $getDiv->getElementsByTagName('div');

                        $s = 0;
                        foreach ($nextDivs as $getNextDiv) {

                            if ($s == 0) {

                                $ULs = $getNextDiv->getElementsByTagName('ul');

                                $p = 0;
                                foreach ($ULs as $getUl) {

                                    $LIs = $getUl->getElementsByTagName('li');

                                    $x = 0;
                                    foreach ($LIs as $getLi) {

                                        echo 'Recipe Item: ' . (stripWhitespace($getLi->nodeValue)) . "\n";
                                        $ingredient_title = stripWhitespace($getLi->nodeValue);


                                        $sql = "SELECT * FROM ri_ingredient WHERE title = :title ";
                                        $stmt_sel_ingredient->execute([
                                            "title" => $ingredient_title
                                        ]);
                                        $Ingredient = $stmt_sel_ingredient->fetch(2);
                                        if (!$Ingredient) {

                                            $sql = "INSERT INTO ri_recipe_ingredient (title) VALUES (:title) ";
                                            $stmt_ins_ingredient->execute([
                                                "title" => $ingredient_title
                                            ]);

                                            $ingredient_id = $conn->lastInsertId();

                                            $sql = "SELECT * FROM ri_recipe_ingredient WHERE recipe_id = :recipe_id 
                                                    AND ingredient_id = :ingredient_id ";
                                            $stmt_sel_recipe_ingredient->execute([
                                                "recipe_id" => $recipe_id,
                                                "ingredient_id" => $ingredient_id
                                            ]);
                                            $RecipeIngredient = $stmt_sel_recipe_ingredient->fetch(2);
                                            if (!$RecipeIngredient) {

                                                $sql = "INSERT INTO ri_recipe_ingredient (recipe_id, ingredient_id) VALUES (:recipe_id, :ingredient_id) ";
                                                $stmt_ins_recipe_ingredient->execute([
                                                    "recipe_id" => $recipe_id,
                                                    "ingredient_id" => $ingredient_id
                                                ]);
                                            }
                                        }
                                        $x++;
                                    }
                                    $p++;
                                }
                            }
                            $s++;
                        }
                    }
                    $t++;
                }
            }
            $i++;
        }
    }
    echo "\n\n";
}
//$html = $dom->saveHTML();

function stripWhitespace($str) {
    $val = trim($str);
    $val = strip_tags($val);
    $val = str_replace("\n", "", $val);
    $val = str_replace("\t", "", $val);
    $val = str_replace("      ", " ", $val);
    $val = str_replace("     ", " ", $val);
    $val = str_replace("    ", " ", $val);
    $val = str_replace("   ", " ", $val);
    $val = str_replace("  ", " ", $val);
    $val = str_replace("Info", "", $val);
    $val = str_replace("&frac", "", $val);
    $val = preg_replace("/[^ ]{1,3}cup/", " ", $val);
    $val = preg_replace("/[^ ]{1,3}tsp\./", " ", $val);
    $val = preg_replace("/[^ ]{1,3}Tbsp\./", " ", $val);
    $val = preg_replace("/[^ ]{1,3}oz\./", " ", $val);
    $val = preg_replace("/[^ ]{1,4}fl. oz\./", " ", $val);
    $val = trim($val);
    $val = preg_replace("/([0-9]{1,2})([a-zA-Z]{1})/", "$1 $2", $val);
    $val = preg_replace("/^[0-9]{1,2} /", "", $val);
    $val = preg_replace("/[^ ]{1,5} oz\./", " ", $val);
    $val = str_replace("oz. ", "", $val);

    $val = trim($val);
    return $val;
}

function printStr($str) {

    for ($i = 0; $i < strlen($str); $i++) {
        echo substr($str, $i, 1) . " - " . ord(substr($str, $i, 1)) . "\n";
    }
}