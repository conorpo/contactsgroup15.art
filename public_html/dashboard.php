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
    <script src="js/dashboard.js" defer></script>
</head>
<body class="dashboard-body">

        <!-- Welcome message -->
        <h1 class="dashboard-title"><?php
            echo 'Welcome back <span>' . $username . '</span>';
        ?></h1>

        <!-- Open a new dialogue to create a new contact -->
        <button id="AddNew" onclick="AddNew()">Add New</button>
        <p></p>

        <a href="/logout.php">Logout</a>


        <!-- Should be hidden until AddNew() is called -->
        <div class="addContactBox" id="addNewForContactBox">
            <div class="flex-parent labels" id="addNew">
                <label class="flex-child first-name">First Name</label>
                <label class="flex-child last-name">Last Name</label>
                <label class="flex-child email">Email</label>
                <label class="flex-child phone-number">Phone Number</label>
                <div class="flex-child buttons"></div>
            </div>
            <br>
            <div class="flex-parent" id="">
                <input class="flex-child first-name" id="InputFirstNameContact">
                <input class="flex-child last-name" id="InputLastNameContact">
                <input class="flex-child email" id="InputEmailContact">
                <input class="flex-child phone-number" id="InputPhoneNumberContact">
                <div class="flex-child buttons">
                    <button id="EditContact1" onclick="EditContact(1)">Edit</button>
                    <!-- Hidden Button -->
                    <button id="SaveContact1" onclick="SaveContact(1)">Save</button>
                    <button onclick="DeleteContact(1)">Delete</button>
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
            <ul class="list-group" id="ContactList">
                
            </ul>
        </div>

</body>

<li class="list-group-item flex-parent invisible" id="ContactTemplate">
    <input class="flex-child first-name">
    <input class="flex-child last-name">
    <input class="flex-child email">
    <input class="flex-child phone-number">
    <div class="flex-child buttons">
        <button>Save</button>
        <button>Delete</button>
    </div>
</li>
</html>