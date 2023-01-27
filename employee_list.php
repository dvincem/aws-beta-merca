<?php
include "config.php";
session_start();
if($_SESSION['usertype']=="hr" || $_SESSION['usertype']=="superadmin"){ 
    
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Employees</title>
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
        </script>
    <link rel="stylesheet" href="css/main.min.css">
    <script>
        $(document).ready(function(){
            $('table tr').click(function(){
                var id = $(this).attr('row_id');
                window.open("http://localhost/MERCAPIZZA/public/employee_update.php?id=" + id);
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
      <a href="employee_list.php" class="active">
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
    <br>
    <br>
    <br>
    <br>
<section id="main">

<div class="container-sm form-group border p-3  justify-content-center border-dark rounded" id="empdetailscontainer" style="background-color: #EDE1CF;">
    
    <!-- ADDED HEADER -->
    <div class="row my-2">
      <div class="col-lg-4">
          <h2 style= "font-weight: bold;"><i class="bi bi-credit-card-2-front"></i> Employee List</h2>
          <a href="employee_add.php" class="btn btn-sm btn-dark"><i class="bi bi-person-plus"></i> Add New Employee</a>
      </div>
    </div>

    <!-- SEARCH FEATURE -->
    <!-- refer to includes folder.. file name search_code.php line 44 -->
    <form action="includes/search_code.php" method="POST">
      <div class="row g-1 align-items-center justify-content-end">
          <div class="col-auto">
              <label for="searchNum" class="col-form-label">Employee Number:</label>
          </div>
          <div class="col-auto">
              <input type="search" id="searchNum" name="searchNum"class="form-control"  placeholder="eg. 1234567890">
          </div>
          <div class="col-auto">
              <button type="submit" id="search_emp_list" name="search_emp_list" class="btn btn-sm btn-danger"><i class="bi bi-search"></i></button>
          </div>
      </div>
    </form>
    <div class="row my-2 gy-5 gx-10 justify-content-center">
        <div class="col-lg-12 d-flex justify-content-center">
        <table class="table table-hover border-dark">
  <thead>
    <tr>
      <th scope="col">Employee Number</th>
      <th scope="col">Employee Name</th>
      <th scope="col">Gender</th>
      <th scope="col">Date of Birth</th>
      <th scope="col">Nationality</th>
      <th scope="col">Civil Status</th>
      <th scope="col">Designation</th>
      <th scope="col">Department</th>
      <th scope="col">Employee Status</th>
    </tr>
  </thead>
  <tbody>

    <!-- NEW TABLE ADDED -->
    <?php 
      if (isset($_GET['empNum'])) {
        $empNum = $_GET['empNum'];
        $query = "SELECT * FROM employee WHERE employeenumber = '$empNum'";
        $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($run_query) > 0){
          while ($row = mysqli_fetch_array($run_query)){
            $employeeid = $row['employeenumber'];
            $employeename = $row['employeename'];
            $gender = $row['gender'];
            $birthdate = $row['birthdate'];
            $nationality = $row['nationality'];
            $civilstatus = $row['civilstatus'];
            $designation = $row['designation'];
            $department = $row['department'];
            $id = $row['id'];
            $employeestatus = $row['employeestatus'];
            echo '<tr row_id="'.$id.'">';
            echo '<th scope="row">'.$employeeid.'</th>';
            echo '<td>'.$employeename.'</td>';
            echo '<td>'.$gender.'</td>';
            echo '<td>'.$birthdate.'</td>';
            echo '<td>'.$nationality.'</td>';
            echo '<td>'.$civilstatus.'</td>';
            echo '<td>'.$designation.'</td>';
            echo '<td>'.$department.'</td>';
            echo '<td>'.$employeestatus.'</td>';
            echo '</tr>';
            echo '</a>';
          } // end while
        }
      } // end if
      elseif (isset($_GET['error1'])) {
        $error1 = $_GET['error1'] == "empty";
        echo '<script>alert("empty search")</script>';
        echo '<script>alert("reloading page")</script>';
        $query = "SELECT * FROM employee";
        $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($run_query) > 0){
          while ($row = mysqli_fetch_array($run_query)){
            $employeeid = $row['employeenumber'];
            $employeename = $row['employeename'];
            $gender = $row['gender'];
            $birthdate = $row['birthdate'];
            $nationality = $row['nationality'];
            $civilstatus = $row['civilstatus'];
            $designation = $row['designation'];
            $department = $row['department'];
            $id = $row['id'];
            $employeestatus = $row['employeestatus'];
            echo '<tr row_id="'.$id.'">';
            echo '<th scope="row">'.$employeeid.'</th>';
            echo '<td>'.$employeename.'</td>';
            echo '<td>'.$gender.'</td>';
            echo '<td>'.$birthdate.'</td>';
            echo '<td>'.$nationality.'</td>';
            echo '<td>'.$civilstatus.'</td>';
            echo '<td>'.$designation.'</td>';
            echo '<td>'.$department.'</td>';
            echo '<td>'.$employeestatus.'</td>';
            echo '</tr>';
            echo '</a>';
          } // end while
        }    
      } // end elseif
      elseif (isset($_GET['error2'])) {
        $error2 = $_GET['error2'] == "norecord";
        echo '<script>alert("no record found")</script>';
        echo '<script>alert("reloading page")</script>';
        $query = "SELECT * FROM employee";
        $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($run_query) > 0){
          while ($row = mysqli_fetch_array($run_query)){
            $employeeid = $row['employeenumber'];
            $employeename = $row['employeename'];
            $gender = $row['gender'];
            $birthdate = $row['birthdate'];
            $nationality = $row['nationality'];
            $civilstatus = $row['civilstatus'];
            $designation = $row['designation'];
            $department = $row['department'];
            $id = $row['id'];
            $employeestatus = $row['employeestatus'];
            echo '<tr row_id="'.$id.'">';
            echo '<th scope="row">'.$employeeid.'</th>';
            echo '<td>'.$employeename.'</td>';
            echo '<td>'.$gender.'</td>';
            echo '<td>'.$birthdate.'</td>';
            echo '<td>'.$nationality.'</td>';
            echo '<td>'.$civilstatus.'</td>';
            echo '<td>'.$designation.'</td>';
            echo '<td>'.$department.'</td>';
            echo '<td>'.$employeestatus.'</td>';
            echo '</tr>';
            echo '</a>';
          } // end while
        }
      } // end elseif    
      else {
        $query = "SELECT * FROM employee";
        $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($run_query) > 0){
          while ($row = mysqli_fetch_array($run_query)){
            $employeeid = $row['employeenumber'];
            $employeename = $row['employeename'];
            $gender = $row['gender'];
            $birthdate = $row['birthdate'];
            $nationality = $row['nationality'];
            $civilstatus = $row['civilstatus'];
            $designation = $row['designation'];
            $department = $row['department'];
            $id = $row['id'];
            $employeestatus = $row['employeestatus'];
            echo '<tr row_id="'.$id.'">';
            echo '<th scope="row">'.$employeeid.'</th>';
            echo '<td>'.$employeename.'</td>';
            echo '<td>'.$gender.'</td>';
            echo '<td>'.$birthdate.'</td>';
            echo '<td>'.$nationality.'</td>';
            echo '<td>'.$civilstatus.'</td>';
            echo '<td>'.$designation.'</td>';
            echo '<td>'.$department.'</td>';
            echo '<td>'.$employeestatus.'</td>';
            echo '</tr>';
            echo '</a>';
          } // end while
        }
      } // end else
    ?>
  </tbody>
</table>
        </div>
    </div>


</div>

</section>

</body>
</html>
<?php }
else{
  echo '<script>alert("Unauthorized Web Access")</script>';
    echo '<script>window.location.href="dashboard.php"</script>';
}?>