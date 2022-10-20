<?php include('mycserver.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="mycstyle.css">
</head>
<body>
	    


  <div class="header">
  	<h2>Register</h2>
  </div>
  <div class="content">

  <!-- logged in user information -->
  <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
        <br />
        Coursera Secure Messaging System [CSMS]<br /><br />
  <form method="post" action="mycnpm.php">
  	<?php include('mycerror.php'); 	$sender =$_SESSION['username']; ?>
	  <div class="input-group">
  	  <label>Sender <?php echo $sender; ?></label>
	<input type="text" readonly = true  name="sender" value="<?php echo $sender; ?>">

  	</div>
  	<div>
  	  <label>Reciever</label>
	  <select style="font: size 16px;" name = "reciever"> 
	  <?php
	  $user_check_query = "SELECT * FROM myusers";
		$result = mysqli_query($db, $user_check_query);
		while ($user = mysqli_fetch_assoc($result))
		{
		?>
			<option style="font: size 16px;" value = "<?php echo htmlentities($user['myusername'], ENT_QUOTES, 'UTF-8'); ?> "> <?php echo htmlentities($user['myusername'], ENT_QUOTES, 'UTF-8'); ?> </option>
		<?php
		}
		?>

  </select>
  	</div>
  	<div class="input-group">
  	  <label>Title</label>
  	  <input type="text" name="title" value="<?php echo $title; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Message</label>
  	  <input type="text" name="message" value="<?php echo $message; ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="new_msg">Send</button>
  	</div>
  	<p>


  </form>
  <p> <a href="index.php"  style="color: blue;">Home</a> </p>
        <p> <a href="mycusers.php"  style="color: blue;">List of all users for messaging</a> </p>
        <p> <a href="mycmsgbox.php"  style="color: blue;">List of all messages</a> </p>
        <p> <a href="mycnpm.php"  style="color: blue;">Write new personal message</a> </p>
    	<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>

		<?php endif ?>
  </div>

</body>
</html>