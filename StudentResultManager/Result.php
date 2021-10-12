<html>
<?php

require_once("config.php");
$name = $_POST['name'];
$marks1 = readStudentInfo($name);



foreach ($marks1 as $marks) {
    $total = $marks['hindi'] + $marks['english'] + $marks['maths'] + $marks['physics'] + $marks['chemistry'];
    $remark1 = 0;
    $remark2 = 0;
    $remark3 = 0;
    $remark4 = 0;
    $remark5 = 0;
    $count = 0;
    $s = "a";
    $gen = '';
    $min = 35;
    $max = 100;
    $hin = 'Hindi';
    $eng = 'English';
    $math = 'Maths';
    $phy = 'Physics';
    $chem = 'Chemistry';

    if ($marks['gender'] == "Male") {
        $gen = "S/o";
    } else if ($marks['gender'] == "Female") {
        $gen = "D/o";
    }
    if ($marks['hindi'] < 35) {
        $remark1 = "<font color='red'>*</font>";
        $count++;
        $s = $s . ' and ' . $hin;
    } else if ($marks['hindi'] > 79) {
        $remark1 = "<font color='green'>D</font>";
    } else {
        $remark1 = '-';
    }

    if ($marks['english'] < 35) {
        $remark2 = "<font color='red'>*</font>";
        $count++;
        $s = $s . ' and ' . $eng;
    } else if ($marks['english'] > 79) {
        $remark2 = "<font color='green'>D</font>";
    } else {
        $remark2 = '-';
    }

    if ($marks['maths'] < 35) {
        $remark3 = "<font color='red'>*</font>";
        $count++;
        $s = $s . ' and ' . $math;
    } else if ($marks['maths'] > 79) {
        $remark3 = "<font color='green'>D</font>";
    } else {
        $remark3 = '-';
    }

    if ($marks['physics'] < 35) {
        $remark4 = "<font color='red'>*</font>";
        $count++;
        $s = $s . ' and ' . $phy;
    } else if ($marks['physics'] > 79) {
        $remark4 = "<font color='green'>D</font>";
    } else {
        $remark4 = '-';
    }

    if ($marks['chemistry'] < 35) {
        $remark5 = "<font color='red'>*</font>";
        $count++;
        $s = $s . ' and ' . $chem;
    } else if ($marks['chemistry'] > 79) {
        $remark5 = "<font color='green'>D</font>";
    } else {
        $remark5 = '-';
    }

    $s = str_replace('a and', '', $s);
    if ($count > 2) {
        $s = "Fail";
    } else if ($count == 0) {
        $s = "Pass";
    } else if ($count <= 2) {
        $s = "Compartment in " . ' ' . $s;
    }
}?>


<center>
    <table border=1>
        <?php foreach ($marks1 as $marks){ ?>
        <tr>
            <td>
                <table  width=100%>
                    <tr>
                        <td>
                            <img src='pacelogo.png' width=120 height=120>
                        </td>
                        <td>
                            <b><font size='5'>Seidenberg School of Computer Science and Information Systems</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><br><br>
                            <font size='4' color='black'><b><?php print "Student Transcript"; ?></b></font>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width=100%>
                    <tr><td><font size='4'><?php echo $marks['studentname']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$gen";?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo" Mr.".$marks['fathername'];?></font></td></tr>
                    <tr><td><font size='4'><?php echo $marks['dob'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print $marks['gender'];?></font></td></tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table border=1 width=100%>
                    <tr><th><i>Subject code</i></th><th><i>Subject name</i></th><th><i>Min marks</i></th><th><i>Max marks</i></th><th><i>Marks obtained</i></th><th><i>Remark</i></th></tr>
                    <tr><td>101</td><td>Hindi</td><td>35</td><td>100</td><td><?php echo $marks['hindi']; ?></td><td><?php echo "$remark1"; ?></td></tr>
                    <tr><td>102</td><td>English</td><td>35</td><td>100</td><td><?php echo $marks['english']; ?></td><td><?php echo "$remark2"; ?></td></tr>
                    <tr><td>103</td><td>Maths</td><td>35</td><td>100</td><td><?php echo $marks['maths']; ?></td><td><?php echo "$remark3"; ?></td></tr>
                    <tr><td>104</td><td>Physics</td><td>35</td><td>100</td><td><?php echo $marks['physics']; ?></td><td><?php echo "$remark4"; ?></td></tr>
                    <tr><td>105</td><td>Chemistry</td><td>35</td><td>100</td><td><?php echo $marks['chemistry']; ?></td><td><?php echo "$remark5"; ?></td></tr>
                    <tr><td></td><td></td><td><b>Total</b></td><td><b>500</b></td><td><b><?php echo "$total"; ?><b></td><td></td></tr>
                </table>
            </td>
        </tr>

        <tr>
            <td>
                <table>
                    <tr><td><b><font size='4'>Result:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$s"; ?></font></b></td></tr>
                </table>
            </td>
        </tr>
    <?php } ?>
    </table>
</center>

</html>

