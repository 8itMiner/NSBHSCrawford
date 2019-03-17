<?php
    require './../main.php';
    
    
    // Read the data file
    $f = fopen('./../data/cricket.json', 'r') or die('Could not open file');
    $jsonRaw = fread($f, filesize('./../data/cricket.json'));
    fclose($f);
    
    $parser = new JSONParser($jsonRaw);
    
    echo($parser->get("key:data/index:0/key:day"));
    


