<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, inital-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Reservation info</title>
    </head>
    <body style="background:url(Img/City.jpg); background-size: cover;
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
            <form method="post" action="PHP/Resv_processor.php">
                <h1>Reservation</h1>
                <div class="inputbox">
                     <label for="GID"> GuestID</label> 
                      <input type="int" name = "GID" placeholder="20">
                </div>
                 <div class="inputbox">
                     <label for="Rnum"> Room Number</label> 
                      <input type="int" name = "Rnum" placeholder="55">
                </div>
                 <div class="inputbox">
                     <label for="CIdate"> Check In Date </label> 
                      <input type="date" name = "CIdate" placeholder="08/27/2044">
                </div>
                 <div class="inputbox">
                     <label for="CODate"> Checkout Date </label> 
                      <input type="date" name = "CODate" placeholder="">
                </div>
                <div class="inputbox">
                     <label for="Tnum"> Tranaction # </label> 
                      <input type="int" name = "Tnum" placeholder="">
                </div>
                
                <div>  <input type="submit" name= "submit"></div>
            </form>
        </div>
    </body>
</html>