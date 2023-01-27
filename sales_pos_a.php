<?php
include "config.php";
session_start();
if($_SESSION['usertype']=="cashier1" || $_SESSION['usertype']=="superadmin"){
  

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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
            </script>
        <link rel="stylesheet" href="css/main.min.css">
        <script>
            $(document).ready(function(){
                $('table tr').click(function(){
                    var id = $(this).attr('row_id');
                    window.open("http://localhost/MERCAPIZZA/public/sales_a.php?id=" + id);
                });
            });
        </script>
    </head>
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-xxl">
            <a href="dashboard.php" class="navbar-brand">
                <img src="logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                <span class="fw-bold text-light">MERCA's PIZZA</span>
            </a>
        </div>
    </nav>
  <body style="background-image: url(bg.webp);
            no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;">
    <section id="sides">
    <input type="checkbox" id="check">
    <label for="check" class="mb-4 mt-1">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>Dashboard</header>
      <a href="dashboard.php">
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
      <a href="sales_pos_a.php" class="active">
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
<main>
    <br>
    <br>
<section id="main">

    <div class="container-sm form-group border p-3  justify-content-center border-dark rounded" id="empdetailscontainer" style="background-color: #EDE1CF;">
    <div class="row my-2">
        <div class="col-lg-4">
            <h3 style= "font-weight: bold;"><i class="bi bi-receipt"></i> Sales Summary of POS A</h3>
        </div>
    </div>
    <form action="includes/search_code.php" method="POST">
        <div class="row g-1 align-items-center justify-content-end">
            <div class="col-auto">
                <label for="searchNum" class="col-form-label">Sales Number:</label>
            </div>
            <div class="col-auto">
                <input type="search" id="searchNum" name="searchNum"class="form-control" placeholder="eg. 1234567890">                
            </div>
            <div class="col-auto">
                <button type="submit" id="search_pos_a" name="search_pos_a" class="btn btn-sm btn-danger"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </form>    
        <div class="row my-2 gy-5 gx-10 justify-content-center">
            <div class="col-lg-12 d-flex justify-content-center">
                <table id="salesTable" class="table table-hover border-dark">
                    <thead>
                        <tr>
                            <th scope="col">Sales Number</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Discount Amount</th>
                            <th scope="col">Discounted Amount</th>
                            <th scope="col">Cash From Customer</th>
                            <th scope="col">Change to the Customer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (isset($_GET['salesnum'])) {
                                $salesNum = $_GET['salesnum'];
                                $query = "SELECT * FROM sales_pos_a WHERE SalesNumber = '$salesNum'";
                                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                if (mysqli_num_rows($run_query) > 0){
                                    while ($row = mysqli_fetch_array($run_query)){
                                        $sales_num = $row['SalesNumber'];
                                        $item_name = $row['ItemName'];
                                        $price = $row['Price'];
                                        $quantity = $row['Quantity'];
                                        $discount_amount = $row['DiscountAmount'];
                                        $discounted_amount = $row['DiscountedAmount'];
                                        $cash_from_customer = $row['CashFromCustomer'];
                                        $change_to_the_customer = $row['ChangeToTheCustomer'];
                                        echo '<tr row_id="'.$sales_num.'">';
                                        echo '<th id="salesNum" scope="row">'.$sales_num.'</th>';
                                        echo '<td>'.$item_name.'</td>';
                                        echo '<td>'.$price.'</td>';
                                        echo '<td>'.$quantity.'</td>';
                                        echo '<td>'.$discount_amount.'</td>';
                                        echo '<td>'.$discounted_amount.'</td>';
                                        echo '<td>'.$cash_from_customer.'</td>';
                                        echo '<td>'.$change_to_the_customer.'</td>';
                                        echo '</tr>';
                                        echo '</a>';
                                    }
                                }
                            }
                            elseif (isset($_GET['error1'])) {
                                $error1 = $_GET['error1'] == "empty";
                                echo '<script>alert("empty search")</script>';
                                echo '<script>alert("reloading page")</script>';
                                $query = "SELECT * FROM sales_pos_a";
                                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                if (mysqli_num_rows($run_query) > 0){
                                    while ($row = mysqli_fetch_array($run_query)){
                                        $sales_num = $row['SalesNumber'];
                                        $item_name = $row['ItemName'];
                                        $price = $row['Price'];
                                        $quantity = $row['Quantity'];
                                        $discount_amount = $row['DiscountAmount'];
                                        $discounted_amount = $row['DiscountedAmount'];
                                        $cash_from_customer = $row['CashFromCustomer'];
                                        $change_to_the_customer = $row['ChangeToTheCustomer'];
                                        echo '<tr row_id="'.$sales_num.'">';
                                        echo '<th id="salesNum" scope="row">'.$sales_num.'</th>';
                                        echo '<td>'.$item_name.'</td>';
                                        echo '<td>'.$price.'</td>';
                                        echo '<td>'.$quantity.'</td>';
                                        echo '<td>'.$discount_amount.'</td>';
                                        echo '<td>'.$discounted_amount.'</td>';
                                        echo '<td>'.$cash_from_customer.'</td>';
                                        echo '<td>'.$change_to_the_customer.'</td>';
                                        echo '</tr>';
                                        echo '</a>';
                                    }
                                }    
                            }
                            elseif (isset($_GET['error2'])) {
                                $error2 = $_GET['error2'] == "norecord";
                                echo '<script>alert("no record found")</script>';
                                echo '<script>alert("reloading page")</script>';
                                $query = "SELECT * FROM sales_pos_a";
                                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                if (mysqli_num_rows($run_query) > 0){
                                    while ($row = mysqli_fetch_array($run_query)){
                                        $sales_num = $row['SalesNumber'];
                                        $item_name = $row['ItemName'];
                                        $price = $row['Price'];
                                        $quantity = $row['Quantity'];
                                        $discount_amount = $row['DiscountAmount'];
                                        $discounted_amount = $row['DiscountedAmount'];
                                        $cash_from_customer = $row['CashFromCustomer'];
                                        $change_to_the_customer = $row['ChangeToTheCustomer'];
                                        echo '<tr row_id="'.$sales_num.'">';
                                        echo '<th id="salesNum" scope="row">'.$sales_num.'</th>';
                                        echo '<td>'.$item_name.'</td>';
                                        echo '<td>'.$price.'</td>';
                                        echo '<td>'.$quantity.'</td>';
                                        echo '<td>'.$discount_amount.'</td>';
                                        echo '<td>'.$discounted_amount.'</td>';
                                        echo '<td>'.$cash_from_customer.'</td>';
                                        echo '<td>'.$change_to_the_customer.'</td>';
                                        echo '</tr>';
                                        echo '</a>';
                                    }
                                }
                            }    
                            else {
                                $query = "SELECT * FROM sales_pos_a";
                                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                if (mysqli_num_rows($run_query) > 0){
                                    while ($row = mysqli_fetch_array($run_query)){
                                        $sales_num = $row['SalesNumber'];
                                        $item_name = $row['ItemName'];
                                        $price = $row['Price'];
                                        $quantity = $row['Quantity'];
                                        $discount_amount = $row['DiscountAmount'];
                                        $discounted_amount = $row['DiscountedAmount'];
                                        $cash_from_customer = $row['CashFromCustomer'];
                                        $change_to_the_customer = $row['ChangeToTheCustomer'];
                                        echo '<tr row_id="'.$sales_num.'">';
                                        echo '<th id="salesNum" scope="row">'.$sales_num.'</th>';
                                        echo '<td>'.$item_name.'</td>';
                                        echo '<td>'.$price.'</td>';
                                        echo '<td>'.$quantity.'</td>';
                                        echo '<td>'.$discount_amount.'</td>';
                                        echo '<td>'.$discounted_amount.'</td>';
                                        echo '<td>'.$cash_from_customer.'</td>';
                                        echo '<td>'.$change_to_the_customer.'</td>';
                                        echo '</tr>';
                                        echo '</a>';
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
</main>

</body>
</html>
<?php  }
else{
    echo '<script>alert("Unauthorized Web Access")</script>';
  echo '<script>window.location.href="dashboard.php"</script>';
}
?>