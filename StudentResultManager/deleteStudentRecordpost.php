<?php

require_once("config.php");
$name = $_POST['name'];
$marks1 = deleteStudentrecord($name);

    echo "Student Record Deleted !";

?>
