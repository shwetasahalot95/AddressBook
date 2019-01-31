<?php


include("Connection.php");

// create object
$connObj = new Connection();

//call connect function
$conn = $connObj->connect();

if (isset($_POST['idurl'])){
    $url = $_POST['idurl'];

    //find id
    $id = end(explode('=', $url));

    $delDate = $conn->query("DELETE FROM DATE WHERE Contact_id='$id'");
    $delWork = $conn->query("DELETE FROM WORK WHERE Contact_id='$id'");
    $delAdd = $conn->query("DELETE FROM ADDRESS WHERE Contact_id='$id'");
    $delPhone = $conn->query("DELETE FROM PHONE WHERE Contact_id='$id'");

    if($delWork === true && $delDate === true && $delAdd === true && $delPhone === true){
        $delContact = $conn->query("DELETE FROM CONTACT WHERE Contact_id='$id'");
        if ($delContact === true){
            header("Location: homepage.html");
        }
    }
}
?>