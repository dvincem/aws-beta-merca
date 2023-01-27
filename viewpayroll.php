<?php 
include "config.php";
session_start();
if($_SESSION['usertype']=="hr" || $_SESSION['usertype']=="superadmin"){ 
  if(isset($_GET['id'])){
    $id = trim($_GET['id'])-0;
    $sql = "SELECT * FROM employee WHERE id=$id";
    $run_query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if (mysqli_num_rows($run_query) > 0){
    while ($row = mysqli_fetch_array($run_query)){
          $empnumber = $row['employeenumber'];
          $employeename = $row['employeename'];
          $employeenames = explode (" ", $employeename); 
          $firstname = $employeenames[0];
          $middlename = $employeenames[1];
          $surname = $employeenames[2];
          $gender = $row['gender'];
          $birthdate = $row['birthdate'];
          $nationality = $row['nationality'];
          $civilstatus = $row['civilstatus'];
          $department = $row['department'];
          $designation = $row['designation'];
          $dependent = $row['dependent'];
          $employeestatus = $row['employeestatus'];
          $picture = $row['picture'];
          $number = $row['contactnumber'];
          $email = $row['email'];
          $age = $row['age'];
          $paydate = $row['paydate'];
        }
      }
      $sql2 = "SELECT * FROM payroll WHERE employeeid_fk=$id";
    $run_query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    if (mysqli_num_rows($run_query2) > 0){
    while ($fetch = mysqli_fetch_array($run_query2)){
          $totalbasicpay = $fetch['basicincome'];
          $totalhonorpay=$fetch['honorarium'];
          $totalotherpay=$fetch['otherincome'];
          $totaldeduction=$fetch['totaldeduction'];
          $SSS=$fetch['sss'];
          $pagibig=$fetch['pagibig'];
          $philhealth=$fetch['philhealth'];
          $tax=$fetch['tax'];
          $netincome=$fetch['netincome'];
          $gross_income=$fetch['grossincome'];
        }
      }
      else{
        $totalbasicpay = "n/a";
          $totalhonorpay="n/a";
          $totalotherpay="n/a";
          $totaldeduction="n/a";
          $SSS="n/a";
          $pagibig="n/a";
          $philhealth="n/a";
          $tax="n/a";
          $netincome="n/a";
          $gross_income="n/a";
      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>View Payroll</title>
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
        </script>
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/webp2.css">
    
    <script src="computation.js">
    </script>
    <script>
      function cleartexts()
{
    document.getElementById("rateperhourbasic").value = "";
    document.getElementById("noofhoursbasic").value = "";
    document.getElementById("totalbasicpay").value = "";
    document.getElementById("rateperhourhonor").value = "";
    document.getElementById("noofhourshonor").value = "";
    document.getElementById("totalhonorpay").value = "";
    document.getElementById("rateperhourother").value = "";
    document.getElementById("noofhourother").value = "";
    document.getElementById("totalotherpay").value = "";
    document.getElementById("ssscontri").value = "";
    document.getElementById("philhealthcontri").value = "";
    document.getElementById("pagibigcontri").value = "";
    document.getElementById("tax").value = "";
    document.getElementById("sssloan").value = "";
    document.getElementById("pagibigloan").value = "";
    document.getElementById("facultydeposit").value = "";
    document.getElementById("facultyloan").value = "";
    document.getElementById("salaryloan").value = "";
    document.getElementById("others").value = "";
    document.getElementById("grossincome").value = "";
    document.getElementById("netincome").value = "";
    document.getElementById("totaldeduction").value = "";
}
</script>
<script>
function cancels()
{
    document.getElementById("empnumber").value = "";
    document.getElementById("picture").value = "";
    document.getElementById("firstname").value = "";
    document.getElementById("middlename").value = "";
    document.getElementById("surname").value = "";
    document.getElementById("civilstatus").value = "";
    document.getElementById("designation").value = "";
    document.getElementById("noofdependents").value = "";
    document.getElementById("paydate").value = "";
    document.getElementById("empstatus").value = "";
    document.getElementById("department").value = "";
    document.getElementById("rateperhourbasic").value = "";
    document.getElementById("noofhoursbasic").value = "";
    document.getElementById("totalbasicpay").value = "";
    document.getElementById("rateperhourhonor").value = "";
    document.getElementById("noofhourshonor").value = "";
    document.getElementById("totalhonorpay").value = "";
    document.getElementById("rateperhourother").value = "";
    document.getElementById("noofhourother").value = "";
    document.getElementById("totalotherpay").value = "";
    document.getElementById("ssscontri").value = "";
    document.getElementById("philhealthcontri").value = "";
    document.getElementById("pagibigcontri").value = "";
    document.getElementById("tax").value = "";
    document.getElementById("sssloan").value = "";
    document.getElementById("pagibigloan").value = "";
    document.getElementById("facultydeposit").value = "";
    document.getElementById("facultyloan").value = "";
    document.getElementById("salaryloan").value = "";
    document.getElementById("others").value = "";
    document.getElementById("grossincome").value = "";
    document.getElementById("netincome").value = "";
    document.getElementById("totaldeduction").value = "";



}
    </script>
    
</head>
<body style="background-image: url(bg.webp);
            no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;">
    <!--Employee Details-->
    <section id="empdetails" >
        <div class="container-md form-group border p-3 border-dark" id="empdetailscontainer" style="background-color: #EDE1CF;">
            <div class="row my-2 gy-5 gx-10" id="empdetails2">
                <div class="col-lg-4" id="empdetails5">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <img src="emp_pics/<?php echo $picture;?>" style="margin-left: 75px;" alt="Photo" id="emppic">
                </div>
                <div class="col-lg-4" id="empdetails3">
                    
                        <label class="form-label"><p>Employee Number:</p></label><input type="text"  id="empnumber" name="empnumber" value="<?php echo($empnumber) ?>" >
                        <label class="form-label"><p>First Name:</p></label><input type="text"  id="firstname" name="firstname" value="<?php echo($firstname) ?>" disabled>
                        <label class="form-label"><p>Middle Name:</p></label><input type="text"  id="middlename" name="middlename" value="<?php echo($middlename) ?>" disabled>
                        <label class="form-label"><p>Surname:</p></label><input type="text" id="surname"  name="surname" value="<?php echo($surname) ?>" disabled>
                        <label class="form-label"><p>Civil Status:</p></label><input type="text"  id="civilstatus" name="civilstatus" value="<?php echo($civilstatus) ?>" disabled>
                        <label class="form-label"><p>Designation:</p></label><input type="text"  id="designation" name="designation" value="<?php echo($designation) ?>" disabled>
                </div>
                <div class="col-lg-4" id="empdetails4">
                    <label class="form-label">Qualified Dependent Status:</label><input type="text"  id="dependent" name="dependent" value="<?php echo($dependent) ?>" >
                    <label class="form-label">Paydate:</label><input type="date"  id="paydate" name="paydate" value="<?php echo($paydate) ?>" required >
                    <label class="form-label">Employee Status: </label><input type="text"  id="empstatus" name="empstatus" value="<?php echo($employeestatus) ?>" disabled> 
                    <label class="form-label">Department: </label><input type="text"  id="department" name="department" value="<?php echo($department) ?>" disabled> 
                        
                </div>
            </div>
        </div>
    </section>
    <section id="pays">
        <div class="container-md" id="empdetailscontainer2">
            <div class="row my-2 " id="empdetailscontainer1">
                <div class="col-lg-7" id="empdetails6">
                    <fieldset class="form-group border p-3 border-dark bg-secondary">
                        <legend class="w-auto px-2 border border-dark bg-secondary">Basic Pay</legend>
                        <label class="form-label"><p>Income per Cutoff</p></label><input type="text" id="totalbasicpay" value="<?php echo($totalbasicpay) ?>" disabled>
                    </fieldset>
                    <div class="row">
                        <div class="col-lg-12" id="empdetails8">
                            <fieldset class="form-group border p-3 my-3  border-dark bg-secondary">
                                <legend class="w-auto px-2 border border-dark bg-secondary">Honorarium</legend>
                                <label class="form-label"><p>Total Honorarium Pay:</p></label><input type="text"  id="totalhonorpay" value="<?php echo($totalhonorpay) ?>"disabled>
                            </fieldset>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-lg-12 " id="empdetails9" >
                                <fieldset class="form-group border p-3 border-dark bg-secondary">
                                    <legend class="w-auto px-2 border border-dark bg-secondary">Other Income</legend>
                                    <label class="form-label"><p>Total Other Income Pay:</p></label><input type="text"  id="totalotherpay" value="<?php echo($totalotherpay) ?> " disabled>
                                </fieldset>
                            </div>  
                    </div>
                </div>  
                <div class="col-lg-5" id="empdetails7">
                    <fieldset class="form-group border p-3 border-dark bg-secondary">
                        <legend class="w-auto px-2 border border-dark bg-secondary">Regular Deduction</legend>
                        <label class="form-label"><p>SSS Contribution:</p></label><input type="text"  id="ssscontri" value="<?php echo($SSS) ?>" disabled>
                        <label class="form-label"><p>PhilHealth Contribution:</p></label><input type="text"  id="philhealthcontri" value="<?php echo($philhealth) ?>" disabled>
                        <label class="form-label"><p>Pagibig Contribution:</p></label><input type="text"  id="pagibigcontri" value="<?php echo($pagibig) ?>" disabled>
                        <label class="form-label"><p>Tax:</p></label><input type="text"  id="tax" value="<?php echo($tax) ?>" disabled>
                    </fieldset>
                    <br>
                    <div class="row">
                        <div class="col-lg-12" id="empdetails9" >
                    <fieldset class="form-group border p-3 border-dark bg-secondary">
                        <legend class="w-auto px-2 border border-dark bg-secondary">Deduction Summary</legend>
                        <label class="form-label"><p>Total Deductions: </p></label><input type="text"  id="totaldeduction" value="<?php echo($totaldeduction) ?>" disabled>
                    </fieldset>
                </div>    
                    </div>
                </div> 
            </div>
            <div class="row my-2 d-flex d-flex justify-content-center" id="empdetailscontainer2">
                <div class="col-lg-7" id="empdetails9" >
                    <fieldset class="form-group border p-3 border-dark bg-secondary">
                        <legend class="w-auto px-2 border border-dark bg-secondary">Income Salary</legend>
                        <label class="form-label"><p>Gross Income:</p></label><input type="text"  id="grossincome" value="<?php echo($gross_income) ?>" disabled>
                        <label class="form-label"><p>Net Income:</p></label><input type="text"  id="netincome" value="<?php echo($netincome) ?> "disabled>
                    </fieldset>
                </div>
            </div>
            <div class="row my-2 gx-5 gy-2 d-flex justify-content-center">
                    <a href="payroll_report.php" class="btn col-lg-2 btn-warning"> Exit </a>
                </form>
            </div>
        </div>
    </section>  

<script>
  $(document).ready(()=>{
      $('#picture').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#emppic').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
    });
</script>
</body>
</html>
<?php }
else{
  echo '<script>alert("Unauthorized Web Access")</script>';
  echo '<script>window.location.href="dashboard.php"</script>';
}
?>