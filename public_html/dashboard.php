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

        <a href="/logout.php">Logout</a>
        
        <div class = "search" id="">
            <div class = "flex-parent" id="">
                <form>
                    <input type = "text" placeholder= "Search Contact...">
                    <button type = "submit" onclick="SearchContacts()"> Search</button>
                </form>
            </div>
        </div>

        <!-- Should be hidden until AddNew() is called -->
        <!-- <div class="addContactBox" id="addNewForContactBox">
            <div class="flex-parent labels" id="addNew">
                <label class="flex-child first-name">First Name</label>
                <label class="flex-child last-name">Last Name</label>
                <label class="flex-child email">Email</label>
                <label class="flex-child phone-number">Phone Number</label>
                <div class="flex-child buttons"></div>
            </div>
            <br>
            <div class="flex-parent" id="">
                <input class="flex-child first-name" id="InputFirstNameContact" name="InputFirstNameContact">
                <input class="flex-child last-name" id="InputLastNameContact">
                <input class="flex-child email" id="InputEmailContact">
                <input class="flex-child phone-number" id="InputPhoneNumberContact">
                <div class="flex-child buttons">
                    <button id="EditContact1" onclick="EditContact(1)">Edit</button>
                    
                    <button id="SaveContact1" onclick="AddNew()">Save</button>
                    <button onclick="DeleteContact(1)">Delete</button>
                </div>
            </div>
        </div> -->
        <br>

        <div class="contactBox" id="ContactBox">
            <div class="flex-parent labels">
                <label class="flex-child first-name">First Name</label>
                <label class="flex-child last-name">Last Name</label>
                <label class="flex-child email">Email</label>
                <label class="flex-child phone-number">Phone Number</label>
                <div class="flex-child buttons"></div>
            </div>
            <ul class="list-group" id="ContactList" name="ContactList">
                <div class="list-group-item flex-parent" id="InputElement">
                    <input class="flex-child first-name" id="InputFirstNameContact">
                    <input class="flex-child last-name" id="InputLastNameContact">
                    <input class="flex-child email" id="InputEmailContact">
                    <input class="flex-child phone-number" id="InputPhoneNumberContact">
                    <div class="flex-child buttons">
                        <button id="SaveContact1" onclick="AddNew()">Add</button>
                    </div>
                </div>
            </ul>
        </div>

</body>

<li class="list-group-item flex-parent invisible" id="ContactTemplate">
    <input type="text" class="flex-child first-name">
    <input type="text" class="flex-child last-name">
    <input type="text" class="flex-child email">
    <input type="text" class="flex-child phone-number">
    <div class="flex-child buttons">
        <button>Save</button>
        <button>Delete</button>
    </div>
</li>
</html>