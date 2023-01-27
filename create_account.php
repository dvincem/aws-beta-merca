<?php 
    include 'includes/config.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <!--Bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>MERCA's PIZZA</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-xxl">
            <a href="login_page.php" class="navbar-brand">
                <img src="logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                <span class="fw-bold text-light">MERCA's PIZZA</span>
            </a>
        </div>
    </nav>

    <!--Create Account-->
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
    <div class="container">
        <div class="row my-custom-row justify-content-around">
            <div class="col col-lg-6 col-md-7 col-sm-10" id="signup">
                <fieldset class="form-group rounded border p-1" id="fieldset">
                    <legend class="w-auto px-2"><img src="logo.png" alt="" width="100" height="100" class="d-inline-block"></legend>
                    <h2 class="heading text-light"><i class="bi bi-pen"></i> CREATE ACCOUNT</h2>

                    <!--error displays-->
                    <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error']== "empty%fields") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                Please fill up empty fields
                              </div>';
                            }
                            elseif ($_GET['error']== "fname%contains%numbers") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    firstname should contain letters only
                              </div>';
                            }
                            elseif ($_GET['error']== "lname%contains%numbers") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    lastname should contain letters only
                              </div>';
                            }
                            elseif ($_GET['error']== "age") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    age should be 16 or older
                              </div>';
                            }
                            elseif ($_GET['error']== "account%info%already%registered!") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    account info already registered
                              </div>';
                            }
                            elseif
                                ($_GET['error'] == "usernametaken" || $_GET['error'] == "usernametaken") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    the username is taken
                              </div>';
                            }
                            elseif
                                ($_GET['error']== "invalid%email") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    please enter a valid email address
                              </div>';
                            }
                            elseif
                                ($_GET['error']== "invalid%email%and%Username") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    email and username not valid
                              </div>';
                            }
                            elseif
                                ($_GET['error']== "password%did%not%match") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    password did not match
                              </div>';
                            }
                            elseif
                                ($_GET['error']== "password%must%have%atleast%1special%char") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                password must have atleast 1 special charachter
                              </div>';
                            }
                            elseif
                                ($_GET['error']== "password%must%have%atleast%1number") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    password must have atleast 1 number
                              </div>';
                            }
                            elseif
                                ($_GET['error']== "password%must%have%atleast%1letter") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    password must have atleast 1 letter
                              </div>';
                            }
                            elseif
                                ($_GET['error']== "passworderror!") {
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                password must be at least 8 characters long
                              </div>';
                            }
                            else{
                                echo '<div class="alert alert-danger mx-1" role="alert">
                                    Unknown error. please retry or refresh the page
                              </div>';
                            }
                            
                        }
                        if (isset($_GET['signup'])) {
                            if ($_GET['signup']== "success") {
                                echo '<div class="alert alert-info mx-1" role="alert">
                                Info successfully saved!
                              </div>';
                            }
                        }
                    ?>

                    <!--input group-->
                    <form class="p-1"action="includes/create_account_code.php" method="POST" novalidate>
                        
                        <!--personal infornamtion-->
                        <?php

                            # first name
                            if (isset($_GET['fname'])) {
                                $Fname = $_GET['fname'];
                                echo '
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Firstname</span>
                                    <input type="text" name="Fname" id="Fname" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"  value="'.$Fname.'" placeholder = "James">
                                </div>
                                <p id="validatefname"></p>
                                ';
                            }
                            else {
                                echo '
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Firstname</span>
                                    <input type="text" name="Fname" id="Fname" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder = "James">
                                </div>
                                <p id="validatefname"></p>
                                ';
                            }

                            # last name
                            if (isset($_GET['lname'])) {
                                $Lname = $_GET['lname'];
                                echo '
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Lastname</span>
                                    <input type="text" name="Lname"  id="Lname"class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"  value="'.$Lname.'" placeholder = "Bond">
                                </div>
                                <p id="validatelname"></p>
                                ';
                            }
                            else {
                                echo '
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Lastname</span>
                                    <input type="text" name="Lname"  id="Lname"class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder = "Bond">
                                </div>
                                <p id="validatelname"></p>
                                ';
                            }

                            # age
                            if (isset($_GET['age'])) {
                                $Age = $_GET['age'];
                                echo '
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Age</span>
                                    <input type="number" name="Age" id="Age" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"  value="'.$Age.'" placeholder = "16">
                                </div>
                                <p id="validateage"></p>
                                ';
                            }
                            else {
                                echo '
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Age</span>
                                    <input type="number" name="Age" id="Age" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder = "16">
                                </div>
                                <p id="validateage"></p>
                                ';
                            }

                            
                            # username
                            if (isset($_GET['Username'])) {
                                $Username = $_GET['Username'];
                                echo '
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" id="Username" name="Username" value="'.$Username.'" placeholder="sample1">
                                    <label for="Username"><i class="bi bi-person-circle"></i> Username</label>
                                </div>
                                <p id="validateuser"></p>
                                ';
                            }
                            else {
                                echo '
                                <div class="form-floating mb-3 mt-3">
                                    <input type="text" class="form-control" id="Username" name="Username" placeholder="sample1">
                                    <label for="Username"><i class="bi bi-person-circle"></i> Username</label>
                                </div>
                                <p id="validateuser"></p>
                                ';
                            }
                            # email
                            if (isset($_GET['email'])) {
                                $email = $_GET['email'];
                                echo '
                                <div class="form-floating mb-3 mt-3">
                                    <input type="email" class="form-control" id="Email" name="Email" value="'.$email.'" placeholder="sample@merca.com">
                                    <label for="Email"><i class="bi bi-envelope-fill"></i> Create Email</label>
                                </div>
                                <p id="validateemail"></p>
                                ';
                            }
                            else {
                                echo '
                                <div class="form-floating mb-3 mt-3">
                                    <input type="email" class="form-control" id="Email" name="Email" placeholder="sample@merca.com">
                                    <label for="Email"><i class="bi bi-envelope-fill"></i> Create Email</label>
                                </div>
                                <p id="validateemail"></p>
                                ';
                            }
                        ?>
                        <div class="form-floating mb-3">
                            <select name="usertype" class="form-control">
                                <option value="cashier1">Cashier A</option>
                                <option value="hr">HR</option>
                                <option value="cashier2">Cashier B</option>
                            </select>
                            <label for="Password" class="text-dark"><i class="bi bi-person-fill-gear"></i> User Type</label>
                        </div>
                        <!--create password-->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" >
                            <label for="Password"><i class="bi bi-key-fill"></i> Create Password</label>
                        </div>
                        <p id="validatepass"></p>
                        <!--repeat password-->
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="Repeat_pass" name="Repeat_pass" placeholder="Password" >
                            <label for="Repeat_pass"><i class="bi bi-key-fill"></i> Repeat Password</label>
                        </div>
                        <p id="validaterepass"></p>

                        <!-- create account btn-->
                        <div class="d-grid gap-2 d-md-flex justify-content-end">
                            <button type="submit" id="signup" class="btn btn-link submit-button btn-outline-light" name="create_final">
                            <i class="bi bi-person-plus"></i> Create Account
                            </button>
                        </div>
                    </form>
                </fieldset>    
            </div>
        </div>
    </div>
    
    
    <!--footer-->
    <footer id="footer">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col text-center">
                    <div class="copyright text-light">
                        <i class="bi bi-c-circle"></i> Copyright <strong> Merca's Pizza</strong>. All Rights Reserved
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <style>
        .form-control:focus{border-color: #5cb85c;  box-shadow: none; -webkit-box-shadow: none;} 
        .has-error .form-control:focus{box-shadow: none; -webkit-box-shadow: none;}
    </style>

    <!--scripts-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        let fname = document.getElementById('Fname'),
            lname = document.getElementById('Lname'),
            age = document.getElementById('Age'),
            emp_num = document.getElementById('Emp_num');
        let username = document.getElementById('Username'),
            email = document.getElementById('Email'),
            password = document.getElementById('Password'),
            repass = document.getElementById('Repeat_pass');
        Fname.addEventListener('keyup', validate);
        Lname.addEventListener('keyup', validate);
        Age.addEventListener('keyup', validate);
        Emp_num.addEventListener('keyup', validate);
        Username.addEventListener('keyup', validate);
        Email.addEventListener('keyup', validate);
        Password.addEventListener('keyup', validate);
        Repeat_pass.addEventListener('keyup', validate);

        function validate(event){
            mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            special = /[!\'^£$%&*()}{@#~?><>,|=_+¬-]/;
            char = /[a-zA-Z]/;
            int = /[0-9]/;
            invalid = "must contain letters only";
            

            // for firstname
            if (fname.value == null || fname.value == "") {
                document.getElementById('validatefname').innerText = "";
                document.getElementById('validatefname').className = "text-danger";
                document.getElementById('Fname').className = "form-control border-danger border-3";
            }
            else if (int.test(fname.value)){
                document.getElementById('validatefname').innerText = invalid;
                document.getElementById('validatefname').className = "text-danger";
                document.getElementById('Fname').className = "form-control border-danger border-3";
            }
            else {
                document.getElementById('validatefname').innerText = "";
                document.getElementById('validatefname').className = "text-success";
                document.getElementById('Fname').className = "form-control border-success border-2";
            }

            // for lastname
            if (lname.value == null || lname.value == "") {
                document.getElementById('validatelname').innerText = "";
                document.getElementById('validatelname').className = "text-danger";
                document.getElementById('Lname').className = "form-control border-danger border-3";
            }
            else if (int.test(lname.value)){
                document.getElementById('validatelname').innerText = invalid;
                document.getElementById('validatelname').className = "text-danger";
                document.getElementById('Lname').className = "form-control border-danger border-3";
            }
            else {
                document.getElementById('validatelname').innerText = "";
                document.getElementById('validatelname').className = "text-success";
                document.getElementById('Lname').className = "form-control border-success border-2";
            }

            // for age
            invalidage = "must be 16 or older";
            if (age.value == null || age.value == "") {
                document.getElementById('validateage').innerText = "";
                document.getElementById('validateage').className = "text-danger";
                document.getElementById('Age').className = "form-control border-danger border-3";
            }
            else if (age.value <= 15){
                document.getElementById('validateage').innerText = invalidage;
                document.getElementById('validateage').className = "text-danger";
                document.getElementById('Age').className = "form-control border-danger border-3";
            }
            else {
                document.getElementById('validateage').innerText = "";
                document.getElementById('validateage').className = "text-success";
                document.getElementById('Age').className = "form-control border-success border-2";
            }
            

            //for username
            invaliduser = "must be 4 characters or longer";
            if (username.value == null || username.value == "") {
                document.getElementById('validateuser').innerText = "";
                document.getElementById('validateuser').className = "text-danger";
                document.getElementById('Username').className = "form-control border-danger border-3";
            }
            else if (username.value.length <= 3) {
                document.getElementById('validateuser').innerText = invaliduser;
                document.getElementById('validateuser').className = "text-danger";
                document.getElementById('Username').className = "form-control border-danger border-3";
            }
            else{
                document.getElementById('validateuser').innerText = "";
                document.getElementById('validateuser').className = "text-success";
                document.getElementById('Username').className = "form-control border-success border-2";
            }
            
            // for email
            invalidmail = "email not valid";
            if (email.value == null || email.value == "") {
                document.getElementById('validateemail').innerText = "";
                document.getElementById('validateemail').className = "text-danger";
                document.getElementById('Email').className = "form-control border-danger border-3";
            }
            else if (!mailformat.test(email.value)) {
                document.getElementById('validateemail').innerText = invalidmail;
                document.getElementById('validateemail').className = "text-danger";
                document.getElementById('Email').className = "form-control border-danger border-3";
            }
            else{
                document.getElementById('validateemail').innerText = "";
                document.getElementById('validateemail').className = "text-success";
                document.getElementById('Email').className = "form-control border-success border-2";
            }

            // for password
            invalidpass_special = "must have atleast 1 special character";
            invalidpass_letter = "must have atleast 1 letter";
            invalidpass_number = "must have atleast 1 number";
            invalidpass_longer = "must have atleast 8 characters long";
            if (password.value == null || password.value == "") {
                document.getElementById('validatepass').innerText = "";
                document.getElementById('validatepass').className = "text-danger";
                document.getElementById('Password').className = "form-control border-danger border-3";
            }
            else if (password.value.length <= 7) {
                document.getElementById('validatepass').innerText = invalidpass_longer;
                document.getElementById('validatepass').className = "text-danger";
                document.getElementById('Password').className = "form-control border-danger border-3";
            }
            else if (!special.test(password.value)) {
                document.getElementById('validatepass').innerText = invalidpass_special;
                document.getElementById('validatepass').className = "text-danger";
                document.getElementById('Password').className = "form-control border-danger border-3";
            }
            else if (!char.test(password.value)) {
                document.getElementById('validatepass').innerText = invalidpass_letter;
                document.getElementById('validatepass').className = "text-danger";
                document.getElementById('Password').className = "form-control border-danger border-3";
            }
            else if (!int.test(password.value)) {
                document.getElementById('validatepass').innerText = invalidpass_number;
                document.getElementById('validatepass').className = "text-danger";
                document.getElementById('Password').className = "form-control border-danger border-3";
            }
            else{
                document.getElementById('validatepass').innerText = "";
                document.getElementById('validatepass').className = "text-success";
                document.getElementById('Password').className = "form-control border-success border-2";
            }

            // for repeat-password
            invalidpass_notmatch = "password does not match";
            if (repass.value == null || repass.value == "") {
                document.getElementById('validaterepass').innerText = "";
                document.getElementById('validaterepass').className = "text-danger";
                document.getElementById('Repeat_pass').className = "form-control border-danger border-3";
            }
            else if (password.value != repass.value) {
                document.getElementById('validaterepass').innerText = invalidpass_notmatch;
                document.getElementById('validaterepass').className = "text-danger";
                document.getElementById('Repeat_pass').className = "form-control border-danger border-3";
            }
            else{
                document.getElementById('validaterepass').innerText = "";
                document.getElementById('validaterepass').className = "text-success";
                document.getElementById('Repeat_pass').className = "form-control border-success border-2";
            }
        }
    </script>

</body>
</html>