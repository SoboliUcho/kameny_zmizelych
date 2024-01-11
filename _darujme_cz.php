<?php
require_once('_function_database.php');
require_once('_darujme_cz_functions.php');

$conn = conenect_to_database_kameny();
$response = load_data_dar($conn);
$location = "Location: editor.php?response=$response";
header($location);
?>