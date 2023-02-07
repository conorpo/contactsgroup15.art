<?php include '../includes/connection.php' ?>

<?php

session_start();

?>


<!DOCTYPE html>
<html>

<head>
</head>

<body>
	<h1>Contact Manager</h1>

	<!--
		WARNING THE FOLLOWING PHP CODE IS DISGUSTING,
		I AM STILL LEARNING HOW THIS WORKS, LOGIN AND REGISTER WILL BE CLEANER LATER BUT JUST GOT IT DONE FOR NOW
	-->

	<?php
		if (isset($_POST['submit_reg'])) {
			$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
			$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$result = mysqli_query($conn,"SELECT * FROM Users WHERE username = '" . $username . "'");
			if($result){
				if(count(mysqli_fetch_all($result)) >= 1){
					echo "Username already exists";
				}else{
					if(mysqli_query($conn, "INSERT INTO Users (username, hash) VALUES ('$username','$hash')")){
						$_SESSION['username'] = $username;
					} else {
						echo 'Error: ' . mysqli_error($conn);
					}
				}
			}else{
				echo 'Error: ' . mysqli_error($conn);
			}
		}
		
		if (isset($_POST['submit_login'])) {
			$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
			$password = $_POST['password'];

			$result = mysqli_query($conn,"SELECT * FROM Users WHERE username = '" . $username . "'");
			if($result){
				$user = mysqli_fetch_all($result, MYSQLI_ASSOC);
				if(!empty($user)){
					if(password_verify($password, $user[0]['hash'])){
						$_SESSION['username'] = $username;
					}else{
						echo "Incorrect Password";
					}
				}else{
					echo "User doesnt exist";
				}
			}else{
				echo 'Error: ' . mysqli_error($conn);
			}
		}
	?>
	
	<?php if (!isset($_SESSION['username'])) { ?>

		<h2>Do not put your real information here!!</h2>
		<button id="openSignInButton" onclick="ShowSignInForm()">Sign In</button>
		<button id="openResistrationButton" onclick="ShowRegistrationForm()">Register</button>
		<form id="sign-in" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" style="display:none;">
			<label for="username">Username:</label><br>
			<input type="text" name="username"><br>
			<label for="passSign">Password:</label><br>
			<input type="password" name="password"><br>
			<input type="submit" value="Submit" name="submit_login">
		</form>

		<form id="register" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method = "POST" style="display:none;">
			<label for="username">Username:</label><br>
			<input type="text" name="username"><br>

			<label for="passReg">Password:</label><br>
			<input type="password" name="password" onkeyup="ShowPassTheSame()"><br>
			<label for="confirmReg">Confirm Password:</label><br>
			<input type="password" name="confirmPass" onkeyup="ShowPassTheSame()"><br>
			
			<label id="passTheSame" name="passTheSame" style="display:none;">Passwords must be the same</label>

			<input type="submit" value="Submit" name="submit_reg">
		</form>

	<?php } else { 
		$username = $_SESSION['username'];?>
		
		Welcome Back <?php echo $username?>
		<br><a href="/logout.php">Logout</a>
	<?php } ?>
	<script src="script.js"></script>
	<link rel="stylesheet" href="style.css">
	
</body>

</html>