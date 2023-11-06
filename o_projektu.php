<?php
require('_function_database.php');
// header('Content-Type: text/html; charset=utf-8');
$conn = conenect_to_database_kameny();
?>
<!DOCTYPE html>
<html lang="cz">

<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- <link rel="icon" href="https://www.muzeum-boskovicka.cz/sites/default/files/favicons/favicon-16x16.png"> -->
  <link rel="icon" href="images/icona.jpg">

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/lista.css">
  <link rel="stylesheet" href="css/loader.css">

  <!-- <script src="js/logintable.js"></script> -->
  <script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
  <script type="text/javascript">Loader.load()</script>
  <script src="js\mapa.js"></script>
  <script src="js\tabulka.js"></script>
    <title>Kameny zmizelých - lidé</title>
</head>

<body>
    <?php include('lista.php'); ?>
    <div id="nelista">
   <h1>tady bude něco napsaný</h1>  
   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris tincidunt sem sed arcu. Nullam rhoncus aliquam metus. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Pellentesque arcu. Nullam eget nisl. Phasellus rhoncus. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Aliquam erat volutpat. Morbi imperdiet, mauris ac auctor dictum, nisl ligula egestas nulla, et sollicitudin sem purus in lacus. Integer imperdiet lectus quis justo. Morbi scelerisque luctus velit. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Quisque porta. Integer imperdiet lectus quis justo. Aenean placerat. Vivamus porttitor turpis ac leo. Suspendisse nisl. Sed ac dolor sit amet purus malesuada congue. Aliquam ornare wisi eu metus.</p>

<p>Phasellus rhoncus. In dapibus augue non sapien. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Maecenas aliquet accumsan leo. Fusce suscipit libero eget elit. Quisque tincidunt scelerisque libero. In dapibus augue non sapien. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Etiam dictum tincidunt diam. Phasellus faucibus molestie nisl. Etiam quis quam.</p>
    </div>
</body>
</html>