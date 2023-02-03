<?php
  include '../connect.php';
  use App\Models\User;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../css/dangky.css">
  <title>Document</title>
</head>
<body>

<div  id="MyModal1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="bg-primary" style="padding:35px 40px;">
            <h4 class="bg-primary text-center text-light"> ĐĂNG KÝ</h4>
          </div>
          <div class="modal-body" style="padding:40px 50px;">
          <?php
        include '../connect.php';

        function validating($phone){
          if(preg_match('/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/', $phone)) {
            return true;
            } else {
            return false;
          }
        }
     
        function emailValid($string){ 
          if (preg_match ('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/', $string)) {
            return true;
            } else {
            return false;
          }
        }
        if(isset($_POST['sign-submit1'])){
          $username=$_POST['uname'];
          $password1=$_POST['pswd1'];
          $password2=$_POST['pswd2'];
          $check=false;       
          if(validating($username) || emailValid($username)){ 
            
            if(strlen($password1) > 6){
              if($password1 == $password2) {
                $user = User::where('tenDangNhap', $username)->get('tenDangNhap');
                if($user=="[]") {
                    $password1=md5($password1);
                    $newUser = new User(['tenDangNhap' => $username, 'matKhau' => $password1]);
                    $newUser->save();
                    echo '<p style="text-align:center; color: green;">Đăng ký thành công!</p>';
                    
                } else {
                    echo '<p style="text-align:center; color: red;">Tài khoản đã tồn tại.</p>';
                  }
              } else {
                  echo '<h3 style="text-align:center; color:red">Mật khẩu không trùng khớp</h3>';
              }
            } else {
              echo '<h3 style="text-align:center; color:red">Mật khẩu phải nhiều hơn 6 ký tự!!!</h3>';
            }   
          } else {
            echo '<p style="text-align:center; color:red">Tên đăng nhập phải là Email hoặc Số điện thoại!!!</p>';
          } 
        }
      ?>
            <form method="POST" class="needs-validation" novalidate>
              <div class="form-group">
                <label for="uname"><span class="glyphicon glyphicon-user"></span> Tài khoản</label>
                <input type="text" class="form-control" id="uname" placeholder="Email hoặc số điện thoại" name="uname" required>
                <div class="invalid-feedback">Vui lòng nhập tài khoản.</div>
              </div>
              <div class="form-group">
                <label for="pwd"><span class="glyphicon glyphicon-eye-open"></span> Mật khẩu</label>
                <input type="password" class="form-control" id="pwd" placeholder="Mật khẩu" name="pswd1" required>
                <div class="invalid-feedback">Vui lòng nhập mật khẩu.</div>
              </div>
              <div class="form-group">
                <label for="pswd"><span class="glyphicon glyphicon-eye-open"></span> Mật khẩu</label>
                <input type="password" class="form-control" id="pswd" placeholder="Nhập lại mật khẩu" name="pswd2" required>
                <div class="invalid-feedback">Vui lòng nhập lại mật khẩu.</div>
              </div> 
              <div class="modal-footer justify-content-around">
            <a href="index.php" class="btn btn-danger "> Trở về</a>     
            <a href="dangnhap.php" class="btn btn-primary"  name="sign-submit1" id="btn-submit1">Đăng nhập</a>
          </div>             
            </form>
          </div>
      </div>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

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