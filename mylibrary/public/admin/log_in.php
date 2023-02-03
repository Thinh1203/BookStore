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
  <link href="../../../css/dangnhap.css" rel="stylesheet">
  <title>Quản trị viên</title>
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
        include '../../connect.php';
        use App\Models\User;
         if(isset($_POST['sign-submit'])){
          $username = $_POST['admin'];
          $pass = $_POST['passwd'];

          $pass = md5($pass);
          $checkAdmin = User::where('tenDangNhap', $username)->where('matKhau', $pass)->get();

          if($checkAdmin != "[]"){
            $checkTypeUser = $checkAdmin->where('type_user', 'admin'); 
            if($checkTypeUser != "[]") {
                $_SESSION['admin'] = $username;
                header("location: danhsach.php");
              // echo $username;
            } else {
                echo '<p style="text-align:center; color:red;">Tài khoản không có quyền truy cập vào!</p>';
            }
          } else {
            echo '<p style="text-align: center; color: red;">Tên tài khoản hoặc mật khẩu không hợp lệ!</p>';
           }
         }
      ?>
    </div>

    <div class="form-group ml-3 mr-3">
      <label for="admin">Username</label>
      <input type="text" class="form-control" id="admin" name="admin" required>
      
      <div class="invalid-feedback">Vui lòng nhập tài khoản.</div>
    </div>

    <div class="pwd_form form-group ml-3 mr-3">
      <label for="passwd">Password</label>
      <input type="password" class="form-control" id="passwd" name="passwd" required>
      
      <div class="invalid-feedback">Vui lòng nhập mật khẩu.</div>
    </div>

    <div class="form-footer pt-2 pb-4">
    
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