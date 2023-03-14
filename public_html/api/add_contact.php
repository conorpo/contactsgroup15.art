<?php include '../../includes/connection.php';
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$json = file_get_contents('php://input');
$data = json_decode($json);

if(!is_object($data)){
    die(json_encode([
        'value' => 0,
        'error' => 'Received JSON is improperly formatted',
        'data' => null,
    ]));
}

if(strcmp($_SESSION["userId"],$data->userId) == 0){
    $firstName = trim(filter_var($data->firstName, FILTER_SANITIZE_SPECIAL_CHARS));
    $lastName = trim(filter_var($data->lastName, FILTER_SANITIZE_SPECIAL_CHARS));
    $phone = trim(filter_var($data->phone, FILTER_SANITIZE_NUMBER_INT));
    $email = trim(filter_var($data->email, FILTER_SANITIZE_EMAIL));
    $dateCreated = trim((new DateTime())->format('Y-m-d H:i:s'));
    $userId = trim(filter_var($data->userId, FILTER_SANITIZE_NUMBER_INT));

    if(strlen($firstName) == 0){
        die(json_encode([
            'value' => 0,
            'error' => 'A First Name must be specified',
            'data' => null,
        ]));
    }


    $query = "INSERT INTO Contacts (
        firstName,
        lastName,
        email,
        phone,
        dateCreated,
        userId
      )
    VALUES (
        '$firstName',
        '$lastName',
        '$email',
        '$phone',
        '$dateCreated',
        '$userId'
      );";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die(json_encode([
            'value' => 0,
            'error' => mysqli_error($conn),
            'data' => null,
        ]));
    }

    $result = mysqli_query($conn, "SELECT * FROM Contacts WHERE UserId = $userId ORDER BY contactId DESC LIMIT 1");
    if(!$result){
        die(json_encode([
            'value' => 0,
            'error' => mysqli_error($conn),
            'data' => null,
        ]));
    }
    $contact = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(empty($contact)){
        die(json_encode([
            'value' => 0,
            'error' => "User Empty for some reason",
            'data' => null,
        ]));
    }

    die(json_encode([
        'value' => 1,
        'error' => null,
        'data' => $contact[0]["contactId"],
    ]));
}

