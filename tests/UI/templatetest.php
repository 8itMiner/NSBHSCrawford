<?php
    require './../../main.php';


    // Read the data file
    $f = fopen('./../../data/debating.json', 'r') or die('Could not open file');
    $jsonRaw = fread($f, filesize('./../../data/debating.json'));
    fclose($f);
    
    
    
    // Create a new UI OBJ
    $template = UI::generateTemplate($jsonRaw);
    echo '<pre>';
    echo(json_encode($template, JSON_PRETTY_PRINT));
    echo '</pre>';