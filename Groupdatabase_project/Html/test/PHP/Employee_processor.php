<?php
//Employee variables
$Name = $_POST['name'];
$SSn = $_POST['SSN'];
$Position = $_POST['Position'];
$Address = $_POST['Addy'];
$Birthday = $_POST['BirthDay'];



echo "Data Submitted";

echo "<p>
Name:.$Name 
<br>
SSN:.$SSn
<br>
Position:.$Position
<br>
Address:.$Address
<br>

BirthDay: . $Birthday

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


try {
    $Sql = "INSERT INTO employee (Name, SSN, Position, Address, Birthday) VALUES (?, ?, ?, ?, ?)";
    // the pdo variable stores our connection to the Db and the prepare statement is used to safely insert our data replacing the ? marks
    $stmt = $PDO->prepare($Sql);
    
    // Execute with parameters as array
    $stmt->execute([$Name, $SSn, $Position, $Address, $Birthday]);
    
    echo "Data inserted successfully!";
   
    
} catch(PDOException $e) {
    echo "Error inserting data: " . $e->getMessage();
}