<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    if(!isset($_COOKIE['username'])){
        header('Location: login.php');
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $ingredienti = $_POST['ingredienti'];
        $istruzioni = $_POST['istruzioni'];
        $filename = 'recipe.json';
        $newData = array(
            'nome' => $nome,
            'ingredienti' => $ingredienti,
            'istruzioni' => $istruzioni
        );
        function insertRecipe($filename,$newData) {
            $recipeData = file_exists($filename) ?
                json_decode(file_get_contents($filename), true) : array();
            if ($recipeData === null) $recipeData = array();
            if (isset($recipeData[$newData['nome']])) {
                echo "<script>
                    alert('Recipe already inserted.');
                    window.location.back();
                    </script>";
                return false;
            }
            $recipeData[$newData['nome']] = $newData;
            file_put_contents($filename, json_encode($recipeData, JSON_PRETTY_PRINT));
            return true;
        }
        if (insertRecipe($filename,$newData)) {
            echo "<script>
                    alert('Recipe inserted correctly');
                    window.location.back();
                  </script>";
        }
    }
    ?>
</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <h1>Inserisci le tue ricette</h1>
        <h3>Nome <input type="text" name="nome"> <br></h3>
        <h3>Ingredienti <input type="text" name="ingredienti" style="height: 300px;"> <br></h3>
        <h3>Istruzioni <input type="text" name="istruzioni" style="height: 300px;"> <br></h3>
        <input type="submit" name="submit" value="submit">
        <a href="recipes.php">
            <input type="button" name="send" value="visualizza ricette">
        </a>
    </form>
</body>
</html>