<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, inital-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Employee</title>
    </head>
    <body>
         <nav>
         <div class="topnav">
        <a class="active" href="/Groupdatabase_project/Html/Ari/index.html">Home</a>
        <a href="Guest.php">Guest</a>
        <a href="Reservation.php">Reservation</a>
        <a href="Employee.php">Employee</a>
        <a href="Transaction.php">Transaction</a>
</div> 
    </nav>
        <div class="wrapper">
            <form method="post" action="PHP/Employee_processor.php">
                <h1>Employee</h1>
                <div class="inputbox">
                     <label for="name"> Name</label> 
                      <input type="text" name = "name" placeholder="John Doe">
                </div>
                 <div class="inputbox">
                     <label for="SSN"> SSN</label> 
                      <input type="text" name = "SSN" placeholder="XXX-XX-XXXX">
                </div>
                 <div class="inputbox">
                     <label for="Position"> Position</label> 
                      <input type="text" name = "Position" placeholder="Staff">
                </div>
                 <div class="inputbox">
                     <label for="Addy"> Address </label> 
                      <input type="text" name = "Addy" placeholder="">
                </div>
                 <div class="inputbox">
                     <label for="BirthDay"> BirthDay</label> 
                      <input type="date" name = "BirthDay" placeholder="01-27-2001">
                </div>
                <div>  <input type="submit" name= "submit"></div>
            </form>
        </div>
    </body>
</html>