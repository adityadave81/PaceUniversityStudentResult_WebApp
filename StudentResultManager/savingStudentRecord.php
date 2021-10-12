<?php

require_once("config.php");

$studentname= $_POST['stn'];
$schoolname= $_POST['sn'];
$fathersname=$_POST['fn'];
$dob= $_POST['dob'];
$gender= $_POST['gen'];
$hindi= $_POST['hin'];
$english= $_POST['eng'];
$maths= $_POST['math'];
$physics= $_POST['phy'];
$chemistry= $_POST['chem'];

$newrecord = createStudentRecord($studentname, $schoolname, $fathersname, $dob, $gender, $hindi, $english, $maths, $physics, $chemistry);

echo "Student Record Created Successfully !";
echo $newrecord;
?>