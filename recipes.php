<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    if (isset($_COOKIE['username'])) {
        $filename = 'recipe.json';
        $existingData = file_exists($filename) ?
            json_decode(file_get_contents($filename), true) : array();
        if ($existingData === null) $existingData = array();
        echo "<h1>Tutte le ricette</h1>";
        foreach ($existingData as $recipe => $recipeData) {
            echo "<form method='post' action='modifyRecipe.php'>";
                echo "<br><h1>".$recipe."</h2>";
                echo "<h3>Ingredienti:</h3>";
                echo "<h5>{$recipeData['ingredienti']}</h5>";
                echo "<h3>Istruzioni:</h3>";
                echo "<h5>{$recipeData['istruzioni']}</h5>";
                echo "<input type='text' name='recipeName' value ='".$recipe."' hidden>";
                echo "<input type='text' name='ingredienti' value ='{$recipeData['ingredienti']}' hidden>";
                echo "<input type='text' name='istruzioni' value ='{$recipeData['istruzioni']}' hidden>";
                echo "<input type='submit' name='submit' value='modifica'>";
            echo "</form>";
        }
    } else if (!isset($_COOKIE['username'])) {
        $filename = 'recipe.json';
        $existingData = file_exists($filename) ?
            json_decode(file_get_contents($filename), true) : array();
        if ($existingData === null) $existingData = array();
        echo "<h1>Tutte le ricette</h1>";
        echo "<form method='post' action='modifyRecipe.php'>";
        foreach ($existingData as $recipe => $recipeData) {
            echo "<div style='border: 1px'>";
                echo "<h1>".$recipe."</h2>";
                echo "<h3>Ingredienti:</h3>";
                echo "<h5>{$recipeData['ingredienti']}</h5>";
                echo "<h3>Istruzioni:</h3>";
                echo "<h5>{$recipeData['istruzioni']}</h5>";
            echo "</div>";
        }
        echo "</form>";
    }
    ?>
</body>
</html>