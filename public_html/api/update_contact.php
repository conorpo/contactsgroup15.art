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
    $firstName = trim(filter_var($data->firstName, FILTER_SANITIZE_ADD_SLASHES));
    $lastName = trim(filter_var($data->lastName, FILTER_SANITIZE_ADD_SLASHES));
    $phone = trim(filter_var($data->phone, FILTER_SANITIZE_NUMBER_INT));
    $email = trim(filter_var($data->email, FILTER_SANITIZE_EMAIL));
    $userId = trim(filter_var($data->userId, FILTER_SANITIZE_NUMBER_INT));
    $contactId = trim(filter_var($data->contactId, FILTER_SANITIZE_NUMBER_INT));

    if(strlen($contactId) == 0){
        die(json_encode([
            'value' => 0,
            'error' => 'A Contact ID must be specified',
            'data' => null,
        ]));
    }

    $query = "UPDATE Contacts SET ";

    $query .= "firstName = '" . $firstName;
    $query .= "', lastName = '" . $lastName;
    $query .= "', phone = '" . $phone;
    $query .= "', email = '" . $email;
    
    $query .= "' WHERE contactId = " . $contactId . " AND userId = " . $userId . ";";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die(json_encode([
            'value' => 0,
            'error' => mysqli_error($conn),
            'data' => null,
        ]));
    }

    die(json_encode([
        'value' => 1,
        'error' => null,
        'data' => null,
    ]));
}


