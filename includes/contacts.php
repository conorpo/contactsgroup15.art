<?php
include 'connection.php';
//CRUD Operations




//Search Operations
function searchContacts($conditions){
    global $conn, $userId;
    $query = "SELECT * FROM Contacts WHERE UserId = " . $userId;
    if(count($conditions) > 0)
        $query .= ' AND ' . implode(' AND ', $conditions);
    
    $result = mysqli_query($conn, $query);

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>