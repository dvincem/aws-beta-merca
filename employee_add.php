<?php
include "config.php";
session_start();
if($_SESSION['usertype']=="hr" || $_SESSION['usertype']=="superadmin"){
//Employee Details
$picture ='';
$empnumber ='';
$firstname ='';
$middlename ='';
$surname ='';
$civilstatus ='';
$designation ='';
$empstatus ='';
$paydate ='';
$department ='';
$number ='';
$email ='';
$birthdate ='';
$age='';
$dependent = '';

if(isset($_POST['submit'])){
    $proof_img = $_FILES["picture"]["name"];
    $imageTempName = $_FILES["picture"]["tmp_name"];
    $targetPath = "C:/xampp/htdocs/MERCAPIZZA/public/emp_pics/".$proof_img;
    $targetpicDB=$proof_img;
    move_uploaded_file($imageTempName, $targetPath);
    $empnumber =$_POST['empnumber'];
    $firstname =$_POST['firstname'];
    $middlename =$_POST['middlename'];
    $surname =$_POST['surname'];
    $employeename = $firstname." ".$middlename." ".$surname;
    $civilstatus =$_POST['civilstatus'];
    $designation =$_POST['designation'];
    $empstatus =$_POST['empstatus'];
    $paydate =$_POST['paydate'];
    $department =$_POST['department'];
    $number =$_POST['number'];
    $email =$_POST['email'];
    $birthdate =$_POST['birthdate'];
    $age=$_POST['age'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $dependent = $_POST['dependent'];
    $insertsql = "INSERT INTO employee(employeename, employeenumber, gender, birthdate, age, nationality, civilstatus, department, designation, employeestatus, contactnumber,email, picture, dependent) VALUES ('$employeename', '$empnumber', '$gender', '$birthdate', '$age', '$nationality', '$civilstatus', '$department', '$designation', '$empstatus', '$number','$email', '$targetpicDB', '$dependent') ";
      $sqlinsert = mysqli_query($conn, $insertsql);
      if($sqlinsert){
        echo '<script>alert("Employee Added")</script>';
        echo '<script>window.location.href="employee_list.php"</script>';  
      }
      else{
        echo '<script>alert("Unknown Error Occured! ")</script>';
        echo '<script>window.location.href="emploayee_add.php"</script>';  
      }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Add Employee</title>
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
        </script>
        <script>
    function calculate_age()
    {
    var birth_date = new Date(document.getElementById("birth_date").value);
    var birth_date_day = birth_date.getDate();
    var birth_date_month = birth_date.getMonth();
        var birth_date_year = birth_date.getFullYear();

    var today_date = new Date();
    var today_day = today_date.getDate();
        var today_month = today_date.getMonth();
        var today_year = today_date.getFullYear();

    var calculated_age = 0;

    if (today_month > birth_date_month) calculated_age = today_year - birth_date_year;
    else if (today_month == birth_date_month)
    {
      if (today_day >= birth_date_day) calculated_age = today_year - birth_date_year;
            else calculated_age = today_year - birth_date_year - 1;
    }
    else calculated_age = today_year - birth_date_year - 1;

    var output_value = calculated_age;
        document.getElementById("calculated_age").value = calculated_age;
    }

</script>
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/webp2.css">
    </head>
<body style="background-image: url(bg.webp);
no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;">
<nav class="navbar navbar-expand-md navbar-light">
        <div class="container-xxl">
            <a href="dashboard.php" class="navbar-brand">
                <img src="logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                <span class="fw-bold text-dark">MERCA's PIZZA</span>
            </a>
        </div>
    </nav>

<section id="form">
<div class="container-sm form-group border p-3  justify-content-center border-dark rounded" id="empdetailscontainer" style="background-color: #EDE1CF;">
            <div class="row my-2 gy-5 gx-10 justify-content-center" id="empdetails2">
                <div class="col-lg-4 d-flex justify-content-center" id="empdetails5">
                    <form action="employee_add.php" method="POST" enctype="multipart/form-data">
                        <img src="photos/avatar.png" alt="Photo" id="emppic">
                        <input type="file" id="picture" name="picture" class="btn" >
                <div class="row">
                  <div class="col-lg-12" id="empdetails8">
                      <br><label class="form-label">Paydate:</label><input type="date"  id="paydate" name="paydate" value="<?php echo($paydate) ?>" required>
                    <label class="form-label">Employee Status: </label><input type="text"  id="empstatus" name="empstatus" value="<?php echo($empstatus) ?>" required> 
                    <label class="form-label">Department: </label><input type="text"  id="department" name="department" value="<?php echo($department) ?>" required>
                    <label class="form-label"><p>Designation:</p></label><input type="text"  id="designation" name="designation" value="<?php echo($designation) ?>" required> 
                    <label class="form-label"><p>Qualified Dependent Status:</p></label><input type="text"  id="dependent" name="dependent" value="<?php echo($dependent) ?>" required> 
                  </div>
                </div>
            </div>
                <div class="col-lg-6" id="empdetails3">
                    
                        <label class="form-label"><p>Employee Number:</p></label><input type="text"  id="empnumber" name="empnumber" value="<?php echo($empnumber) ?>" required>
                        <label class="form-label"><p>First Name:</p></label><input type="text"  id="firstname" name="firstname" value="<?php echo($firstname) ?>" required>
                        <label class="form-label"><p>Middle Name:</p></label><input type="text"  id="middlename" name="middlename" value="<?php echo($middlename) ?>" >
                        <label class="form-label"><p>Surname:</p></label><input type="text" id="surname"  name="surname" value="<?php echo($surname) ?>" required>
                        <label class="form-label"><p>Civil Status:</p></label><input type="text"  id="civilstatus" name="civilstatus" value="<?php echo($civilstatus) ?>" required>
                        <label class="form-label">Birthdate:</label><input type="date"  id="birth_date" name="birthdate" value="<?php echo($birthdate) ?>" required>
                        <label class="form-label">Age:</label><input type="text" id="calculated_age" name="age" onmouseover="calculate_age()" required readonly>
                        <label class="form-label">Nationality:</label><input type="text" id="nationality" name="nationality"  required >
                        <label class="form-label">Gender:</label><select class="col-lg-7" aria-label="Default select example" name="gender" id="gender">
                        <option selected class="form-">Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        </select>  
                    <label class="form-label">Email: </label><input type="email"  id="empstatus" name="email" value="<?php echo($email) ?>" required> 
                    <label class="form-label">Contact Number:</label><input type="text"  id="number" name="number" value="<?php echo($number) ?>" required>
                            
                </div>
            </div>
            <div class="row my-2 gy-5 gx-10 justify-content-center" id="empdetails2">
                <div class="col-lg-5 d-flex justify-content-center" id="empdetails5">
                    <button type="submit" name="submit" class="btn btn-success col-lg-6">Submit</button>
                </div>
                
                <div class="col-lg-5 d-flex justify-content-center" id="empdetails5">
                    <a href="employee_list.php" class="btn btn-danger col-lg-6">Exit</a>
                </div>
            </div>
</form>
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