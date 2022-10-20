<?php  include('../mycserver.php') ?>


<html>
	<head>
		<title>Database Dump Creation Tool</title>
	</head>
	<body>

<?php
//We display all tables
//
//Users
//We get all rows of users
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
echo "<br><h1>user</h1><BR>";
echo "id,username,password,e-mail,salt<BR>";

// fetch the IDs, usernames and emails of users
$user_check_query = "SELECT * FROM myusers order by 1";
$result = mysqli_query($db, $user_check_query);
while ($user = mysqli_fetch_assoc($result))
{
?>
<?php echo htmlentities($user['myid'], ENT_QUOTES, 'UTF-8');?>,
<?php echo htmlentities($user['myusername'], ENT_QUOTES, 'UTF-8');?>,
<?php echo htmlentities($user['mypassword'], ENT_QUOTES, 'UTF-8');?>,
<?php echo htmlentities($user['myemail'], ENT_QUOTES, 'UTF-8');?>,
<?php echo htmlentities($user['mysalt'], ENT_QUOTES, 'UTF-8');?><br>
<?php
}
?>
<?php

//Messages
//We get all rows of Messages
echo "<BR><h1>PersonalMessages</h1><BR>";
echo "id,sender,recipient,title,message,timestamp,tag<BR>";
// fetch the IDs, usernames and emails of users
$user_check_query = "SELECT * FROM mypm order by 1";
$result = mysqli_query($db, $user_check_query);
while ($user = mysqli_fetch_assoc($result))
{
?>
<?php echo htmlentities($user['myid'], ENT_QUOTES, 'UTF-8');?>,
<?php echo htmlentities($user['mysender'], ENT_QUOTES, 'UTF-8');?>,
<?php echo htmlentities($user['myreciever'], ENT_QUOTES, 'UTF-8');?>,
<?php echo htmlentities($user['mytitle'], ENT_QUOTES, 'UTF-8');?>,
<?php echo htmlentities($user['mymessage'], ENT_QUOTES, 'UTF-8');?>,
<?php echo htmlentities(date("Y-m-d H:i:s",$user['mytimestamp']), ENT_QUOTES, 'UTF-8');?>,
<?php echo htmlentities($user['mytag'], ENT_QUOTES, 'UTF-8');?><br>
<?php
}
?>

	</body>
</html>
