<?php
  session_start();
  if(isset($_GET['logout'])){
    unset($_SESSION['username']);
  }
?>
<?php
  include '../connect.php';
  use App\Models\Product;
   
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet">
    <link href="../../css/header.css" type="text/css" rel="stylesheet">
    <link href="../../css/body.css" type="text/css" rel="stylesheet">
    <link href="../../css/footer.css" type="text/css" rel="stylesheet">
    <link rel="icon" href="../../image/Logo.jpg" type="image/icon type">
    <title>BookShop</title>
</head>
<body>
  <!--Start header -->
  <header>
    <div class="nav-header">
      <nav class="navbar navbar-expand-md navbar-dark text-center nav_menu">
        <div class="container-fluid">
          <a class="navbar-brand ml-sm-3 mt-n2" href="#"><span class="logo" id="logo-before">Book</span><span class="logo" id="logo-after">Shop</span></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav" style="position: relative;">
              <li class="nav-item">
               <a class="nav-link text-white decoration-animation" href="#">TRANG CHỦ</a>
              </li>
              <li class="nav-item toggle">
                  <a class="nav-link text-white decoration-animation" id="list-menu-ok" href="#">THỂ LOẠI</a>
                  <div class="list-type-menu">
                  <ul class="list-type">
                    <li><a href="thieunhi.php">Sách thiếu nhi</a></li>
                    <li><a href="vanhoc.php">Sách văn học</a></li>
                    <li><a href="kinhte.php">Sách kinh tế</a></li>
                  </ul>
                </div>               
              </li>
              <li class="nav-item">
                <a class="nav-link text-white decoration-animation" href="#">GIỚI THIỆU</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white decoration-animation" href="#">LIÊN HỆ</a>
              </li> 
            </ul> 
            <div class="nav-item-icon d-flex justify-content-end text-right">  
              <div class="nav-item-search mr-1 flex-fill">
                <form class="form-inline mr-n3" action="timkiem.php" method="POST">
                  <input class=" form-control mr-n1 border-0" type="text" placeholder="Search" name="tukhoa">
                  <button class="btn-primary p-2 border-0" type="submit" name="timkiem">Tìm kiếm</button>
                </form>
              </div>
              <div class="nav-item-shopping mt-2">
                <span>
                <a href="addcart.php" alt="shopping-cart"><span id="cart-shopping" ><i class="fa-solid fa-cart-shopping"></i>&nbsp;<sup><span id="cart" class="text-warning"></span></sup></span><span>Giỏ hàng</span></a>
                </span> 
                <?php
                 // include '../connect.php';
                  
                  if(isset($_SESSION['username'])) {
                    $name = $_SESSION['username'];
                   
                    echo '<span style="color: white;">' . $name . '</span>';
                    
                    echo '<a href="?logout">Thoát</a>';
                  }else{
                    echo '<a href="dangnhap.php" id="myBtn">Đăng nhập</a> <span style="color: aliceblue;">&sol;</span>                  
                    <a href="dangky.php">Đăng ký</a>  ';
                  }
                ?>

              </div>        
            </div>      
        </div> 
      </nav>   
    </div>
  </header>
  <!--End header-->
  <!-- Start main-->
  <main>
    <div class="container-fluid mt-3">
    <h2 class="text-center p-2 text-dark">Chi tiết sản phẩm</h2>  
      <div class="row">
          <div class="col col-sm-4" >
            <?php
            $stt = $_GET['id'];
            $query = Product::where('id_product', $stt)->get(); ?>       
            <div class="col overflow-hidden mb-2">
                <div>
                    <img class="d-block w-100 img-fluid img"  alt="..." src="../../image/SachKhoaHoc/<?php echo $query[0]->image;?>">
                   
                </div>
            </div>
          </div>

          <div class="col col-sm-6">
                <div class="bg-light">
                <form action="addcart.php?id=<?php echo $query[0]->id_product;?>" method="POST">
                    <div>
                        <span class=" ml-3 p-2"><b class="text-danger">Thể loại: </b> <?php echo '<span style="color: black;"><b>' . $query[0]->theLoai . '</b></span>';?></span>
                    </div>  
                    <input class="invisible" type="text" value="<?php echo $query[0]->image;?>" name="hinhanh">
                    <div>
                        <span class="ml-3 p-2"><b class="text-danger">Giá sách: </b> <?php echo '<span style="color: black;"><b>' . number_format($query[0]->gia,'0','',',') . 'đ'. '</b></span>';?></span>
                        <input class="invisible" type="text" value="<?php echo number_format($query[0]->gia,'0','',','); ?>" name="gia">
                    </div>

                    <div class="p-2 ml-3">
                        <div class="number pt-2 pb-2">Số lượng: <input name="number" type="number"  min="1" max="10" value="1"></div>
                      
                        <input type="submit" class="themgiohang ml-5" value="Thêm vào giỏ" name="addcart">
                       
                    </div>

                    <div class="mt-3">
                        <h4 class="ml-2 text-danger">Giới thiệu</h4>
                        
                        <div class=" ml-3 mr-3 pb-2"><p><?php echo $query[0]->moTa ?></p></div>    
                    </div>
                   </form>
                </div>
            </div>
          </div>
      </div>
    </div>
  </main>
  <!--End main-->
  <!--Footer-->
  <footer>
    <div class="secssion_foot mt-4">
    <div class="row">/br</div>
      
        <div class="row row-cols-1 row-cols-md-4 align-center ml-5 pb-2">
          <div class="col col-md-3">
            <h5 class="title">GIỚI THIỆU</h5>
            <div class="is-divider divider clearfix" style="max-width:35px;background-color:rgb(195, 0, 5);"></div>
            <p class="footer_content">Chào mừng bạn đến với ngôi nhà <span class="logo" id="logo-before" style="font-size: 16px;">Book</span><span style="font-size: 16px;" class="logo" id="logo-after">Shop</span> Tại đây, mỗi một dòng chữ, mỗi chi tiết và hình ảnh đều là những bằng chứng mang dấu ấn lịch sử <span class="logo" id="logo-before" style="font-size: 16px;">Book</span><span style="font-size: 16px;" class="logo" id="logo-after">Shop</span> 100 năm, và đang không ngừng phát triển lớn mạnh.</p>
          </div>
          <div class="col col-md-3">
          <h5 class="title">ĐỊA CHỈ</h5>
          <div class="is-divider divider clearfix" style="max-width:35px;background-color:rgb(195, 0, 5);"></div>
          <div class="row">
            <div class="col col-1 text-light"><i class="fa-solid fa-location-dot"></i></div>
            <div class="col col-11"><p class="footer_content">3/2, Phường Xuân Khánh, Quận Ninh Kiều, Tp.Cần Thơ</p></div>
          </div>
          <div class="row">
            <div class="col col-1 text-light"><i class="fa-solid fa-phone"></i></div>
            <div class="col col-11"><p class="footer_content">03451391xx</p></div>
          </div>
          <div class="row">
            <div class="col col-1 text-light"><i class="fa-solid fa-envelope-circle-check"></i></div>
            <div class="col col-11"><p class="footer_content">thinhb1910454@student.ctu.edu.vn</p></div>
          </div>
          <div class="row">
            <div class="col col-1 text-light"><i class="fa-brands fa-skype"></i></div>
            <div class="col col-11"><p class="footer_content">thinhquach</p></div>
          </div>
          </div>
          <div class="col col-md-3">
            <h5 class="title">MENU</h5>
            <div class="is-divider divider clearfix" style="max-width:35px;background-color:rgb(195, 0, 5);"></div>
            <div class="footer_menu "> 
              <div class="row">  
              <div class="col-6">
                <div class="footer_content"><a class="footer_content text-decoration-none" href="#">Trang chủ</a></div>
                <div class="footer_content"><a class="footer_content text-decoration-none" href="#">Giới thiệu</a></div>
                <div class="footer_content"><a class="footer_content text-decoration-none" href="#">Tin tức</a></div>
                <div class="footer_content"><a class="footer_content text-decoration-none" href="#">Liên hệ</a></div>
              </div>
              <div class="col-6">
                <div class="footer_content"><a class="footer_content text-decoration-none" href="#">Nữ</a></div>
                <div class="footer_content"><a class="footer_content text-decoration-none" href="#">Nam</a></div>
                <div class="footer_content"><a class="footer_content text-decoration-none" href="#">Trẻ em</a></div>
              </div>
            </div>
            </div> 
          </div>
    

          <div class="col col-md-3">
            <h5 class="title">MẠNG XÃ HỘI</h5>
            <div class="is-divider divider clearfix" style="max-width:35px;background-color:rgb(195, 0, 5);"></div>
            <div class="mxh_icon" style="font-size: 190%;">
              <a data-toggle="tooltip" title="Follow on Facebook" href="#" id="facebook"><i class="fa-brands fa-facebook-f"></i></a>
              <a data-toggle="tooltip" title="Follow on Instagram" href="#" id="instagram"><i class="fa-brands fa-instagram"></i></a>
              <a data-toggle="tooltip" title="Follow on Twitter" href="#" id="twitter"><i class="fa-brands fa-twitter"></i></a>
              <a data-toggle="tooltip" title="Follow on Pinterest" href="#" id="pinterest"><i class="fa-brands fa-pinterest-p"></i></a>
              <a data-toggle="tooltip" title="Subscribe to RSS" href="#" id="rss"><i class="fa-solid fa-rss"></i></a>
            </div>
          </div>   
      </div>
    </div>
    <div class=" bg_footer">
      <div class="container">
        <p class="text-center footer_content pt-2 pb-2">&copy; Bản quyền thuộc về <span class="logo" id="logo-before" style="font-size: 16px;">Book</span><span style="font-size: 16px;" class="logo" id="logo-after">Shop</span></p>
      </div>
    </div>
  </footer>
  <!--End footer-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../../js/cart.js"></script>
  <script>
    
    $(function(){
   $(".nav-item.toggle").click(function(){
      $("ul.list-type").slideToggle();
    });
  });
  </script>
  <script>
  $(() => {
    $('[data-toggle="tooltip"]').tooltip();   
  });
  </script>
</body>
</html>