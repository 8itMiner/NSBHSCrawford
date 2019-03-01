<?php
  require_once('./parse.php');

  class UI {
    
    private const DEFAULT_CATEGORY = "default";
    
    
    // generateTemplate generates a page template from the JSON data
    // UGLY CODE I WILL FIX IT TMMRW
    public static function generateTemplate(string $json) {
      $parser = new $JSONParser($json);
      $days = $parser.get("index:data");
      
      $template = array(
        "name" => $parser.get("index:name"),
        "description" => $parser.get("index:description"),
        "score_desc" => $parser.get("index:score_desc"),
        "score_categories" => array(),
        "days" => array(),
        "raw_data" => array()
      );
     
      
      // Now parse the actual data and the days and the categories
      for ($parser.get("index:data") as $dataOBJ) {
        array_push($template["days"], $dataOBJ["day"]);
        
        // Parse the rest of the data
        $scoreOBJ = array();
        
        for ($dataOBJ["categories"] as $name=>$data) {
          // get the name of the category
          $category = null;
          
          if ($name != DEFAULT_CATEGORY) {
            array_push($template["score_categories"], $name);
            $category = $name;
          }
          
          // insert the actual data now
          array_push($scoreOBJ, array(
            "scores" => array(
              "Melbourne High School" => $data["melbourne"],
              "North Sydney Boys High School" => $data["nth_syd"],
              "Winner" => $data["winner"]),
            "category" => $name,
            "day" => $dataOBJ["day"]
          ));
        }
        
        // Addd the data for today to the template
        array_push($template["raw_data"], $scoreOBJ);
      }
    }
   
    return $template;  
  };

?>