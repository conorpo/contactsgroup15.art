<?php 
include '../../includes/connection.php';
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
    $query = "SELECT * FROM Contacts WHERE userId = " . $data->userId;
    foreach($data as $key => $val){
        if(strcmp($key,'userId') != 0){
            $query .= " AND " . $key . " LIKE '%" . $val . "%'";
        }
    }
    $query .= ";";
    
    $result = mysqli_query($conn, $query);

    if(!$result){
        die(json_encode([
            'value' => 0,
            'error' => mysqli_error($conn),
            'data' => null,
        ]));
    }
    
    $contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    die(json_encode([
        'value' => 1,
        'error' => null,
        'data' => $contacts,
    ]));
}
