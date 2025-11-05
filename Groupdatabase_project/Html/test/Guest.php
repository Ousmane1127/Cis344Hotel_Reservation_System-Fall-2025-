<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, inital-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Guest info</title>
    </head>
    <body style="background:url(Img/aesthetic-wallpaper-1.jpg); background-size: cover;
    background-position: center ;">

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
            <form method="post" action="PHP/Guest_processor.php">
                <h1>Guest</h1>
                <div class="inputbox">
                     <label for="Gname"> Name</label> 
                      <input type="text" name = "Gname" placeholder="John Doe">
                </div>
                 <div class="inputbox">
                     <label for="email"> Email</label> 
                      <input type="email" name = "email" placeholder="example@yahoo.com">
                </div>
                 <div class="inputbox">
                     <label for="Pnumber"> Phone Number</label> 
                      <input type="text" name = "Pnumber" placeholder="000-000-0000">
                </div>
                 <div class="inputbox">
                     <label for="ResvNum"> Reservation number </label> 
                      <input type="int" name = "ResvNum" placeholder="1">
                </div>
                
                <div>  <input type="submit" name= "submit"></div>
            </form>
        </div>
    </body>
</html>