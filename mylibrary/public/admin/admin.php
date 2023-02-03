 <?php
    if(isset($_GET['logout'])){
        unset($_SESSION['admin']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet">
  <title>Quản trị viên</title>
</head>
<body>
  <?php
    if(isset($_GET['page_layout'])) {
  
      switch ($_GET['page_layout']) {
        case 'danhSach':
          require_once 'danhsach.php';
          break;

        case 'suasanpham':
          require_once 'suasanpham.php';
          break;

          case 'themsanpham':
            require_once 'themsanpham.php';
            break;
  
          case 'xoasanpham':
            require_once 'xoasanpham.php';
            break;
          
          default:
            require_once 'danhsach.php';
            break;
      }
    } else {
      require_once 'log_in.php';
    }
  ?>
</body>
</html>