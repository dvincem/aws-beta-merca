<?php
include "config.php";
session_start();
if(!isset($_SESSION['usertype'])){
  echo '<script>alert("Unauthorized Web Access")</script>';
  echo '<script>window.location.href="login_page.php"</script>';
}
else{
?>
<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!-- <title>Responsive Sidebar Menu</title> -->
    <link rel="stylesheet" href="css/dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image" href="icon/logo.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <!--Bootstrap css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
        </script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/main.min.css">
    <script type="text/javascript">
                    function popup()
                    {
                      swal({
                            title: "UNDER MAINTENANCE",
                            text: "not available at the moment",
                            icon: "warning",
                            button: "I understand",
                          });
                    }
                  </script>
  </head>
  <body style="background-color: #EDE1CF;
    font-family: sans-serif;">
    <div id="container-background">
      
        <nav class="navbar navbar-expand-md" id="navbar-color">
            <!-- Brand -->
            <a class="navbar-brand" href="dashboard.php" id="logo-color"><i><img src="./icon/logo.png" alt=""></i>MERCA'S PIZZA</a>
          
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
    <main>
        <center>

</center>
<!-- big banner at front -->
<div class="main-content">
<section id="sides">
    <input type="checkbox" id="check">
    <label for="check" class="mb-4 mt-1">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>Dashboard</header>
      <a href="dashboard.php" class="active">
        <i class="fas fa-qrcode"></i>
        <span>Dashboard</span>
      </a>
      <?php if($_SESSION['usertype']=="cashier1" || $_SESSION['usertype']=="superadmin" )
      {
        ?>
      <a href="main/index1.php" >
        <i class="fas fa-link"></i>
        <span>POS A</span>
      </a>
      <a href="sales_pos_a.php">
        <i class="fas fa-stream"></i>
        <span>Sales POS A</span>
      </a>
      <?php 
      }
      if($_SESSION['usertype']=="hr" || $_SESSION['usertype']=="superadmin")
      {
      ?>

      <a href="payroll_emplist.php">
         <i class="fas fa-calendar"></i>
        <span>Payroll</span>
      </a>
      <a href="payroll_report.php">
        <i class="fas fa-stream"></i>
        <span>Payroll Report</span>
      </a>
      <a href="employee_list.php">
        <i class="far fa-question-circle"></i>
        <span>Employee List</span>
      </a>
      <?php }
      if($_SESSION['usertype']=="cashier2" || $_SESSION['usertype']=="superadmin"){
        ?>
      <a href="main/index2.php">
      <i class="fas fa-link"></i>
        <span>POS B</span>
      </a>
      <a href="sales_pos_b.php">
      <i class="fas fa-stream"></i>
        <span>Sales POS B</span>
      </a>
      <?php }
      if($_SESSION['usertype']=="superadmin"){
        ?>
        <a href="create_account.php">
      <i class="fas fa-link"></i>
        <span>Create Account</span>
      </a>
      <?php }?>
      <a href="#.php">
        <i class="far fa-question-circle"></i>
        <span>User Account</span>
      </a>
      <a href="login_page.php">
        <i class="far fa-qr-code"></i>
        <span>Logout</span>
      </a>
    </div>
    </section>
            <div class="content">
                  <?php 
                  if($_SESSION['usertype']=="superadmin"){
                  ?>
                  <h1>Welcome Super Admin</h1>
                  <br>
                  
                  <?php 
                  }
                  ?>
                  <?php 
                  if($_SESSION['usertype']=="cashier1"){
                  ?>
                  <h1>Welcome Cashier A</h1>
                  <br>
                  <?php 
                  }
                  ?>
                  <?php 
                  if($_SESSION['usertype']=="cashier2"){
                  ?>
                  <h1>Welcome Cashier B</h1>
                  <br>
                  <?php 
                  }
                  ?>
                  <?php 
                  if($_SESSION['usertype']=="hr"){
                  ?>
                  <h1>Welcome HR</h1>
                  <br>
                  <?php 
                  }
                  ?>
                  <div id="btn1"><a href="#">

                  <button onclick="popup()">DASHBOARD</button></div></a>
            </div>
    </div>
    <!-- big banner at front -->
    </main>
</body>
</html>
<?php  }
?>