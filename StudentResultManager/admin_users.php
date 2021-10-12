<?php


require_once("config.php");
?>


<html>
<head>
    <title>My Application</title>
</head>
<body>
<table>
    <tr><th>Perform Operations:</th></tr>


    <?php if(isUserLoggedIn()) { ?>


        <?php }  if($loggedInUser->roles === 'admin') { ?>
        <tr><td><a href="display.php">(R)ead Display All Users </a></td></tr>

        <?php } ?>



</table>
</body>
</html>
