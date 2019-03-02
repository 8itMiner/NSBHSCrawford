<?php
  require_once('./parse.php');
  require_once('./../main.php');

  // HTML DOM LOADER
  use Windwalker\Dom\DomElement;


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
      return $template;  
    }
    
    
    
    
    
    // generateUI generates a user interface from the code JSON dump data 
    public static function generateUI(string $json) {
      $template = UI.generateTemplate($json);
      $htmlData = array();
      $categories = array();
      
      // Generate a list of categories
      for ($template["categories"] as $category) {
        $titleAttrs = array('class' => 'categoryTitle', 'id' => $category);
        $divAttrs = array('class' => 'categoryBox', 'id' => $category + 'box');
        
        $categories[$category] = new HTMLElement('div', array(new HTMLElement('p', $category, $titleAttrs)), $divAttrs);
      }
      
      // First bild a bunch of HTNML day DOM elements
      for ($template["days"] as $dayID) {
        $htmlData[$dayID] = new DomElement('div',
                                           array(new DomElement('p', 'Day: ' + string($dayID)), null);
      }
      
      // Add all the data now
      for ($template["raw_data"] as $dataBlock) {
          // Build the data
          $dataBlockInner = new HTMLElements(
              array(
                new HTMLElement('p', "Melbourne High School: {$dataBlock["Melbourne High School"]}", array("class"=>"melb-score")),
                new HTMLElement('p', "North Sydney Boys High School: {$dataBlock["North Sydney Boys High School"]}", array("class"=>"nth-syd-score", "id"=>"data-{$dataBlock["day"]}-{$dataBlock["category"]}")),
                new HTMLElement('p', "{$template["Winner"]}", array("class"=>"winner"))
              )
          );
        
        
        $rawDivData = new HTMLElement('div', $dataBlockInner, array("class"=>"dataBlock", "id"=>"data-{$dataBlock["day"]}-{$dataBlock["category"]}"))
        
        
      }                                 
                                           
                                           
      
      $dom  = new DomElement('div', array('id' => 'holder', 'class' => holder))
    }
   
  };

























?>