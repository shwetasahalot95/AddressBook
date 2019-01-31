<?php


include("Connection.php");

// create object
$connObj = new Connection();

//call connect function
$conn = $connObj->connect();

$result = array();

$resultStore = $conn->query("SELECT * FROM CONTACT");

while($ret = mysqli_fetch_array($resultStore)){
    $result[] = array("id" => $ret["Contact_id"], "fName" => $ret["Fname"],
        "mName" => $ret["Mname"], "lName" => $ret["Lname"]);
}

echo json_encode($result, JSON_PRETTY_PRINT);

?>