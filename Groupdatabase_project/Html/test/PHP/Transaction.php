<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, inital-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Transactions</title>
    </head>
    <body style="background:url(Img/Trans.jpg); background-size: cover;
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
            <form method="post" action="PHP/Employee_processor.php">
                <h1>Transaction</h1>
                <div class="inputbox">
                     <label for="GID"> Guest ID</label> 
                      <input type="int" name = "GID" placeholder="10">
                </div>
                 <div class="inputbox">
                     <label for="Amount"> Amount</label> 
                      <input type="decimal" name = "Amount" placeholder="100.00">
                </div>
                 <div class="inputbox">
                     <label for="PM"> Payment Method</label> 
                      <input type="text" name = "PM" placeholder="Debit">
                </div>
                
                 <div class="inputbox">
                     <label for="Date"> Date</label> 
                      <input type="date" name = "Date" placeholder="01-27-2001">
                </div>
                <div>  <input type="submit" name= "submit"></div>
            </form>
        </div>
    </body>
</html>