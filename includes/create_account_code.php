<?php

    if(isset($_POST['create_final'])){
        
        include 'config.php';
        
        # variables
        $Fname = $_POST ['Fname'];
        $Lname = $_POST ['Lname'];
        $Age = $_POST ['Age'];
        $Username = $_POST ['Username'];
        $Email = $_POST ['Email'];
        $Password = $_POST ['Password'];
        $Repeat_password = $_POST ['Repeat_pass'];
        $usertype = $_POST['usertype'];

        # error codes
        if(empty($Username) || empty($Email) || empty($Password) || empty($Repeat_password) ||empty($Fname) || empty($Lname) || empty($Age)){
            header("location: ../create_account.php?error=empty%fields&Username=".$Username."&email=".$Email."&fname=".$Fname."&lname=".$Lname."&age=".$Age."");
            exit();
        }
        elseif (preg_match("/[0-9]/", $Fname)) {
            header("location: ../create_account.php?error=fname%contains%numbers&Username=".$Username."&email=".$Email."&lname=".$Lname."&age=".$Age."");
            exit();
        }
        elseif (preg_match("/[0-9]/", $Lname)) {
            header("location: ../create_account.php?error=lname%contains%numbers&Username=".$Username."&email=".$Email."&fname=".$Fname."&age=".$Age."");
            exit();
        }
        elseif ($Age <= 15) {
            header("location: ../create_account.php?error=age&Username=".$Username."&email=".$Email."&fname=".$Fname."&lname=".$Lname."");
            exit();
        }
        elseif (!preg_match("/[a-zA-Z0-9]/", $Username)){
            header("location: ../create_account.php?error=invalid%username&email=".$Email."&fname=".$Fname."&name=".$Lname."&age=".$Age."");
            exit();
        }
        elseif ($Password !== $Repeat_password){
            header("location: ../create_account.php?error=password%did%not%match&Username=".$Username."&email=".$Email."&fname=".$Fname."&lname=".$Lname."&age=".$Age."");
            exit();
        }
        elseif (strlen($Password) <= 7) {
            header("location: ../create_account.php?error=passworderror!&Username=".$Username."&email=".$Email."&fname=".$Fname."&lname=".$Lname."&age=".$Age."");
            exit();
        }
        elseif (!preg_match("/[!\'^£$%&*()}{@#~?><>,|=_+¬-]/", $Password)) {
            header("location: ../create_account.php?error=password%must%have%atleast%1special%char&Username=".$Username."&email=".$Email."&fname=".$Fname."&lname=".$Lname."&age=".$Age."");
            exit();
        }
        elseif (!preg_match("/[0-9]/", $Password)) {
            header("location: ../create_account.php?error=password%must%have%atleast%1number&Username=".$Username."&email=".$Email."&fname=".$Fname."&lname=".$Lname."&age=".$Age."");
            exit();
        }
        elseif (!preg_match("/[a-zA-Z]/", $Password)) {
            header("location: ../create_account.php?error=password%must%have%atleast%1letter&Username=".$Username."&email=".$Email."&fname=".$Fname."&lname=".$Lname."&age=".$Age."");
            exit();
        }
        else{

            # checking for duplicates/ if already registered
            $sql = "SELECT username FROM logins WHERE username=?";
            $stmt = mysqli_stmt_init($conn);
            $dbcheck = mysqli_query($conn, "SELECT * FROM logins WHERE fname = '$Fname' AND lname = '$Lname' AND age = '$Age'");
            
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../create_account.php?error=error!");
                exit();
            }
            elseif (mysqli_num_rows($dbcheck)>0) {
                header("location:o ../create_account.php?error=account%info%already%registered!&Username=".$Username."&email=".$Email."");
                exit();
            }
            else {

                # checking for duplicates/ if already registered
                mysqli_stmt_bind_param($stmt,"s", $Username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $resultCheck = mysqli_stmt_num_rows($stmt);
                if($resultCheck > 0){
                    header("location: ../create_account.php?error=usernametaken&email=".$Email."");
                    exit();
                }
                else{

                    # submission/ input data to database
                    $sql = "INSERT INTO logins (fname, lname, age, username, email, pass, usertype) VALUES (?, ?, ?, ?, ?, ? , ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("location: ../create_account.php?error=error!");
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($stmt,"sssssss",  $Fname, $Lname, $Age, $Username, $Email, $Password, $usertype);
                        mysqli_stmt_execute($stmt);
                        header("location: ../dashboard.php");
                        exit();
                        }

                    }
                }
            }

    }  