<?php

include("Connection.php");

// create object
$connObj = new Connection();

//call connect function
$conn = $connObj->connect();

    if(isset($_POST['idurl'])){
        $fname = $_POST['fName'];
        $mname = $_POST['mName'];
        $lname = $_POST['lName'];
        $date = $_POST['date'];

        $url = $_POST['idurl'];

        //find id
        $id = end(explode('=', $url));

        /*UPDATE contact table*/
        $contactTableInsert = $conn->query("UPDATE CONTACT SET Fname = '$fname', Mname='$mname', Lname='$lname' WHERE Contact_id = '$id'");

        /*UPDATE date table*/
        if(!empty($date)){
            $dateTableInsert = $conn->query("UPDATE DATE SET Date='$date' WHERE Contact_id = '$id'");
        }
        if(!empty($_POST['haddress']) && !empty($_POST['waddress'])){
            /*If UPDATE both home and work address*/
            $haddress = $_POST['haddress'];
            $hcity = $_POST['hcity'];
            $hstate = $_POST['hstate'];
            $hzip = $_POST['hzip'];

            $waddress = $_POST['waddress'];
            $wcity = $_POST['wcity'];
            $wstate = $_POST['wstate'];
            $wzip = $_POST['wzip'];

            $addressTableInsert = $conn->query("UPDATE ADDRESS SET Address = '$haddress',City='$hcity',State='$hstate',Zip='$hzip' WHERE Contact_id = '$id'");
            $addressTableInsert = $conn->query("UPDATE WORK SET Address ='$waddress',City='$wcity',State='$wstate',Zip='$wzip' WHERE Contact_id = '$id'");
        }else if(!empty($_POST['haddress']) ){                                   /*If UPDATE home address*/
            $haddress = $_POST['haddress'];
            $hcity = $_POST['hcity'];
            $hstate = $_POST['hstate'];
            $hzip = $_POST['hzip'];
            $addressTableInsert = $conn->query("UPDATE ADDRESS SET Address = '$haddress',City='$hcity',State='$hstate',Zip='$hzip' WHERE Contact_id = '$id'");
        }else if(!empty($_POST['waddress'])){                                  /*If UPDATE work address*/
            $waddress = $_POST['waddress'];
            $wcity = $_POST['wcity'];
            $wstate = $_POST['wstate'];
            $wzip = $_POST['wzip'];
            $addressTableInsert = $conn->query("UPDATE WORK SET Address ='$waddress',City='$wcity',State='$wstate',Zip='$wzip' WHERE Contact_id = '$id'");
        }
        if(!empty($_POST['cphone']) && !empty($_POST['hphone']) && !empty($_POST['wphone'])){

            $cphone = $_POST['cphone'];
            $hphone = $_POST['hphone'];
            $wphone = $_POST['wphone'];
            $acode = $_POST['acode'];
            $addressTableInsert = $conn->query("UPDATE phone SET Area_Code='$acode',Cell_Phone='$cphone',Home_Phone='$hphone',Work_Phone='$wphone' WHERE Contact_id = '$id'");
        }else if(!empty($_POST['cphone']) && !empty($_POST['hphone'])){
            $cphone = $_POST['cphone'];
            $hphone = $_POST['hphone'];
            $acode = $_POST['acode'];
            $addressTableInsert = $conn->query("UPDATE phone SET Area_Code='$acode',Cell_Phone='$cphone',Home_Phone='$hphone' WHERE Contact_id = '$id'");
        }else if(!empty($_POST['hphone']) && !empty($_POST['wphone'])){
            $hphone = $_POST['hphone'];
            $wphone = $_POST['wphone'];
            $acode = $_POST['acode'];
            $addressTableInsert = $conn->query("UPDATE phone SET Area_Code='$acode',Home_Phone='$hphone',Work_Phone='$wphone' WHERE Contact_id = '$id'");
        }else if(!empty($_POST['cphone']) && !empty($_POST['wphone'])){
            $cphone = $_POST['cphone'];
            $wphone = $_POST['wphone'];
            $acode = $_POST['acode'];
            $addressTableInsert = $conn->query("UPDATE phone SET Area_Code='$acode',Cell_Phone='$cphone',Work_Phone='$wphone' WHERE Contact_id = '$id'");
        }else if(!empty($_POST['cphone'])){
            $cphone = $_POST['cphone'];
            $acode = $_POST['acode'];
            $addressTableInsert = $conn->query("UPDATE phone SET Area_Code='$acode',Cell_Phone='$cphone' WHERE Contact_id = '$id'");
        }else if(!empty($_POST['hphone'])){
            $hphone = $_POST['hphone'];
            $acode = $_POST['acode'];
            $addressTableInsert = $conn->query("UPDATE phone SET Area_Code='$acode',Home_Phone='$hphone', WHERE Contact_id = '$id'");
        }else if(!empty($_POST['wphone'])){
            $wphone = $_POST['wphone'];
            $acode = $_POST['acode'];
            $addressTableInsert = $conn->query("UPDATE phone SET Area_Code='$acode',Work_Phone='$wphone' WHERE Contact_id = '$id'");
        }
        header("Location:$url");
    }
?>