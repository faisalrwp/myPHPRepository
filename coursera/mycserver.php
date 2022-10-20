<?php
session_start();

// initializing variables
// $mydb = 'localhost:3306';	// db URL
// $myuser = 'khawajag_user';						// user
// $mypassword = 't7tl4KGQEP#e';							// password
// $myschema = 'khawajag_coursera';				// schema

$mydb = 'localhost:3306';	// db URL
$myuser = 'root';						// user
$mypassword = '';							// password
$myschema = 'test';				// schema

$message = "";
$reciever = "";
$title = "";

$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect($mydb, $myuser, $mypassword, $myschema);

// REGISTER USER
if (isset($_POST['reg_user'])) 
{
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {	array_push($errors, "The two passwords do not match"); }
  if (strlen($password_1) < 10) { array_push($errors, "Password must be at least 10 characters long"); }
  if (!preg_match("#[0-9]+#", $password_1)) { array_push($errors, "Password must include at least one number!"); }
  if (!preg_match("#[a-zA-Z]+#", $password_1)) { array_push($errors, "Password must include at least one letter!"); }
  if (!preg_match("#[a-z]+#", $password_1)) { array_push($errors, "Password must include at least one lowercase letter!"); }
  if (!preg_match("#[A-Z]+#", $password_1)) { array_push($errors, "Password must include at least one uppercase letter!"); }
  if (!preg_match("#\W+#", $password_1)) { array_push($errors, "Password must include at least one symbol!"); }


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM myusers WHERE myusername='$username' OR myemail='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) 
  { // if user exists
    if ($user['myusername'] === $username) { array_push($errors, "Username already exists"); }
    if ($user['myemail'] === $email) { array_push($errors, "email already exists"); }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) 
  {
  	$password = $password_1;//encrypt the password before saving in the database
    $salt	  = (string)rand(10000, 99999);
    //$password = hash("sha512", $salt.$password); // compute the hash of salt concatenated to password
    $pass1=md5($password);
    $pass2=md5($pass1);
  	$query = "INSERT INTO myusers (myusername, myemail, mypassword, mysalt) 
  			  VALUES('$username', '$email', '$pass2', '$salt')";
    // echo "<br>".$query."<br>";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// ... 


// New Message
if (isset($_POST['new_msg'])) 
{
  echo "in new message";
  $reciever = mysqli_real_escape_string($db, $_POST['reciever']);
  $title = mysqli_real_escape_string($db, $_POST['title']);
  $message = mysqli_real_escape_string($db, $_POST['message']);
  $sender =  mysqli_real_escape_string($db, $_POST['sender']);

  if (empty($reciever)) { array_push($errors, "Message Reciever is required"); }
  if (empty($title)) { array_push($errors, "Message Title is required"); }
  if (empty($message)) { array_push($errors, "Message Content is required"); }
  if (empty($sender)) { array_push($errors, "Message Sender is required"); }

  if (count($errors) == 0) 
  {
    $query = "SELECT * FROM myusers WHERE myusername='$reciever'";
    $results = mysqli_query($db, $query);
    if (!$results)  { array_push($errors, "User [".$reciever."]  to identify the reciever"); }
    else
    {
      if (mysqli_num_rows($results) == 1) 
      {
        //We encrypt then send the message
        $etit1		= base64_encode($title); // hardcoded random iv with 256 bits
        $emsg1  = base64_encode($message); // hardcoded random key with 256 bits
        $etit2		= base64_encode($etit1); // hardcoded random iv with 256 bits
        $emsg2  = base64_encode($emsg1); // hardcoded random key with 256 
        $tim=time();
        $query = "INSERT INTO mypm (mytitle, mysender, myreciever, mymessage, mytimestamp, mytag) VALUES ('".$etit2."', '".$sender."', '".$reciever."', '".$emsg2."', '".$tim."',0 )";
        mysqli_query($db, $query);

        $_SESSION['success'] = "Message sent successfully";
        header('location: index.php');
      }
      else { array_push($errors, "Unable to identify the reciever"); }
    }
  }
}
 



// ... 

// LOGIN USER
if (isset($_POST['login_user'])) 
{
  // echo "in login user ";

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  if (count($errors) == 0) 
  {
    $pass1 = md5($password);
    $pass2 = md5($pass1);
    // echo $password;
    $query = "SELECT * FROM myusers WHERE myusername='$username' AND mypassword='$pass2'";
    $results = mysqli_query($db, $query);
    if (!$results) 
    {
        // echo "<p> Query [$query] couldn't be executed </p>";
        array_push($errors, "Wrong username/password combination");
    }
    else
    {
      if (mysqli_num_rows($results) == 1) 
      {
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
      }
      else 
      {
        // echo "error : ".$query;
        array_push($errors, "Wrong username/password combination");
        // array_push($errors, "Error : ".   $password);

      }
    }
  }
}
?>