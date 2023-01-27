<?php 
    session_start();
    $grand_total = $_SESSION['grandtotal'];
    include 'config.php';
    if(isset($_POST['paynow'])){
        $discountedamount= $_SESSION['discountedamount'];
        $totaldiscount=$_SESSION['totaldiscount'];
        $totalquantity=$_SESSION['totalquantity'];
        $totalprice=$_SESSION['totalprice'];
        $totalname=$_SESSION['totalname'];
        $cash = $totalprice;
        $change = 0;
        $sql = "INSERT INTO sales_pos_a (ItemName, Price, Quantity, DiscountAmount, DiscountedAmount, CashFromCustomer, ChangeToTheCustomer ) VALUES ('$totalname','$totalprice','$totalquantity','$totaldiscount','$discountedamount','$cash','$change')";
        if(mysqli_query($conn,$sql)){
            echo '<script>alert("The Order has been Placed");</script>';
            $sqldel = "DELETE FROM cart WHERE user_id='1'";
            mysqli_query($conn,$sqldel);
            echo '<script>window.location.href="../../../pos1.php";</script>';
           
        }
        else{
            echo '<script>alert("ERROR")</script>';
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merca's Pizza</title>
    <link rel="shortcut icon" type="image" href="icon/logo.png">
    <link rel="stylesheet" href="style.css">
    <!-- bootstrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- bootstrap link -->
    
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <!-- font -->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>

    <div id="container-background">
        <nav class="navbar navbar-expand-md" id="navbar-color">
            <!-- Brand -->
            <a class="navbar-brand" href="#" id="logo-color"><i><img src="./icon/logo.png" alt=""></i>MERCA'S PIZZA</a>
          
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span><i><img src="./icon/menu.png" alt="" id="menu-color"></i></span>
            </button>
          
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item">
                </li>
                <li class="nav-item">
                </li>
                <li class="nav-item">
                </li>
                <li class="nav-item">
                </li>
                <li class="nav-item">
                </li>
              </ul>
            </div>
          </nav>
          
          <?php $balance = (10583 - $grand_total); ?>
          <!-- new main content thank you page -->
          <div class="main-content">
            <form action="" method="post">
              <div class="content">
                  <h2>THANK YOU!</h2>
                  <h4>Payment Success.</h4>
                  <br>
                  <h4>Remaining Account Balance: ₱<?php echo $balance; ?></h4>
                  <div id="btn1">
                  <button type="submit" name="paynow">PRINT TRANSACTION</button>
                </div>

  </form>
              </div>
          </div>
          <!-- new main content thank you page -->
  
<!-- footer section-->
<footer id="footer">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 text-lg-left text-center">
                <div class="copyright">
                    &copy; Copyright <strong> Merca's Pizza</strong>. All Rights Reserved
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer section-->

</body>
</html>