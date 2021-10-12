
<?php
// Links for logged in user
if (isUserLoggedIn()) { ?>

    <ul>
        <li><a href='myaccount.php'>Account Home</a></li>
        <li><a href='logout.php'>Logout</a></li>
        <li><a href='admin_users.php'>Admin Users</a></li>

    </ul>

    <?php if($loggedInUser->roles === 'student') { ?>
        <li><a href="searchByName.php">Display Marksheet</a></li>

    <?php } else if($loggedInUser->roles === 'teacher') { ?>
        <li><a href="searchByName.php">Display Marksheet</a></li>
        <li><a href="createNewStudentRecord.php">Create New Student Records</a></li>
        <li><a href="deleteStudentRecord.php">Delete Student Records</a></li>
        <?php } ?>





<?php } else { ?>

    <ul>
        <li><a href='index.php'>Home</a></li>
        <li><a href='login.php'>Login</a></li>
    </ul>
<?php } ?>
