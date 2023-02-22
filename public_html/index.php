<?php include '../includes/connection.php' ?>
<?php session_start(); ?>

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

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📞</text></svg>">
        <title>Group 15 Contacts Manager</title>


        <link rel="stylesheet" href="stylesheet.css">
        <script src="js/script.js" defer></script>

    </head>

    <body class="login-body">
        <div class="main-banner">
            <h1>Welcome To</h1>
            <h2>Contacts Manager</h2>
            <div class="button-holder">
                <button class="login" id="login_button">Sign In</button>
                <button class="register" id="register_button">Register</button>
            </div>
        </div>

        <div class="form login invisible" id="login">
            <form id="login_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" value="Submit" name="submit_login" class="submit">
            </form>
        </div>

        <div class="form register invisible" id="register">
            <form id="register_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method = "POST">
                <input type="text" name="username" placeholder="Username">

                <input type="password" name="password" placeholder="Password" onkeyup="ShowPassTheSame()">
                <input type="password" name="confirmPass" placeholder="Confirm Pass" onkeyup="ShowPassTheSame()">
                
                <label id="passTheSame" name="passTheSame" style="display:none;">Passwords must be the same</label>

                <input type="submit" value="Submit" name="submit_reg" class="submit">
            </form>
        </div>
    </body>
</html>
