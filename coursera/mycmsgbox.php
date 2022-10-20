<?php  include('mycserver.php') ?>
<?php
session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: myclogin.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: myclogin.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Message Box</title>
	<link rel="stylesheet" type="text/css" href="mycstyle.css">
</head>
<body>

<div class="header">
	<h2>Coursera Message Box</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        <br />
        Coursera Secure Messaging System [CSMS]<br /><br />

		<div class="content">
			This is the list of Received Messages:
			<table>
				<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Sender</th>
					<th>Reciever</th>
					<th>Message</th>
					<th>Timestamp</th>
					<th>Tag</th>
				</tr>

				<?php
				// fetch the IDs, usernames and emails of users
				$msg_check_query = 'select * from mypm where mysender ="'.$_SESSION['username'].'" or myreciever="'.$_SESSION['username'].'" order by mytimestamp desc';
  				// echo $msg_check_query;
				$result = mysqli_query($db, $msg_check_query);
  				while ($user = mysqli_fetch_assoc($result))
				{
				?>

				<tr>
					<td class="left"><?php echo $user['myid']; ?></td>
					<td class="left"><?php echo htmlentities(base64_decode(base64_decode($user['mytitle'])), ENT_QUOTES, 'UTF-8'); ?></td>
					<td class="left"><?php echo htmlentities($user['mysender'], ENT_QUOTES, 'UTF-8'); ?></td>
					<td class="left"><?php echo htmlentities($user['myreciever'], ENT_QUOTES, 'UTF-8'); ?></td>
					<td class="left"><?php echo htmlentities(base64_decode(base64_decode($user['mymessage'])), ENT_QUOTES, 'UTF-8'); ?></td>
					<td class="left"><?php echo htmlentities(date("Y-m-d H:i:s",$user['mytimestamp']), ENT_QUOTES, 'UTF-8'); ?></td>
					<td class="left"><?php echo htmlentities($user['mytag'], ENT_QUOTES, 'UTF-8'); ?></td>
				</tr>

				<?php
				}
				?>
			</table>
		</div>


        <p> <a href="index.php"  style="color: blue;">Home</a> </p>
        <p> <a href="mycusers.php"  style="color: blue;">List of all users for messaging</a> </p>
        <p> <a href="mycmsgbox.php"  style="color: blue;">List of all messages</a> </p>
        <p> <a href="mycnpm.php"  style="color: blue;">Write new personal message</a> </p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>