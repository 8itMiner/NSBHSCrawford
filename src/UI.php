<?php
  require_once('parse.php');
  require_once('../vendor/autoload.php');

  define("DEFAULT_CATEGORY", "default");

  // TODO: CLEAN UP THIS CODE SHITPOST
  // HONESTLY DUDE, YOU CAN DO BETTER!!!!
  
  
  // HTML DOM LOADER
  use Windwalker\Dom\HtmlElement;
  use Windwalker\Dom\HtmlElements;


  

  class UI {
    
    
    // generateTemplate generates a page template from the JSON data to make page generation easier
    public static function generateTemplate($json) {
      $parser = new JSONParser($json);
      $days = $parser->get("key:data");
      
      // The template object to return
      $template = array(
        "name" => $parser->get("key:name"),
        "description" => $parser->get("key:description"),
        "score_desc" => $parser->get("key:score_desc"),
        "score_categories" => array(),
        "days" => array(),
        "raw_data" => array()
      );

      // Iterate over every block of data, see the .json files      
      foreach ($parser->get("key:data") as $dataOBJ) {
        // Push the day into the days list in the template
        array_push($template["days"], $dataOBJ["day"]);
        // Parse the rest of the data, the coreOBJ object is the blo
        $scoreOBJ = array();
        
        // Iterate and insert into the template map
        foreach ($dataOBJ["categories"] as $name=>$data) {

          // Ignore this iterate if its already in the array
          if (!in_array($name, $template["score_categories"])) {
            array_push($template["score_categories"], $name);
          }
          $category = $name;
          
          // insert the actual data into the template
          array_push($scoreOBJ, array(
            "scores" => array(
              "Melbourne" => $data["melbourne"],
              "Nth Sydney" => $data["nth_syd"],
              "Winner" => ($data["winner"] == "nth_syd" ? "Nth Sydney": "Melbourne")),
            "category" => $category,
            "day" => $dataOBJ["day"]
          ));
        }
        // Push the data back into the template
        array_push($template["raw_data"], $scoreOBJ);
      }
      return $template;  
    }
    
    
    
    
    
    
    
    
    
    
    // generateUI generates a user interface from the code JSON dump data 
    public static function generateUI($json) {
      $template = UI::generateTemplate($json);
      $finHTML = array();
      $htmlData = array();
      
      // First bild a bunch of HTNML day DOM elements
      foreach ($template["days"] as $dayID) {
        // Build a day block for the HTML block
        $htmlData[$dayID] = array(new HtmlElement('p', 'Day: '.(string)$dayID, array("class"=>"dayDividerTitle"))); //new HtmlElement('div', $htmlContent, array("class"=>"dayHeader", "id"=>"dayHeader".$dayID));
      }
      
      
      // Add all the data now
      foreach ($template["raw_data"] as $dayDataBlock) {
        
        // Build a list of categories to be shoved into the days block
        $categories = array();
        // Generate a list of categories
        foreach ($template["score_categories"] as $category) {
          
          $categoryDisplay = $category;
          
          if ($category == DEFAULT_CATEGORY) {
            $categoryDisplay="";
          }
          
          $titleAttrs = array('class' => 'categoryTitle', 'id' => strtolower($category).'Title');
          $divAttrs = array('class' => 'categoryBox', 'id' => strtolower($category).'Box');
          
          $categories[$category] = array(new HtmlElement('p', $categoryDisplay, $titleAttrs));
        }
        
        
        // Create the categoryBlockContainer
        foreach($dayDataBlock as $categoryDataBlock) {
          
          $categoryName = $categoryDataBlock["category"];
          
          // Build that data that is meant to go inside the datablock
          $dataBlockInterior = new HtmlElements(array(
            new HtmlElement('td', "Melbourne", array("class"=>"melb-name")),
            new HtmlElement('td', $categoryDataBlock['scores']['Melbourne'], array("class"=>"melb-score")),
            new HtmlElement('td', $categoryDataBlock['scores']['Nth Sydney'], array("class"=>"nth-syd-score")),
            new HtmlElement('td', "Nth Sydney", array("class"=>"nth-syd-name")),
            new HtmlElement('p', $categoryDataBlock['scores']['Winner'], array("class"=>"data-winner"))
          ));
          
          // Push the new data into the category block
          array_push($categories[$categoryName], 
            new HtmlElement('table', $dataBlockInterior, array("class"=>"categoryDataHolder"))
          );
          
               
          // Build this into a category html element
          $divAttrs = array('class' => 'categoryBox', 'id' => strtolower($categoryName).'Box');
          $categoryHTML = new HtmlElement('div', $categories[$categoryName], $divAttrs);
          
          // Push the category into today's data block
          array_push($htmlData[$categoryDataBlock["day"]], $categoryHTML);
        }
      }  
      
      
      // Build actual data objects from our day blocks
      foreach($htmlData as $dayId=>$currDay) {
        $dayHTML = new HtmlElement('div', $currDay, array('class'=>'dayContentHolder', 'id'=>'dayContentHolder'.$dayDataBlock));
        array_push($finHTML, $dayHTML);
      }
      
      $dataDiv = new HtmlElement('div', $finHTML, array('class'=>'scoreHolder'));
      $descriptionDivData = new HtmlElements(array(
        new HtmlElement('p', $template["description"], array("class"=>"sportDescription")),
        new HtmlElement('p', $template["score_desc"], array("class"=>"scoreDescription"))
      ));
   
      return new HtmlElement('div', array(
        new HtmlElement('p', $template["name"], array("class"=>"sportName")),
        new HtmlElement('div', $descriptionDivData, array("class"=>"description")),
        $dataDiv
      ), array('id' => 'holder', 'class' => 'holder'));
    }
  };
