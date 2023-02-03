<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet">
  <link href="css/dangnhap.css" rel="stylesheet">
  <title>Document</title>
</head>
<body>

  <div class="container">
    <div class="form_signin">
    <form method="POST" class="needs-validation" novalidate>
     
    <div class="form-header">
      <h3 class="form_group mt-2 ml-3 pt-3 text-center ">Đăng nhập</h3>
    </div>

    <div class="php-code">
      <?php
        include '../connect.php';
        if(isset($_POST['sign-submit'])){
          $username = $_POST['username'];
          $pass = $_POST['pswd'];

          $pass = md5($pass);
          
          $sql="SELECT * FROM `users` WHERE tenDangNhap='$username' and matKhau='$pass'";
          $query = mysqli_query($connect,$sql);
          $num_row = mysqli_num_rows($query);
          
          if($num_row!=0){
            $row = mysqli_fetch_assoc($query);
            
            $_SESSION['username'] = $row['tenDangNhap'];
            echo '<p style="text-align: center; color: green;">Đăng nhập thành công</p>';
            header("Location: /index.php");
          }else{
            echo '<p style="text-align: center; color: red;">Tên tài khoản hoặc mật khẩu không hợp lệ!</p>';
          }
        }
      ?>
    </div>

    <div class="form-group ml-3 mr-3">
      <label for="username">Tài khoản:</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Email hoặc số điện thoại" name="username" required>
      
      <div class="invalid-feedback">Vui lòng nhập tài khoản.</div>
    </div>

    <div class="pwd_form form-group ml-3 mr-3">
      <label for="pswd">Mật khẩu:</label>
      <input type="password" class="form-control" id="pswd" placeholder="Nhập mật khẩu" name="pswd" required>
      
      <div class="invalid-feedback">Vui lòng nhập mật khẩu.</div>
    </div>

    <div class="form-footer pt-2 pb-4">
      <a href="index.php" class="form_back btn btn-outline-dark">TRỞ LẠI</a>
      <button type="submit" class="btn btn-primary" name="sign-submit">ĐĂNG NHẬP</button>
    
    </div>
    
    </form>
    </div>
  </div>

<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
    

    
</body>
</html>