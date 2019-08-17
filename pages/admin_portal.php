<?php
    if (isset($_COOKIE["logged_in"])) {
		header("Location: data_entry?file=".$_COOKIE["logged_in"]);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Crawford | Admin</title>
    <meta name="description" content="Homepage for Crawford website">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link href="../css/home.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="../css/mdl_button.css" type="text/css" />
    <link rel="stylesheet" href="../css/banner.css" type="text/css" />
    <link rel="icon" type="image/png" href="../images/crawford_logo.png" />
</head>
<body>
    <div class="header"></div>

    
    <div class="score_holder" style="font-size: 1.5em;padding-left: 1.3em;padding-right: 1.3em;">
        <p>NSBHS Crawford Data Entry</p>
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
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Basketball</button></td>
                <td class="data_elm_holder" align="center"></td>
                <td class="data_elm_holder" align="center"><button id="sport_button" class="pure-material-button-contained">Total</button></td>
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
                window.location.href = "admin_login?dest_dir="+content;
           });
        });
    </script>
</body>
</html>