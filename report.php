<?php
require('_function_database.php');

$conn = conenect_to_database_kameny();
if (isset($_GET["response"])) {
    $response = $_GET["response"];
    echo ('
    <script>alert("' . $response . '");</script>');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="https://www.muzeum-boskovicka.cz/sites/default/files/favicons/favicon-16x16.png">
    <!-- <link rel="icon" href="images/icona.jpg"> -->

    <link rel="stylesheet" href="css/lista.css">
    <link rel="stylesheet" href="css/editor.css">
    <link rel="stylesheet" href="css/report.css">
    <title>Report</title>
</head>

<body>
    <?php include('lista.php'); ?>
    <h1>Report</h1>
    <div class="text">Našli jste chybu nebo máte návrh na vylepšení? Napiště mi to rovnou ať se na to nezapomene:</div>
    <form action="_report.php" method="POST">
        <div>
            <label for="jmeno">Název:</label>
            <input type="text" id="jmeno" name="jmeno" require>
        </div>
        <div>
            <label for="popis">podrobný popis:</label>
            <textarea id="popis" name="popis" require></textarea>
        </div>
        <div>
            <input type="submit" value="Odeslat">
        </div>
    </form>
    <h1 class="nahlaseno">Již nahlášeno:</h1>
    <?php
    $reporty = get_all_report($conn);
    if ($reporty != null)
    {foreach ($reporty as $report) {
        $id = $report["id"];
        $jmeno = $report["nazev"];
        $obsah = $report["popis"];
        $jmeno = htmlspecialchars($jmeno, ENT_QUOTES, 'UTF-8');
        $obsah=htmlspecialchars($obsah, ENT_QUOTES, 'UTF-8');
        $text = "<div class='report' id='$id'>
        <div class='report_name'>$jmeno</div>
        <div class='report_text'>$obsah</div>
        </div>";
        echo $text;}
    }
    ?>
    
</body>

</html>