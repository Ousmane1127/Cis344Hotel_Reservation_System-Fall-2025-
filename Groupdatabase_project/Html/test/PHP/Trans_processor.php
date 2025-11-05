<?php
// this code is to retreive our data from the forms and store them in variables
$GuestID = $_POST['GID'];
$Amount = $_POST['Amount'];
$Payment  = $_POST['PM'];
$Date = $_POST['Date'];



// The code below is for connecting to the database
$dsn ="mysql:host=localhost;dbname=hotel_reservation_sys";
$dbusername = "root";
$dbpsw = "Jallohfamily1";

        // this sets the connections
        try{
    $PDO = new PDO($dsn,$dbusername,$dbpsw  );
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo"Connection Sucess <br>";
}
catch(PDOException $e){
    echo "Connection failed: " .$e->getMessage();
}
// this will check to see if there a guest in the guest table with our inputed guest ID
$countQ = "Select Count(*) from guest where GuestID = ? ";
 $stmt = $PDO->prepare($countQ);
    $stmt->execute([$GuestID]);
    $count = $stmt->fetchColumn();
 echo "Count: $count <br>";
// if there none then we will display bottom message
 if($count == 0 ){
    echo "Please enter a valid guest ID";
 }
 else{
    // Insert data into Transaction table
    $Sql = "INSERT INTO transactions( GuestID, amount, Payment_Method, Date) VALUES (?, ?, ?,?);";
    $stmt = $PDO->prepare($Sql);
     $stmt->execute([$GuestID,$Amount,$Payment,$Date]);
    }