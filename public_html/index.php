<?php include '../includes/connection.php' ?>
<?php session_start(); ?>


<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<h1>Contact Manager</h1>

	<?php 
	if (isset($_SESSION['username'])) {
		header('Location: /dashboard.php');
	}

	if (isset($_POST['username'])) {
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
		$password = $_POST['password'];
		$result = mysqli_query($conn, "SELECT * FROM Users WHERE username = '" . $username . "'");

		function register()
		{
			global $result, $conn, $username, $password;
			$hash = password_hash($password, PASSWORD_DEFAULT);

			if (!$result)
				return 'Error: ' . mysqli_error($conn);
			if (count(mysqli_fetch_all($result)) >= 1)
				return "Username already exists.";
			if (!mysqli_query($conn, "INSERT INTO Users (username, hash) VALUES ('$username','$hash')"))
				return 'Error: ' . mysqli_error($conn);

			$_SESSION['username'] = $username;
			header('Location: /dashboard.php');
		}

		function login()
		{
			global $result, $conn, $username, $password;

			if (!$result)
				return 'Error: ' . mysqli_error($conn);
			
			$user = mysqli_fetch_all($result, MYSQLI_ASSOC);

			if (empty($user))
				return "User doesn't exist";
			if (!password_verify($password, $user[0]['hash']))
				return "Incorrect Password";
			
			$_SESSION['username'] = $username;
			header('Location: /dashboard.php');
		}

		$login_error;
		if (isset($_POST['submit_reg']))
			$login_error = register();
		if (isset($_POST['submit_login']))
			$login_error = login();

		echo $login_error;
	}
	?>
	

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

	<script src="script.js"></script>
	<link rel="stylesheet" href="style.css">
</body>

</html>