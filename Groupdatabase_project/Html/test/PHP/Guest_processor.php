<?php
//Employee variables
$name = htmlspecialchars($_POST['Gname']);
$Email = htmlspecialchars($_POST['email']);
$Phone = htmlspecialchars($_POST['Pnumber']);
$Reservation = htmlspecialchars($_POST['ResvNum']);




echo "Data Submitted";

echo "<p>
name:.$name 
<br>
Email:.$Email
<br>
Phone:.$Phone
<br>
Reservation#:.$Reservation
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

try{
    // this is to find and store the guest id based off what user input for reservation id 
     $countQ1 = "Select (GuestID) from guest where ResvID = ?; ";
     $stmt = $PDO->prepare($countQ1);
    $stmt->execute([$Reservation]);
    $Guest_id = $stmt->fetchColumn();


    // this code will check to see if there is an existing guest in the guest table 
    $countQ = "Select Count(*) from guest where GuestID = ? ;";
 $stmt = $PDO->prepare($countQ);
    $stmt->execute([$Guest_id]);
    $count = $stmt->fetchColumn();
 echo "Count: $count <br>";

 if($count == 0 ){
    
    $Sql = "INSERT INTO guest( Name, email, Phone_Num ) VALUES (?, ?, ?)";
    // the pdo variable stores our connection to the Db and the prepare statement is used to safely insert our data replacing the ? marks
    $stmt = $PDO->prepare($Sql);
    
    // Execute with parameters as array
    $stmt->execute([$name , $Email, $Phone]);
//inser guest id into reservation 
    $Guest_id = $PDO->lastInsertId(); // this code retrieves the guest id from the table
    $Sql2 = "INSERT INTO reservations(GuestID ) VALUES (?)";
    $stmt = $PDO->prepare($Sql2);
     $stmt->execute([$Guest_id]);
    echo "Data inserted successfully!";
    
    $Resv_id = $PDO->lastInsertId();
    $Sql3 = "UPDATE guest SET ResvID = ? WHERE GuestID = ?;" ;
    
    $stmt = $PDO->prepare($Sql3);
     $stmt->execute([$Resv_id,$Guest_id]);

     echo "<br>please fill out the reservation form to complete the reservation data<br>";
     echo "<br> Your guest ID is $Guest_id";
     
}
else{
    $sql = "Update guest Set Name = ?, email = ?, Phone_Num = ? where GuestID = ?;";
    $stmt = $PDO->prepare($sql);
     $stmt->execute([$name,$Email,$Phone,$Guest_id]);
}
} catch(PDOException $e) {
    echo "Error inserting data: " . $e->getMessage();
}