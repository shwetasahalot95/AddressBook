<?php

	include("Connection.php");

    // create object
    $connObj = new Connection();

    //call connect function
    $conn = $connObj->connect();

	if(isset($_POST['fName']) && isset($_POST['lName'])){
		$fname = $_POST['fName'];
		$mname = $_POST['mName'];
		$lname = $_POST['lName'];
		$date = $_POST['date'];

		/*Insert into contact table*/
		$contactTableInsert = $conn->query("INSERT INTO contact (Fname,Mname,Lname) VALUES ('$fname','$mname','$lname')"); 

		/*Fetch contact_is Primary Key for other tables*/
		$contact_id = $conn->query("SELECT Contact_id FROM contact WHERE Fname = '$fname' AND Lname = '$lname' AND Mname = '$mname'");
		$row=$contact_id->fetch_array();
		$id = $row['0'];

		/*Insert Into date table*/
		$dateTableInsert = $conn->query("INSERT INTO date (Contact_id,Date) VALUES('$id','$date')");


		if(!empty($_POST['haddress']) && !empty($_POST['waddress'])){           /*If insert into both home and work address*/
		  $haddress = $_POST['haddress'];
		  $hcity = $_POST['hcity'];
		  $hstate = $_POST['hstate'];
		  $hzip = $_POST['hzip'];

		  $waddress = $_POST['waddress'];
		  $wcity = $_POST['wcity'];
		  $wstate = $_POST['wstate'];
		  $wzip = $_POST['wzip'];

		$addressTableInsert = $conn->query("INSERT INTO address (Contact_id,Address,City,State,Zip) VALUES('$id','$haddress','$hcity','$hstate','$hzip')");
		$addressTableInsert = $conn->query("INSERT INTO work (Contact_id,Address,City,State,Zip) VALUES('$id','$waddress','$wcity','$wstate','$wzip')");
	   }else if(!empty($_POST['haddress']) ){                                   /*If insert into home address*/
		  $haddress = $_POST['haddress'];
		  $hcity = $_POST['hcity'];
		  $hstate = $_POST['hstate'];
		  $hzip = $_POST['hzip'];
			$addressTableInsert = $conn->query("INSERT INTO address (Contact_id,Address,City,State,Zip) VALUES('$id','$haddress','$hcity','$hstate','$hzip')");
	   }else if(!empty($_POST['waddress'])){                                  /*If insert into work address*/
		  $waddress = $_POST['waddress'];
		  $wcity = $_POST['wcity'];
		  $wstate = $_POST['wstate'];
		  $wzip = $_POST['wzip'];
			$addressTableInsert = $conn->query("INSERT INTO work (Contact_id,Address,City,State,Zip) VALUES('$id','$waddress','$wcity','$wstate','$wzip')");
	   }
	   if(!empty($_POST['cphone']) && !empty($_POST['hphone']) && !empty($_POST['wphone'])){

		  $cphone = $_POST['cphone'];
		  $hphone = $_POST['hphone'];
		  $wphone = $_POST['wphone'];
		  $acode = $_POST['acode'];
		  $addressTableInsert = $conn->query("INSERT INTO phone (Contact_id,Phone_Type,Area_Code,Cell_Phone,Home_Phone,Work_Phone) VALUES('$id',4,'$acode','$cphone','$hphone','$wphone')");
	   }else if(!empty($_POST['cphone']) && !empty($_POST['hphone'])){
		  $cphone = $_POST['cphone'];
		  $hphone = $_POST['hphone'];
		  $acode = $_POST['acode'];
		  $addressTableInsert = $conn->query("INSERT INTO phone (Contact_id,Phone_Type,Area_Code,Cell_Phone,Home_Phone) VALUES('$id',3'$acode','$cphone','$hphone')");
	   }else if(!empty($_POST['hphone']) && !empty($_POST['wphone'])){
		  $hphone = $_POST['hphone'];
		  $wphone = $_POST['wphone'];
		  $acode = $_POST['acode'];
		  $addressTableInsert = $conn->query("INSERT INTO phone (Contact_id,Phone_Type,Area_Code,Home_Phone,Work_Phone) VALUES('$id',2,'$acode','$hphone','$wphone')");
	   }else if(!empty($_POST['cphone']) && !empty($_POST['wphone'])){
		   $cphone = $_POST['cphone'];
		  $wphone = $_POST['wphone'];
		  $acode = $_POST['acode'];
		  $addressTableInsert = $conn->query("INSERT INTO phone (Contact_id,Phone_Type,Area_Code,Cell_Phone,Work_Phone) VALUES('$id',1,'$acode','$cphone','$wphone')");
	   }else if(!empty($_POST['cphone'])){
		   $cphone = $_POST['cphone'];
		  $acode = $_POST['acode'];
		  $addressTableInsert = $conn->query("INSERT INTO phone (Contact_id,Phone_Type,Area_Code,Cell_Phone) VALUES('$id',0,'$acode','$cphone')");
	   }else if(!empty($_POST['hphone'])){
		  $hphone = $_POST['hphone'];
		  $acode = $_POST['acode'];
		  $addressTableInsert = $conn->query("INSERT INTO phone (Contact_id,Phone_Type,Area_Code,Cell_Phone,Home_Phone,Work_Phone) VALUES('$id',0,'$acode','$hphone')");
	   }else if(!empty($_POST['wphone'])){
		  $wphone = $_POST['wphone'];
		  $acode = $_POST['acode'];
		  $addressTableInsert = $conn->query("INSERT INTO phone (Contact_id,Phone_Type,Area_Code,Work_Phone) VALUES('$id','$acode',0,'$wphone')");
	   }
	   header("Location: homepage.html");
	}
?>