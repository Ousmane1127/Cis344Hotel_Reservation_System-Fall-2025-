<?php
//Reservation variables
$GuestID =htmlspecialchars( $_POST['GID']);
$Rnum = htmlspecialchars($_POST['Rnum']);
$CIdate = htmlspecialchars($_POST['CIdate']);
$CODate = htmlspecialchars($_POST['CODate']);
$Tnum = htmlspecialchars($_POST['Tnum']);



echo "Data Submitted";

echo "<p>
Guest:.$GuestID 
<br>
Rnum:.$Rnum
<br>
Check In:.$CIdate
<br>
Check out:.$CODate
<br>



</p>

";

// The code below is for connecting to the database
$dsn ="mysql:host=localhost;dbname=hotel_reservation_sys";
$dbusername = "root";
$dbpsw = "Jallohfamily1";

        // this sets the connections
        try{
    $PDO = new PDO($dsn,$dbusername,$dbpsw  );
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo"Connection Sucess";
}
catch(PDOException $e){
    echo "Connection failed: " .$e->getMessage();
}

// the code below will be to inset our data into the database

// the code below will be to inset our data into the database


try{
   // $Sql = "INSERT INTO reservations(GuestID, Room_num, Check_IN, Check_out,Trans_num) VALUES (?, ?, ?, ?,?)";
    // the pdo variable stores our connection to the Db and the prepare statement is used to safely insert our data replacing the ? marks
   // $stmt = $PDO->prepare($Sql);
    
    // Execute with parameters as array
    //$stmt->execute([$GuestID, $Rnum, $CIdate, $CODate,$Tnum]);
    // check if row exist in guest table with our guest id
 $countQ = "Select Count(*) from guest where GuestID = ? ;";
 $stmt = $PDO->prepare($countQ);
    $stmt->execute([$GuestID]);
    $count = $stmt->fetchColumn();
 echo "Count: $count";

 if($count > 0){
    // the code retreives the resvid and stores it into variable $Res
    $sql2 = "Select ResvID from guest where GuestId  = $GuestID";
    $stmt = $PDO->prepare($sql2);
     $Res = $stmt->execute();
     echo "<p> Resv Id is: $Res</p>";
     // we update the existing row 
    $sql3 = "update reservations Set Room_num = ?, Check_In = ?,  Check_Out = ? where GuestID = ?;";
    $stmt = $PDO->prepare($sql3);
     $stmt->execute([$Rnum,$CIdate,$CODate,$GuestID ]);

     // this code will insert a new row into the transaction table 
      $PM = "Debit";
     $sql = "Insert into transactions(Trans_ID,GuestID, amount, Payment_Method, Date) values (?,?, 100.00,?,? );";
     $stmt = $PDO->prepare($sql);
     $stmt->execute([$Tnum,$GuestID,$PM,$CIdate]);
     $Trans_num = $PDO->lastInsertId();

     // this code will update the reservation table with the transaction ID for the reservation 
      $sql4 = "update reservations Set Trans_num = ? where GuestID = ? ;";
      $stmt = $PDO->prepare($sql4);
     $stmt->execute([$Tnum, $GuestID ]);

 }
  else{
    // insert guest id into the guest table 
    $sql = "Insert into guest(GuestID) values (?);";
    $stmt = $PDO->prepare($sql);
    $stmt->execute([$GuestID]);

    // insert data into the reservation table 
    $Sql = "INSERT INTO reservations( GuestID, Room_num, Check_In,  Check_Out) VALUES (?, ?, ?,?);";
    $stmt = $PDO->prepare($Sql);
     $stmt->execute([$GuestID,$Rnum,$CIdate,$CODate]);

     // update the guest table to include the reservation id 

     $Resv_id = $PDO->lastInsertId();
     $sql3 = "update guest Set ResvID = ? where GuestID = ?;";
     $stmt = $PDO->prepare($sql3);
     $stmt->execute([$Resv_id,$GuestID]);


     // this code will insert a new row into the transaction table 
     $PM = "Debit";
     $sql = "Insert into transactions(Trans_ID,GuestID, amount, Payment_Method, Date) values (?,?, 100.00,?,? );";
     $stmt = $PDO->prepare($sql);
     $stmt->execute([$Tnum,$GuestID,$PM,$CIdate]);

     $sql4 = "update reservations Set Trans_num = ? where GuestID = ? ;";
      $stmt = $PDO->prepare($sql4);
     $stmt->execute([$Tnum, $GuestID ]);
     $Resv_Id =  $PDO->lastInsertId(); 


     echo "<Br>Fill out rest of Guest info in guest form <br>";
     echo "Your Reservation Id is - $Resv_Id ";




 
 }
    
    echo "Data inserted successfully!";
    
} catch(PDOException $e) {
    echo "Error inserting data: " . $e->getMessage();
}





// check if row exist
 //$count = "Select Count(*) from guest where GuestID = $GuestID ";

 //if($count > 0){
    // the code retreives the resvid and stores it into variable $Res
   // $sql2 = "Select ResvID from guest where GuestId  = $GuestId";
   // $stmt = $PDO->prepare($sql2);
    // $Res = $stmt->execute();
     // we update the existing row 
    //$sql3 = "update into reservations Set Room_num = ?, set Check_In = ?, set Check_Out = ? where ResevID = ?;";
    //$stmt = $PDO->prepare($sql3);
    // $stmt->execute([$Rnum,$CIdate,$CODate,$Res ]);
 //}

 