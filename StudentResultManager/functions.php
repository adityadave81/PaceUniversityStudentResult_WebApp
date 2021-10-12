<?php

//$password = md5("Smith");
//echo $password."<br><br>";
//$code = md5(uniqid(rand(), TRUE));

//echo $code;


//Generate a unique code
/**
 * @param string $length
 * @return string
 */
function getUniqueCode($length = "")
{
    $code = md5(uniqid(rand(), TRUE));
    if ($length != "") {
        return substr($code, 0, $length);
    } else {
        return $code;
    }
}


//$plainText = getUniqueCode(15);
//echo $plainText;


/**
 * @param $plainText
 * @param null $salt
 * @return string
 */
function generateHash($plainText, $salt = NULL)
{
    echo "plain text =" . $plainText . "<br><br>";
    if ($salt === NULL) {
        $salt = substr(md5(uniqid(rand(), TRUE)), 0, 25);
        echo "salt when salt is null : " . $salt . "<br><br>";
    } else {
        echo "salt before substr : " . $salt . "<br><bR>";
        $salt = substr($salt, 0, 25);
        echo "just salt : " . $salt . "<br><bR>";
    }
    echo "return salt : " . $salt . "<br><br>";
    echo "return sha ( salt ) : " . sha1($salt) . "<br><br>";
    echo "return sha ( plaintext ) : " . sha1($plainText) . "<br><br>";
    echo "return sha ( satl + plaintext ) : " . sha1($salt . $plainText) . "<br><br>";
    echo "return salt . sha1 ( salt + plaintext ) : " .  $salt . sha1($salt . $plainText) . "<br><br>";

    return $salt . sha1($salt . $plainText);
}


//echo $newpassword;
//$compare = generateHash($_POST['password'], $newpassword);

//echo $compare;

/**
 * @param $username
 * @param $firstname
 * @param $lastname
 * @param $email
 * @param $password
 * @return bool
 */
function createNewUser($username, $firstname, $lastname, $email, $password)
{
    global $mysqli, $db_table_prefix;
    //Generate A random userid

    $character_array = array_merge(range(a, z), range(0, 9));
    $rand_string = "";
    for ($i = 0; $i < 6; $i++) {
        $rand_string .= $character_array[rand(
            0, (count($character_array) - 1)
        )];
    }

    $rand_string = getUniqueCode(10);
    //echo $rand_string;
    //echo $username;
    //echo $firstname;
    //echo $lastname;
    //echo $email;
    //echo $password;

    $newpassword = generateHash($password);

    echo $newpassword;


    $stmt = $mysqli->prepare(
        "INSERT INTO " . $db_table_prefix . "userdetails (
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
		Password,
		MemberSince,
		Active,
		roles
		)
		VALUES (
		'" . $rand_string . "',
		?,
		?,
		?,
		?,
		?,
        '" . time() . "',
        1,
        'new_user'
		)"
    );
    $stmt->bind_param("sssss", $username, $firstname, $lastname, $email, $newpassword);
    print_r($stmt);
    $result = $stmt->execute();
    print_r($result);
    $stmt->close();
    return $result;

}

//Retrieve complete user information by username
/**
 * @param $username
 * @return array
 */
function fetchUserDetails($username)
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
		Password,
		MemberSince,
		Active,
        roles
		FROM " . $db_table_prefix . "userdetails
		WHERE
		UserName = ?
		LIMIT 1");
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->bind_result($UserID, $UserName, $FirstName, $LastName, $Email, $Password, $MemberSince, $Active, $Roles);
    while ($stmt->fetch()) {
        $row = array('UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active,
            'Roles' => $Roles
            );
    }
    $stmt->close();
    return ($row);
}


//Check if a user is logged in
/**
 * @return bool
 */
function isUserLoggedIn()
{
    global $loggedInUser, $mysqli, $db_table_prefix;

    //if ($loggedInUser == NULL) {
       // return false;
   // }
    $stmt = $mysqli->prepare("SELECT
		UserID,
		Password
		FROM " . $db_table_prefix . "userdetails
		WHERE
		UserID = ?
		AND
		Password = ?
		AND
		active = 1
		LIMIT 1");
    $stmt->bind_param("ss", $loggedInUser->user_id, $loggedInUser->hash_pw);
    $stmt->execute();
    $stmt->store_result();
    $num_returns = $stmt->num_rows;
    $stmt->close();

    if ($loggedInUser == NULL) {
        return false;
    } else {
        if ($num_returns > 0) {
            return true;
        } else {
            destroySession("ThisUser");
            return false;
        }
    }
}


//Destroys a session as part of logout
/**
 * @param $name
 */
function destroySession($name)
{
    if (isset($_SESSION[$name])) {
        $_SESSION[$name] = NULL;
        unset($_SESSION[$name]);
    }
}


//Retrieve complete user information of all users
/**
 * @return array
 */
function fetchAllUsers()
{

    global $mysqli, $db_table_prefix;
    $stmt = $mysqli->prepare("SELECT
		UserID,
		UserName,
		FirstName,
		LastName,
		Email,
		Password,
		MemberSince,
		Active,
        roles
		FROM " . $db_table_prefix . "userdetails"
    );

    $stmt->execute();
    $stmt->bind_result($UserID, $UserName, $FirstName, $LastName, $Email, $Password, $MemberSince, $Active, $Roles);
    while ($stmt->fetch()) {
        $row[] = array('UserID' => $UserID,
            'UserName' => $UserName,
            'FirstName' => $FirstName,
            'LastName' => $LastName,
            'Email' => $Email,
            'Password' => $Password,
            'MemberSince' => $MemberSince,
            'Active' => $Active,
            'roles' => $Roles
    );
    }
    $stmt->close();
    return ($row);
}

function readStudentInfo($name)
{
    global $mysqli;
    $stmt = $mysqli->prepare(
        "
    SELECT
    StudentName,
    StudentSchool,
    FathersName,
    DOB,
    Gender,
    Hindi,
    English,
    Maths,
    Physics,
    Chemistry

    FROM students
    WHERE
    StudentName = ?
    "
    );
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->bind_result($studentname, $schoolname, $fathername, $dob, $gender, $hindi, $english, $maths, $physics, $chemistry);

    while ($stmt->fetch()) {
        $row[] = array(
            'studentname'            => $studentname,
            'schoolname'             => $schoolname,
            'fathername'             => $fathername,
            'dob'                    => $dob,
            'gender'                 => $gender,
            'hindi'                  => $hindi,
            'english'                => $english,
            'maths'                  => $maths,
            'physics'                => $physics,
            'chemistry'              => $chemistry
        );
    }

    //print_r($row);
    $stmt->close();
    return ($row);
}


function createStudentRecord($studentname, $schoolname, $fathersname, $dob, $gender, $hindi, $english, $maths, $physics, $chemistry)
{
    global $mysqli;

    $stmt = $mysqli->prepare(
        "INSERT INTO students (
		studentname,
		studentschool,
		fathersname,
		dob,
		gender,
		hindi,
		english,
		maths,
		physics,
		chemistry
		)
		VALUES (
		?,
		?,
		?,
		?,
		?,
		?,
        ?,
        ?,
        ?,
        ?
		)"
    );
    $stmt->bind_param("ssssssssss", $studentname, $schoolname, $fathersname, $dob, $gender, $hindi, $english, $maths, $physics, $chemistry);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}


function deleteStudentRecord ($name){
    global $mysqli;
    $stmt = $mysqli->prepare(
        "
    DELETE FROM students 
    WHERE
    studentname = ?"
    );
    $stmt->bind_param("s", $name);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}





