<?php
  // Involved with parsing the JSON file

  class JSONParser {
    
    private $json;
    
    // Handles construction and base parsing setup
    public function __construct($json) {
      $this->json = json_decode($json, true);
    }
    
    
    // The idea behind the path is that it looks like: key:keyname/index:0/key:keyname
    public function get($path) { 
      // Break apart the path
      $pathSegments = split("\/", $path);
      // Pointer to the current object
      $currOBJ = $this->json;
      
      // Iterate over pathSegments to get to data
      foreach ($pathSegments as $key) {
        // Determine what the user is requesting with this key
        $coreData = split(":", $key);
        // Convert the user's input to an integer if we asked for a key
        $coreData[1] = ($coreData[0] == "index" ? intval($coreData[1]): $coreData[1]);
        
        // Attain the new pointer
        $currOBJ = $currOBJ[$coreData[1]];
      }
      
      if ($currOBJ == null) {
        throw new \Exception('Invalid path');
      }
      
      return $currOBJ;
    }
    
    
    
    
  }
