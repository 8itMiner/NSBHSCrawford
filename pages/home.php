<?php
    require '../src/parse.php';
    
    // Open the totals file
    $f = fopen('../data/total.json', 'r') or exit(header('HTTP/1.1 500 Something went wrong!'));
    $jsonRaw = fread($f, filesize('../data/total.json'));
    $parser = new JSONParser($jsonRaw);
    fclose($f);
    
    $mhs_score = $parser->get("key:mbhs");
    $nsb_score = $parser->get("key:nsbhs");
    
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Crawford | Home</title>
    <meta name="description" content="Homepage for Crawford website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="../css/home.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="../css/mdl_button.css" type="text/css" />
    <link rel="stylesheet" href="../css/banner.css" type="text/css" />
    <link rel="icon" type="image/png" href="../images/crawford_logo.png" />
</head>
<body>
    <div class="header"></div>

    
    <div class="score_holder" style="min-width: 21em! important;">
        <div class="result">
            <p class="school_title result_elm" id="nsb_title">MHS</p>
            <p class="crawford_score result_elm"><?php echo $mhs_score.'  |  '.$nsb_score?></p>
            <p class="school_title result_elm" id="mhs_title">NSB</p>
        </div>
    </div>
    
    <table class="data_holder">
        <tbody>
            <tr class="data_row">
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Cricket</button></td>
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Debating</button></td>
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Water Polo</button></td>
            </tr>
            <tr class="data_row">
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Athletics</button></td>
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Chess</button></td>
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Music</button></td>
            </tr>
            <tr class="data_row">
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Lawn Bowls</button></td>
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Fencing</button></td>
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Futsal</button></td>
            </tr>
            <tr class="data_row">
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Table Tennis</button></td>
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Tennis</button></td>
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Badminton</button></td>
            </tr>
            <tr class="data_row">
                <td class="data_elm_holder" align="center"></td>
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Basketball</button></td>
                <td class="data_elm_holder" align="center"></td>
            </tr>
        </tbody>
    </table>

    
    
    <div class="footer">
        <div class="image_banner_commitees_parent">
            <div class="image_banner_commitees"></div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
           $(".pure-material-button-contained").click(function() {
                var content = $(this).text();
                
                // Redirect to scores
                window.location.href = "scores?sport="+content;
           });
        });
        
        
    </script>
</body>
</html>