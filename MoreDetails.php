<?php

include("Connection.php");

// create object
$connObj = new Connection();

//call connect function
$conn = $connObj->connect();

$result = array();

if(isset($_POST['url'])){
    $url  = $_POST['url'];
    //find id
	$exp = explode('=', $url);
    $id = end($exp);

    $sql = "SELECT * FROM CONTACT WHERE Contact_id = '$id'";
    $resultStore = $conn->query($sql);
    while($ret = mysqli_fetch_array($resultStore)){
        $result['contact'] = array("id" => $ret["Contact_id"], "fName" => $ret["Fname"],
            "mName" => $ret["Mname"], "lName" => $ret["Lname"]);
    }
    $add = "SELECT Contact_id, Address_Type, Address, City, State, Zip FROM ADDRESS WHERE Contact_id = '$id'";
    $addQuery = $conn->query($add);
    while($ret = mysqli_fetch_array($addQuery)){
        $result['home'] = array("home" => "home", "address" => $ret["Address"],
            "city" => $ret["City"], "state" => $ret["State"], "zip" => $ret["Zip"]);
    }
    $addw = "SELECT Contact_id, Address_Type, Address, City, State, Zip FROM WORK WHERE Contact_id = '$id'";
    $addQueryw = $conn->query($addw);
    while($ret = mysqli_fetch_array($addQueryw)){
        $result['work'] = array("work" => "work", "address" => $ret["Address"],
            "city" => $ret["City"], "state" => $ret["State"], "zip" => $ret["Zip"]);
    }
    $phone = "SELECT Phone_id, Contact_id, Phone_Type, Area_code, Cell_Phone, Home_Phone, Work_Phone FROM PHONE WHERE Contact_id = '$id'";
    $phonq = $conn->query($phone);
    while($ret = mysqli_fetch_array($phonq)){
        $result['phone'] = array("type" => $ret["Phone_Type"], "code" => $ret["Area_code"],
            "cphone" => $ret["Cell_Phone"], "hphone" => $ret["Home_Phone"], "wphone" => $ret["Work_Phone"]);
    }
    $dates = "SELECT Contact_id, Date FROM DATE WHERE Contact_id = '$id'";
    $dateq = $conn->query($dates);
    while($ret = mysqli_fetch_array($dateq)){
        $result['date'] = array("date" => $ret["Date"]);
    }
    echo json_encode($result, JSON_PRETTY_PRINT);
}



