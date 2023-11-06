<?php
if (isset($_POST['log_confirm'])) { //pokud byl odeslán přihlašovací formulář
    $jmeno = $_POST['jmeno']; //vem jeho data
    $heslo = $_POST['heslo'];
    if ($jmeno == "stolpersteine" && $heslo=="kamen333"){
        setcookie("prihlaseni", $jmeno, time() + 60 * 60 * 24 * 90, "/");
        // setcookie("prihlaseni", $jmeno, time() + 60 , "/");

    }
}
header("Location: editor.php");      
?>