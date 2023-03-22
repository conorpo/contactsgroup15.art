<?php include '../includes/connection.php'   ?>
<?php session_start(); ?>

<?php 
if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];
    $userId = $_SESSION["userId"];
} else {
    header('Location: /index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📞</text></svg>">
    <title>Group 15 Contacts Manager</title>
    <script>
        const userId = <?php echo $userId ?>;
    </script>
    <script src="js/dashboard.js" defer></script>
</head>
<body class="dashboard-body">

        <!-- Welcome message -->
        <h1 class="dashboard-title"><?php
            echo 'Welcome back <span>' . $username . '</span>';
        ?></h1>

        <h4 class="logout"><a  href="/logout.php">Logout</a></h4>
        

        <div class = "search" id="">
           <div class ="wrapper">
           <b> Search a Contact...</b>
           <div class="search-container">
                    <form>
                        <input id="firstNameSearch" type="text" class="first-name" placeholder="First Name">
                        <input id="lastNameSearch" type="text" class="last-name" placeholder="Last Name">
                        <input id="emailSearch" type="text" class="email" placeholder="Email">
                        <input id="phoneSearch" type="text" class=" phone-number" placeholder="Phone Number">
                        <button type = "button" onclick="SearchContacts()"> Search</button>
				    <button type = "button" onclick="ClearSearch()"> Clear</button>
                    </form>
            </div>
            </div>
        </div>

        <br>

        <div class="contactBox" id="ContactBox">
            <div class="flex-parent labels">
                <label class="flex-child first-name">First Name</label>
                <label class="flex-child last-name">Last Name</label>
                <label class="flex-child email">Email</label>
                <label class="flex-child phone-number">Phone Number</label>
                <div class="flex-child buttons"></div>
            </div>
            <div class="list-group" id="ContactList" name="ContactList">
                <div class="flex-parent list-group-item" id="InputElement">
                    <h2>Add A New Contact</h2>
                    <input placeholder="First Name" class="flex-child first-name" id="InputFirstNameContact">
                    <input placeholder="Last Name"class="flex-child last-name" id="InputLastNameContact">
                    <input placeholder="Email"class="flex-child email" id="InputEmailContact">
                    <input placeholder="Phone"class="flex-child phone-number" id="InputPhoneNumberContact">
                    <button class="save" onclick="AddNew()"></button>
                </div>
            </div>
        </div>



<div class="flex-parent list-group-item invisible" id="ContactTemplate">
    <input type="text" class="flex-child first-name">
    <input type="text" class="flex-child last-name">
    <input type="text" class="flex-child email">
    <input type="text" class="flex-child phone-number">
    <button class="save"></button>
    <button class="delete"></button>
</div>
</html>