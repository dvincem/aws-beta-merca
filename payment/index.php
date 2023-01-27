<!-- php condition in order to redirect the site after successfully submitting -->
<?php

    if(isset($_POST['submit']))
    {
      echo '<script>window.location.href="http://localhost/MERCAPIZZA/payment/confirmation/index.php"</script>';
    }

?>
<!-- submit -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Payment Section</title>
        <link rel="stylesheet" href="styles.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- sweetalertjs -->
    </head>
    

    <body>
    
    <!-- Payment form requirements where the user will put the details for payment purposes -->
        <form method="POST">
            <div class="full-screen">
                <div class="container">
                    <div class="payment-box">
                    <center><img src="bgz.jpg" width=38%><center>
                        <br>
                        <section class="row options first">
                            <div class="item">
                                <label class="label">
                                    <input class="radio" type="radio" name="channel" checked>
                                    <span class="radioInput"></span><span>Gcash</span>
                                </label>
                            </div>
                            <div class="item">
                                <img class="img" src="images/cashg.png" alt="" />
                            </div>
                        </section>
                        <section class="row options no-border-bottom">
                            <div class="item">
                                <label class="label">
                                    <input class="radio" type="radio" name="channel">
                                    <span class="radioInput"></span><span>PayMaya</span>
                                </label>
                            </div>
                            <div class="item">
                                <img class="img" src="images/paymaya.png" alt="" />
                            </div>
                        </section>
                        <section class="row blanks">
                            <div class="col-12">
                                <div class="item">
                                    <span class="title">Phone #:</span>
                                    <input type="text" class="blank card-number" name="num" placeholder="ex. 09550097879"  onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength=11 required/>
                                </div>
                            </div>
                        </section>
                        <section class="row blanks last">
                            <div class="col-12">
                                <div class="item">
                                    <span class="title">Account Name:</span>
                                    <input type="text" class="blank" name="name" placeholder="ex. Ry Cruz" required/>
                                </div>
                            </div>  
                            <div class="col-12">
                                <div class="item">
                                    <span class="title">4 PIN:</span>
                                    <input text="password" class="blank" name="pin" placeholder="****" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" maxlength=4 required />
                                </div>
                            </div>
                            <button id="btn1" onclick="popup()"><img class="info-icon" src="images/info.png" alt="" /></button>
                            <script type="text/javascript">
                                function popup()
                                {
                                    swal({
                                        title: "ENTER YOUR 4 PIN CODE",
                                        text: "becareful in putting these ones",
                                        icon: "warning",
                                        });
                                }
                            </script>

                        </section>
                    </div>
                    <button class="payment-btn" type="submit" name="submit"><img src="images/lock.png" alt=""/><b>PAY NOW!</b></button>          
        </form>
</div>
<!-- Payment form requirements -->

            </div>
        </div>
    </body>
</html>