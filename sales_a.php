<?php
include "config.php";
session_start();
if($_SESSION['usertype']=="cashier1" || $_SESSION['usertype']=="superadmin"){
    if(isset($_GET['id'])){
        $id = trim($_GET['id'])-0;
        $sql = "SELECT * FROM sales_pos_a WHERE SalesNumber='$id'";
        $run_query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($run_query) > 0){
            while ($row = mysqli_fetch_array($run_query)){
                $SalesNumber = $row['SalesNumber'];
                $Price = $row['Price'];
                $Quantity = $row['Quantity'];
                $DiscountAmount = $row['DiscountAmount'];
                $DiscountedAmount = $row['DiscountedAmount'];
                $CashFromCustomer = $row['CashFromCustomer'];
                $ChangeToTheCustomer = $row['ChangeToTheCustomer'];
                $sqlup = "SELECT LEFT(RIGHT(ItemName, length(ItemName)-1), length(ItemName)-3) AS ItemName FROM sales_pos_a WHERE SalesNumber='$id'";
                $run_sqlup = mysqli_query($conn, $sqlup) or die(mysqli_error($conn));
                if (mysqli_num_rows($run_sqlup) > 0){
                    while ($row1 = mysqli_fetch_array($run_sqlup)){
                        $ItemName = $row1['ItemName'];
                    }
                }
                
            }
        }
        $sql2 = "SELECT * FROM products WHERE name='$ItemName'";
        $run_query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        if (mysqli_num_rows($run_query2) > 0){
            while ($fetch = mysqli_fetch_array($run_query2)){
                $image = $fetch['image'];
            }
        }
    }
  
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
                    window.open("http://localhost/MERCAPIZZA/public/webpage2.php?id=" + id);
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
<main>
    <br>
    <br>
<section id="main">

    <div class="container-sm form-group border p-3  justify-content-center border-dark rounded mb-5" id="empdetailscontainer" style="background-color: #EDE1CF;">
        <div class="row my-2">
            <div class="col-lg-4">
                <h3 style= "font-weight: bold;"><i class="bi bi-receipt"></i> Sales #<?php echo($SalesNumber) ?></h3>
            </div>
        </div>
        <div class="row my-2 gy-5 gx-10 justify-content-center">
            <div class="col-lg-12 d-flex justify-content-center" style="height: 200px;">
                <img src="images/<?php echo $image?>" class="rounded img-fluid border border-dark" alt="...">
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="input-group mb-1">
                        <span class="input-group-text w-25">Product Name:</span>
                        <textarea class="form-control" aria-label="With textarea" disabled><?php echo($ItemName) ?></textarea>   
                    </div>
                    <div class="input-group mb-1">
                        <span class="input-group-text w-50">Price:</span>
                        <input type="text" class="form-control" value="₱ <?php echo($Price) ?>.00" disabled>
                    </div>
                    <div class="input-group mb-1">
                        <span class="input-group-text w-50">Quantity:</span>
                        <input type="text" class="form-control" value="<?php echo($Quantity) ?>" disabled>
                    </div>
                    <div class="input-group mb-1">
                        <span class="input-group-text w-50">Discount Amount:</span>
                        <input type="text" class="form-control" value="₱ <?php echo($DiscountAmount) ?>.00" disabled>
                    </div>
                    <div class="input-group mb-1">
                        <span class="input-group-text w-50">Discounted Amount:</span>
                        <input type="text" class="form-control" value="₱ <?php echo($DiscountedAmount) ?>.00" disabled>
                    </div>
                    <div class="input-group mb-1">
                        <span class="input-group-text w-50">Cash From Customer:</span>
                        <input type="text" class="form-control" value="₱ <?php echo($CashFromCustomer) ?>.00" disabled>
                    </div>
                    <div class="input-group mb-1">
                        <span class="input-group-text w-50">Change To The Customer:</span>
                        <input type="text" class="form-control" value="₱ <?php echo($ChangeToTheCustomer) ?>.00" disabled>
                    </div>
                    <form action="" method="POST">
                        <div class="row my-2 gx-5 gy-2 d-flex justify-content-center">
                            <button name="exit-btn" type="submit" class="btn col-lg-2 btn-danger"> Exit </button>
                        </div>
                    </form>
                </div>
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
if(isset($_POST['exit-btn']))
    echo "<script>window.close();</script>";
?>