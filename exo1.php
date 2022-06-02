<?php
session_start();
function sum_array($no1, $no2)
{
    $array = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];

    // vérifier si les deux entier sont positifs si negatifs return -1
    if (($no1 < 0 && $no2 < 0)) {
        return -1;
    }
    //Vérifier si le premier nombre est > au deuxième ou les nombres se trouve dans le tableau sinon retour 0
    if (($no1 > $no2) || (!in_array($no1, $array) && !in_array($no2, $array))) {
        return 0;
    }
    //Vérifier si le premier nombre se trouve dans le tableau et le deuxieme est supérieur à 100 
    if (in_array($no1, $array) && $no2 > 100) {
        $result = 0;
        foreach ($array as $value) {
            if (($no1 <= $value) && ($no2 >= $value)) {
                $result += $value;
            }
        }
        return $result;
    }
    //les cas non traités no1 positif et deuxième negatif
    //no1 negatif et deuxième positif
    //no1 inférieur au deuxième
    //no1 et no2 se trouve dans le tableau
    if (($no1 > 0 && $no2 < 0) || ($no1 < 0 && $no2 > 0) || ($no1 < $no2) || (in_array($no1, $array) && in_array($no2, $array))) {
        return "Cas non traité";
    }
}

if (!empty($_SESSION["error"])) {
?>
    <div class="console"><?= $_SESSION["error"]; ?></div>
<?php
    $_SESSION["error"] = null;
}
//filtrer les inputs
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars(strip_tags($data));
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["submit"])) {
        $no1 = test_input($_GET["no1"]);
        $no2 = test_input($_GET["no2"]);

        if (isset($no1) && isset($no2)) {
            if (empty($no1) || empty($no2)) {
                $_SESSION["error"] = "Les champs sont obligatoires !";
                header("Location: /exo1.php");
                exit;
            }

            $regex_nombre = '/^[+-]?([0-9]){1,}+$/';
            if (!preg_match($regex_nombre, $no1) || !preg_match($regex_nombre, $no2)) {
                $_SESSION["error"] = "Veuillez introduire un chiffre ou un nombre !";
                header("Location: /exo1.php");
                exit;
            }
            $result = sum_array($no1, $no2);
        }
    }
}
?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Exercice n° 1</title>
</head>

<body>

    <h1>Exercice n° 1</h1>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="form" method="GET">
        <div class="field">
            <label for="no1">Nombre 1</label>
            <input type="text" name="no1" id="no1">
        </div>

        <div class="field">
            <label for="no2">Nombre 2</label>
            <input type="text" name="no2" id="no2">
        </div>

        <div class="field">
            <input type="submit" name="submit" id="submit" value="Valider">
        </div>
        <?php
        if (isset($result)) :
        ?>
            <div class="field">
                <div class="status">
                    <?php
                    echo $result;
                    ?>
                </div>
            </div>
        <?php
        endif;
        ?>
    </form>

    <script>
        function confirm_msg() {
            var console = document.querySelector(".console");
            if (console != null) {
                console.setAttribute("style", "height:0px;");
                console.setAttribute("style", "padding:0px;");
                console.innerHTML = "";
            }
        }
        window.setTimeout(confirm_msg, 4000);
    </script>
</body>

</html>