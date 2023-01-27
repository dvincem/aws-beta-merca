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
}

//BASIC PAY 
$rateperhourbasic = '';
$noofhoursbasic = '';
$totalbasicpay =  '';

//HONORARIUM
$rateperhourhonor = '';
$noofhourshonor = '';
$totalhonorpay = '';

//Other Income 
$rateperhourother = '';
$noofhourother = '';
$totalotherpay ='';

//Regular deduction
$SSS ='';
$philhealth = '';
$pagibig =100;
$tax='';

//other deduction
$SSSLOAN='';
$PagibigLoan='';
$FacultyDeposit='';
$FacultyLoan='';
$salary_loan='';
$other='';

//total deduction
$totaldeduction ='';

//grossincome
$gross_income ='';

//netincome

$netincome = '';


if($_SERVER['REQUEST_METHOD']=='POST')
    {
      if(isset($_POST['calculate']))
      {
        //This will get the data from the texts/inputs

        //BASIC PAY CALCULATION
        $rateperhourbasic = floatval($_POST['rateperhourbasic']);
        $noofhoursbasic = floatval($_POST['noofhoursbasic']);
        $totalbasicpay =  $rateperhourbasic * $noofhoursbasic;

        //HONORARIUM CALCULATION
        $rateperhourhonor = floatval($_POST['rateperhourhonor']);
        $noofhourshonor = floatval($_POST['noofhourshonor']);
        $totalhonorpay = $rateperhourhonor*$noofhourshonor;

        //Other Income CALCULATION
        $rateperhourother = floatval($_POST['rateperhourother']);
        $noofhourother = floatval($_POST['noofhourother']);
        $totalotherpay = $rateperhourother* $noofhourother;

        //Other deduction
        $SSSLOAN= $_POST['sssloan'];
        $PagibigLoan=$_POST['pagibigloan'];
        $FacultyDeposit= $_POST['facultydeposit'];
        $FacultyLoan= $_POST['facultyloan'];
        $salary_loan=$_POST['salaryloan'] ;
        $other= $_POST['others'];

        //calculate gross income
        $gross_income = $totalbasicpay + $totalhonorpay + $totalotherpay;


        //philhealth contribution
        $philhealth = $gross_income*0.04;

        //sss contribution
        if($gross_income>=0 && $gross_income<= 3250){
            $SSS= 135;
           }
           else if($gross_income>=3250 && $gross_income<=3749.99){
             $SSS= 157.50;
           }
           else if($gross_income>=3750 && $gross_income<=4249.99){
             $SSS= 180;
           }
           else if($gross_income>=4250  && $gross_income<=4749.99){
             $SSS= 202.50;
           }
           else if($gross_income>=4750 && $gross_income<=5249.99){ 
             $SSS= 225;
           }
           else if($gross_income>=5250 && $gross_income<=5749.99){
             $SSS= 247.50;
           }
           else if($gross_income>=5750 && $gross_income<=6249.99){
             $SSS= 270;
           }
           else if($gross_income>=6250 && $gross_income<=6749.99){ 
             $SSS= 292.50;
           }
           else if($gross_income>=6750 && $gross_income<=7249.99){
             $SSS= 315;
           }
           else if($gross_income>=7250 && $gross_income<=7749.99){
             $SSS= 337.50;
           }
           else if($gross_income>=7750 && $gross_income<=8249.99){
             $SSS= 360;
           }
           else if($gross_income>=8250 && $gross_income<=8749.99){
             $SSS= 382.50;
           }
           else if($gross_income>=8750 && $gross_income<=9249.99){
             $SSS= 405;
           }
           else if($gross_income>=9250 && $gross_income<=9749.99){
             $SSS= 427.50;
           }
           else if($gross_income>=9750  && $gross_income<=10249.99){
             $SSS= 450;
           }
           else if($gross_income>=10250 && $gross_income<=10749.99){
             $SSS= 472.50;
           }
           else if($gross_income>=10750 && $gross_income<=11249.99){
             $SSS= 495;
           }
           else if($gross_income>=11250 && $gross_income<=11749.99){
             $SSS= 517.50;
           }
           else if($gross_income>=11750 && $gross_income<=12249.99){
             $SSS= 540;
           }
           else if($gross_income>=12250 && $gross_income<=12749.99){
             $SSS= 562.50;
           }
           else if($gross_income>=12750 && $gross_income<=13249.99){
             $SSS= 585;
           }
           else if($gross_income>=13250 && $gross_income<=13749.99){
             $SSS= 607.50;
           }
           else if($gross_income>=13750 && $gross_income<=14249.99){
             $SSS= 630;
           }
           else if($gross_income>=14250 && $gross_income<=14749.99){
             $SSS= 652.50;
           }
           else if($gross_income>=14750 && $gross_income<=15249.99){
             $SSS= 675;
           }
           else if($gross_income>=15250 && $gross_income<=15749.99){
             $SSS= 697.50;
           }
           else if($gross_income>=15750 && $gross_income<=16249.99){
             $SSS= 720;
           }
           else if($gross_income>=16250 && $gross_income<=16749.99){
             $SSS= 742.50;
           }
           else if($gross_income>=16750 && $gross_income<=17249.99){
             $SSS= 765;
           }
           else if($gross_income>=17250 && $gross_income<=17749.99){
             $SSS= 787.50;
           }
           else if($gross_income>=17750 && $gross_income<=18249.99){
             $SSS= 810;
           }
           else if($gross_income>=18250 && $gross_income<=18749.99){
             $SSS= 832.50;
           }
           else if($gross_income>=18750 && $gross_income<=19249.99){
             $SSS= 855;
           }
           else if($gross_income>=19250 && $gross_income<=19749.99){
             $SSS= 877.50;
           }
           else if($gross_income>=19750 && $gross_income<=20249.99){
             $SSS= 900;
           }
           else if($gross_income>=20250 && $gross_income<=20749.99){
             $SSS= 922.50;
           }
           else if($gross_income>=20750 && $gross_income<=21249.99){
             $SSS= 945;
           }
           else if($gross_income>=21250 && $gross_income<=21749.99){
             $SSS= 967.50;
           }
           else if($gross_income>=21750 && $gross_income<=22249.99){
             $SSS= 990;
           }
           else if($gross_income>=22250 && $gross_income<=22749.99){
             $SSS= 1012.50;
           }
           else if($gross_income>=22750  && $gross_income<=23249.99){
             $SSS= 1035;
           }
           else if($gross_income>=23250 && $gross_income<=23749.99){
             $SSS= 1057.50;
           }
           else if($gross_income>=23750 && $gross_income<=24249.99){
             $SSS= 1080;
           }
           else if($gross_income>=24250 && $gross_income<=24749.99){
             $SSS= 1102.50;
           }
           else if($gross_income>=24750 && $gross_income<=200000000){
             $SSS= 1125;
           }
           else{
             $SSS=0;
           }
     
     
        //tax contribution
         if ($gross_income>=0 && $gross_income<=10000.99){
             $tax= $gross_income*0.05;
           }
           else if ($gross_income>=10001 && $gross_income<=30000.99){
             $tax= $gross_income*0.10;
           }
           else if ($gross_income>=30001 && $gross_income<=70000.99){
             $tax= $gross_income*0.15;
           }
           else if ($gross_income>=70001 && $gross_income<=140000.99){
             $tax= $gross_income*0.20;
           }
           else if ($gross_income>=140001 && $gross_income<=250000.99){
             $tax= $gross_income*0.25;
           }
           else if ($gross_income>=250001 && $gross_income<=500000.99){
             $tax= $gross_income*0.30;
           }
           else if ($gross_income>500001){
             $tax= $gross_income*0.32;
           }
           else{
             $tax=0;
           }
        
        //total deductions
        $totaldeduction = $tax + $SSS + $philhealth + $pagibig + $SSSLOAN + $PagibigLoan + $FacultyDeposit + $FacultyLoan + $other;

        //net income
        $netincome = $gross_income - $totaldeduction;
        $insertsql = "INSERT INTO payroll(basicincome, honorarium, otherincome, grossincome, netincome, totaldeduction, sss, philhealth, pagibig, employeeid_fk) VALUES 
        ('$totalbasicpay', '$totalhonorpay', '$totalotherpay', '$gross_income', '$netincome', '$totaldeduction', '$SSS', '$philhealth', '$pagibig', $id) ";
      $sqlinsert = mysqli_query($conn, $insertsql);
      if($sqlinsert){
        echo '<script>alert("Payroll Added")</script>';
        echo '<script>window.location.href="dashboard.php"</script>';  
      }
      else{
        echo '<script>alert("Unknown Error Occured! ")</script>';
        echo '<script>window.location.href="webpage2.php"</script>';  
      }
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
    <title>WEBPAGE2</title>
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
    <label for="check" class="mb-5 mx-5">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
      <header>Payroll</header>
      <a href="dashboard.php" >
        <i class="fas fa-qrcode"></i>
        <span>Dashboard</span>
      </a>
      <a href="main/index1.php" >
        <i class="fas fa-link"></i>
        <span>POS A</span>
      </a>
      <a href="sales_pos_a.php">
        <i class="fas fa-stream"></i>
        <span>Sales POS A</span>
      </a>
      <a href="payroll_emplist.php" class="active">
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
      <a href="main/index2.php">
      <i class="fas fa-link"></i>
        <span>POS B</span>
      </a>
      <a href="sales_pos_b.php">
      <i class="fas fa-stream"></i>
        <span>Sales POS B</span>
      </a>
      <a href="employee_list.php">
        <i class="far fa-question-circle"></i>
        <span>User Account</span>
      </a>
      <a href="login_page.php">
        <i class="far fa-qr-code"></i>
        <span>Logout</span>
      </a>
    </div>
    </section>
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
                        <label class="form-label"><p>Rate/hour:</p></label><input type="text"  id="rateperhourbasic" name="rateperhourbasic" value="<?php echo($rateperhourbasic) ?>"  required>
                        <label class="form-label"><p>No. of hours/ Cutoff: </p></label><input type="text"  id="noofhoursbasic" name="noofhoursbasic" value="<?php echo($noofhoursbasic) ?>" required>
                        <label class="form-label"><p>Income per Cutoff</p></label><input type="text" id="totalbasicpay" value="<?php echo($totalbasicpay) ?>" disabled>
                    </fieldset>
                    <div class="row">
                        <div class="col-lg-12" id="empdetails8">
                            <fieldset class="form-group border p-3 my-3  border-dark bg-secondary">
                                <legend class="w-auto px-2 border border-dark bg-secondary">Honorarium</legend>
                                <label class="form-label"><p>Rate/hour:</p></label><input type="text"  id="rateperhourhonor" name="rateperhourhonor" value="<?php echo($rateperhourhonor) ?>" required>
                                <label class="form-label"><p>No. of hours/ Cutoff:</p></label><input type="text"  id="noofhourshonor" name="noofhourshonor" value="<?php echo($noofhourshonor) ?>" required>
                                <label class="form-label"><p>Total Honorarium Pay:</p></label><input type="text"  id="totalhonorpay" value="<?php echo($totalhonorpay) ?>"disabled>
                            </fieldset>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-lg-12 " id="empdetails9" >
                                <fieldset class="form-group border p-3 border-dark bg-secondary">
                                    <legend class="w-auto px-2 border border-dark bg-secondary">Other Income</legend>
                                    <label class="form-label"><p>Rate/hour:</p></label><input type="text"  id="rateperhourother" name="rateperhourother" value="<?php echo($rateperhourother) ?>" required>
                                    <label class="form-label"><p>No. of hours/ Cutoff:</p></label><input type="text"  id="noofhourother" name="noofhourother"  value="<?php echo($noofhourother) ?>" required>
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
                    <div class="row">
                        <div class="col-lg-12" id="empdetails9">
                            <fieldset class="form-group border my-3 p-3 border-dark bg-secondary">
                                <legend class="w-auto px-2 border border-dark bg-secondary">Other Deductions</legend>
                                <label class="form-label"><p>SSS loan:</p></label><input type="text"  id="sssloan" name="sssloan" value="<?php echo($SSSLOAN) ?>" required>
                                <label class="form-label"><p>Pagibig loan:</p></label><input type="text"  id="pagibigloan" name="pagibigloan" value="<?php echo($PagibigLoan) ?>" required>
                                <label class="form-label"><p>Faculty savings deposit:</p></label><input type="text"  id="facultydeposit" name="facultydeposit" value="<?php echo($FacultyDeposit) ?>" required>
                                <label class="form-label"><p>Faculty savings loan:</p></label><input type="text"  id="facultyloan" name="facultyloan" value="<?php echo($FacultyLoan) ?>" required>
                                <label class="form-label"><p>Salary loan:</p></label><input type="text"  id="salaryloan" name="salaryloan" value="<?php echo($salary_loan) ?>" required>
                                <label class="form-label"><p>others:</p></label><input type="text"  id="others" name="others" value="<?php echo($other) ?>" required>
                            </fieldset>
                    </div> 
                    </div>
                </div> 
            </div>
            <div class="row my-2" id="empdetailscontainer2">
                <div class="col-lg-7 " id="empdetails9" >
                    <fieldset class="form-group border p-3 border-dark bg-secondary">
                        <legend class="w-auto px-2 border border-dark bg-secondary">Income Salary</legend>
                        <label class="form-label"><p>Gross Income:</p></label><input type="text"  id="grossincome" value="<?php echo($gross_income) ?>" disabled>
                        <label class="form-label"><p>Net Income:</p></label><input type="text"  id="netincome" value="<?php echo($netincome) ?> "disabled>
                    </fieldset>
                </div>
                <div class="col-lg-5" id="empdetails9" >
                    <fieldset class="form-group border p-3 border-dark bg-secondary">
                        <legend class="w-auto px-2 border border-dark bg-secondary">Deduction Summary</legend>
                        <label class="form-label"><p>Total Deductions: </p></label><input type="text"  id="totaldeduction" value="<?php echo($totaldeduction) ?>" disabled>
                    </fieldset>
                </div>    
            </div>
            <div class="row my-2 gx-5 gy-2 cente-content-around ">
                    <input type="submit" value="Calculate" name="calculate" class="btn col-lg-2 btn-success" id="calc">
                    <input type="button" id="new" value="New" class="btn col-lg-2 btn-primary" onclick="cleartexts();">
                    <input type="button" value="Cancel" class="btn col-lg-2 btn-danger "onclick="cancels();">
                    <input type="button" value="Print Payslip" class="btn col-lg-2 btn-light">
                    <input type="button" value="Preview Payslip Details" class="btn col-lg-2 btn-info">
                    <a href="payroll_emplist.php" class="btn col-lg-2 btn-warning"> Exit </a>
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