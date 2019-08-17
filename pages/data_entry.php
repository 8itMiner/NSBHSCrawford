<?php
    require '../main.php';
    
    // Handle logouts
    if (isset($_POST["logout_resq"]) && $_POST["logout_resq"] == "logout") {
        unset($_COOKIE['logged_in']);
        setcookie('logged_in', null, -1, '/');
        header("Location: admin_portal");
    }
    
    
    // Kick off the user if they are not allowed here
    if ($_COOKIE["logged_in"] != $_GET["file"]){
         header("Location: admin_login?dest_dir=".$_GET["file"]);
    }
    // Kick off the user if no file is specified
    if (!isset($_GET["file"])) {
        header("Location: admin_portal");
    }
    
    $file = $_GET["file"];
    $fileDir = __DIR__ . '/../data/' . $file . '.json';
    $data = file_get_contents($fileDir);
    
    
    // Determine if the user is posting a new file to be saved
    if (isset($_POST["contents"])) {
        $contents = $_POST["contents"];
        if (json_decode($contents) == null){
            exit(header("HTTP/1.1 500"));
        }
        
        file_put_contents($fileDir, $_POST["contents"]);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Crawford Shield</title>
    <style type="text/css" media="screen">
        #editor { 
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
    </style>
    <link rel="stylesheet" href="../css/mdl_button.css" type="text/css" />
</head>
<body style="background: #272822;">
<form action="" method="post">  
    <input type='hidden' id='hiddenField' name='logout_resq' value='logout'>
    <button id="sport_button" style="min-width: 20% !important"class="pure-material-button-contained">Exit</button>
</form>
<div id="editor" style="margin-top: 12em"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.3.3/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/json");
	editor.setOption("showPrintMargin", true);
	
	// Set the value
	var fileData = <?php echo json_encode($data, JSON_HEX_TAG); ?>;
	editor.setValue(fileData, -1);
	
	
	saveFile = function() {
        var contents = editor.getSession().getValue();
    
        $.post("data_entry?file=<?php echo $file ?>", 
                {contents: contents },
                function(){
                    alert('File was saved.');
                }
        ).fail(function(){
            alert('Invalid json file, file was not saved.');
        });
    };

	
	
	editor.commands.addCommand({
        name: "save",
        bindKey: {
            win: "Ctrl-S",
            mac: "Command-S",
            sender: "editor|cli"
        },
        exec: function() {
            saveFile();
        }
    });
    
    
    
    window.onbeforeunload = confirmExit;
    function confirmExit() {
        return "You have attempted to leave this page. Please hit ctrl+s before leaving.";
    }
</script>
</body>
</html>
