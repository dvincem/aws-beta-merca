
<!-- this php code includes the conditions in order to have an organize cart and successfully get 
the datas with popup conditions as well as remove/delete the product in cart it -->
<?php

include 'config.php';

session_start();

$user_id = 1;
if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $product_discount = $_POST['product_discount'];
   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity, discount) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity', '$product_discount')") or die('query failed');
      $message[] = 'product successfully added to cart!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:index.php');
}

?>
<!-- end of php code -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merca's Pizza Guest</title>
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
    
</head>
<body>

    <?php
    if(isset($message)){
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
    }
    }
    ?>
    
    <div id="cantainer-background">
        <nav class="navbar navbar-expand-md" id="navbar-color">
            <!-- Brand -->
            <a class="navbar-brand" href="https://www.facebook.com/mercaspizza" id="logo-color"><i><img src="./icon/logo.png" alt=""></i>MERCA'S PIZZA</a>
          
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span><i><img src="./icon/menu.png" alt="" id="menu-color"></i></span>
            </button>
          
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="" id="first">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#cards">Promo</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#deliver">Deliver</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#head">Check out</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#contact">Contact Us</a>
                </li>
              </ul>
            </div>
          </nav>

    <!-- big banner at front -->
    <div class="main-content">
            <div class="content">
                  <h1>BEST PIZZA</h1>
                  <h2>IN TOWN</h2>
                  <div id="btn1"><a href="login_page.php"><button>LOG-IN</button></div></a>
            </div>
    </div>
    <!-- big banner at front -->

<br>


<!-- PHP conditions in order to get the data's in the data base for products -->
<div class="container">
<div class="products">
   <h1 class="heading" id="ordernow">PIZZA BUNDLES AND SOLO'S</h1>
   <div class="box-container">

   <?php
      $select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
      if(mysqli_num_rows($select_product) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_product)){
   ?>
      <form method="post" class="box" action="">
         <img src="images/<?php echo $fetch_product['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_product['name']; ?></div>
         <div class="price">₱<?php echo $fetch_product['price']; ?></div>
         <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
         <input type="hidden" name="product_discount" value="<?php echo $fetch_product['discount']; ?>">
      </form>
   <?php
      };
   };
   ?>

   </div>

</div>
</div>
</div>
<!-- end -->


<!-- banner#2 -->
<div class="banner2" id = "deliver">
    <br>
    <h1>Pizza Experience</h1>
    <h3>@Merca's Pizza</h3>
</div>
<!-- banner#2 -->

<!--  contact form -->
<h1 class="text-center" id="contact" style="font-weight:bold ; margin-top: 50px;">Contact Us</h1>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" id="usr" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="eml" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="phn" placeholder="Phone">
            </div>
            <div id="btn1"><button>Send Message</button></div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <textarea class="form-control" id="comment"  rows="5" placeholder="Put your message here"></textarea>
            </div>
        </div>
    </div>
</div>
<!--  contact form -->

<!-- ads card -->
<div class="container">
        <div class="best-card" id="cards">
            <div class="row" style="margin-top: 100px ;">
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card">
                        <img class="card-image-top" src="./images/card1.png" alt="" height="200px">
                        <div class="card-img-overlay">
                            <h1 class="card-title">Fresh Pizza</h1>
                            <p class="card-text">Fresh and cooked to perfection.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card">
                        <img class="card-image-top" src="./images/card2.jpg" alt="" height="200px">
                        <div class="card-img-overlay">
                            <h1 class="card-title">Fast Delivery</h1>
                            <p class="card-text">Quick and secured delivery.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card">
                        <img class="card-image-top" src="./images/card0.png" alt="" height="200px">
                        <div class="card-img-overlay">
                            <h1 class="card-title">Free Delivery</h1>
                            <p class="card-text">No delivery charge for orders 2 & above.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ads card -->

<!-- footer section -->
<footer id="footer">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-lg-6 text-lg-left text-center">
                <div class="copyright">
                    &copy; Copyright <strong> Merca's Pizza</strong>. All Rights Reserved
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
                    <a href="http://localhost/MERCAPIZZA/" class="scrollto">Home</a>
                    <a href="#promo" class="scrollto">Promo</a>
                    <a href="#deliver" class="scrollto">Deliver</a>
                    <a href="#head" class="scrollto">Check out</a>
                    <a href="#contact" class="scrollto">Contact Us</a>
                </nav>
            </div>
        </div>
    </div>
</footer>
<!-- footer section -->

</body>
</html>