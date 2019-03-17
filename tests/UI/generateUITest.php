<?php
    require './../../main.php';


    // Read the data file
    $f = fopen('./../../data/cricket.json', 'r') or die('Could not open file');
    $jsonRaw = fread($f, filesize('./../../data/cricket.json'));
    fclose($f);
    
    
    
    // Create a new UI OBJ
    $ui = UI::generateUI($jsonRaw);
    echo($ui->render());