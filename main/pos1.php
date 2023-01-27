
<!-- this php code includes the conditions in order to have an organize cart and successfully get 
the datas with popup conditions as well as remove/delete the product in cart it -->
<?php

include 'config.php';

session_start();
if($_SESSION['usertype']=="cashier1" || $_SESSION['usertype']=="superadmin"){
$user_id = 1;
unset($_SESSION['discountedamount']);
unset($_SESSION['totaldiscount']);
unset($_SESSION['totalquantity']);
unset($_SESSION['totalprice']);
unset($_SESSION['totalname']);
if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $product_discount = $_POST['product_discount'];
   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   // edit.. if same product added to cart.. it will just add quantity -dado
   if(mysqli_num_rows($select_cart) > 0){
      mysqli_query($conn, "UPDATE `cart` SET quantity = (quantity+$product_quantity) WHERE name = '$product_name'") or die('query failed');
      $message[] = 'product successfully added to cart!';
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

// remove function fixed -dado
if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   $message[] = 'Product has been removed succesfully!';
   //header("location: pos1.php");  -- header not needed anymore --
}
  
// delete all function fixed -dado
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   $message[] = 'All items has been removed succesfully!';
   //header('location:index.php');  -- header not needed anymore --
}

// removed not needed line of codes -dado
if(isset($_POST['checkout'])){
   $cart_query1 = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query1) > 0){
       while($fetch_cart1 = mysqli_fetch_assoc($cart_query1)){
         $totalquantity =$fetch_cart1['quantity'];
         $totaldiscount =($fetch_cart1['price'] * $fetch_cart1['discount']);
         $totalprice =($fetch_cart1['quantity']*$fetch_cart1['price']);
         $discountedamount = $totalprice - $totaldiscount;
         $totalname = $totalname." ".$fetch_cart1['name'].", ";
       }
       $_SESSION['discountedamount'] = $discountedamount;
       $_SESSION['totaldiscount'] = $totaldiscount;
       $_SESSION['totalquantity'] = $totalquantity;
       $_SESSION['totalprice'] =$totalprice ;
       $_SESSION['totalname'] = $totalname;
      }
   echo '<script>window.location.href="payment/index.php"</script>';
}

?>                                       
<!-- end of php code -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS A</title>
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
               <input type="number" min="1" name="product_quantity" value="1">
               <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
               <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
               <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
               <input type="hidden" name="product_discount" value="<?php echo $fetch_product['discount']; ?>">
               <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
         <?php
            };
         };
         ?>

         </div>

      </div>
      <!-- php conditions -->


      <!-- Shopping cart algorithm to get the datas needed and the table-->
      <div class="shopping-cart">
         <br>
         <h1 class="heading" id="head">ORDER INFO</h1>

         <table>
            <thead>
               <th>Image</th>
               <th>Name</th>
               <th>Price</th>
               <th>Discount</th>
               <th>New Price</th>
               <th>Quantity</th>
               <th>Total Bills</th>
               <th>Action</th>
            </thead>
            <tbody>
            <?php
               $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $grand_total = 0;
               if(mysqli_num_rows($cart_query) > 0){
                  while($fetch_cart = mysqli_fetch_assoc($cart_query)){
            ?>

      <tr>
                  <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                  <td><?php echo $fetch_cart['name']; ?></td>
                  <td>₱<?php echo $fetch_cart['price']; ?></td>
                  <td>₱<?php echo $discount = ($fetch_cart['price'] * $fetch_cart['discount']); ?></td>
                  <td>₱<?php echo $newprice = ($fetch_cart['price'] - $discount); ?></td>
                  <td>
                     <form action="" method="post">
                        <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                        <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                        <input type="submit" name="update_cart" value="update" class="option-btn">
                     </form>
                  </td>
                  <td>₱<?php echo $sub_total = ($newprice * $fetch_cart['quantity']); ?></td>

                  <!-- changed href from index.php to pos1.php (remove button fixed) -dado -->
                  <td><a href="pos1.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('remove item from cart?');">remove</a></td>
               </tr>
            <?php
               $grand_total += $sub_total;
               $_SESSION['grandtotal'] = $grand_total;
                  }
               }else{
                  echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="8">no item added</td></tr>';
               }
            ?>
            <tr class="table-bottom">
               <td colspan="6">Grand Total :</td> 
               <td>₱<?php echo $grand_total; ?></td>
               <td><a href="pos1.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">delete all</a></td>
            </tr>
         </tbody>
         </table>
         <form action="" method="post">
         <div class="cart-btn">  
            <button name="checkout" type="submit" id="checkout" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">proceed to payment wall</button>
            </form>
         </div>
      </div>
      </div>
      <!-- shopping cart-->

</body>
</html>
<?php }
else{
    echo '<script>alert("Unauthorized Web Access")</script>';
    echo '<script>window.location.href="../dashboard.php"</script>';
} ?>