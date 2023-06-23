<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="Form Log In/style.css">
    <!-- Fontawesome CDN Link -->
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body style="background-color:#87CEEB;" >
  <div class="container" style="zoom:80%;">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front"> 
        <img src="Form Log In/images/frontImg.jpg" alt="">
        <div class="text">
          <span class="text-1"></span>
          <span class="text-2"></span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="Form Log In/images/backImg.jpg" alt="">
        <div class="text">
          <span class="text-1"></span>
          <span class="text-2"> </span>
        </div>
      </div>
    </div> 
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
       
          <form method="post" action="login_prosess/cek_login.php">
      
            <div class="input-boxes">
            <?php 
            if(isset($_GET['pesan'])){
              if($_GET['pesan']=="gagal"){
                echo "<div style=' color: red;' >Username dan Password tidak sesuai !!!</div>";
                }
                            } 
                            ?>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="username" placeholder="Enter your Nik" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Enter your password" required>
              </div>
            
              <div class="button input-box">
                <input type="submit" value="Sumbit">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Sigup now</label></div>
              
            </div>
            
        </form>
      </div>
        <div class="signup-form">
          <div class="title">Signup</div>
        <form action="#">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Enter your name" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Enter your password" required>
              </div>
              <div class="button input-box">
                <input type="submit" value="Sumbit">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>
</body>
</html>
