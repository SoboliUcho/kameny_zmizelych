<?php
$id = $_POST["dum"];
// $id = "dum01";
$cesta = "domy.txt";
// print_r ($q);
// echo "aray";
// echo $q["dum"];

function cistradek($soubor, $linenumber) //vrátí data uložená na řádku v databázi

{
  $file = new SplFileObject($soubor, "r"); //otevře Slp objekt (v režimu čtení)
  $file->seek($linenumber); //přesune se na zadaný řádek 
  $line = json_decode($file->fgets(), true); //přečte data na řádku a dekóduje je z formátu JSON na asociativní pole
  return $line;
}

function lastline($cestasoubor) //vrátí počet řádků souboru 

{
  $file = new SplFileObject($cestasoubor, "r"); //otevře Spl objekt
  $i = 0; //pocet kroků
  while (!$file->eof()) { //dokud není konec souboru
    $i++;
    $line = $file->fgets(); //posune se o řádek
  }
  return ($i);
}

function seznam_v_domne($cesta, $id)
{
  for ($x = 0; $x <= (lastline($cesta)) - 2; $x++) { // kontroluje databázi řádek po řádku a kontroluje parametry 
    $line = cistradek($cesta, $x); //čte konkrétní řádek databáze
    if ($line["id"] == $id) {
      // print_r($line["lide"]);
      echo (json_encode($line["lide"]));
      break;
    } else {
      echo ("nic");
    }
  }
}

seznam_v_domne($cesta, $id)


?>