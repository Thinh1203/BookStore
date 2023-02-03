<?php
    include '../../connect.php';
    use App\Models\Product;
    session_start();
    $sql = Product::all();
?>
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
    <title>Quản trị viên</title>
</head>
<body>
    <div class="container-fluid">
        <div class="card mt-2">
            <div class="card-header">
                <h2 class="text-center">
                    Danh sách sản phẩm
                </h2>
               <div class="d-flex justify-content-between">
                <span><a class="btn btn-primary" href="admin.php?page_layout=themsanpham">Thêm mới</a></span>
                <?php     
                        if(isset($_SESSION['admin'])) {
                            $name = $_SESSION['admin']; ?>
                    <span>
                        <?php
                            echo '<span> Xin chào ' . '<span style="color:red;">' . $name . '</span>' .  '</span>';
                            echo '<span> <a href="log_in.php?logout">Đăng xuất</a></span>';
                        }else{
                            echo '<span> <a href="log_in.php">Đăng nhập</a> </span>';
                        } ?>
                    </span>
                </div>
            </div>

            <div class="thead bg-dark text-white">
                <div class="row p-3">
                    <div class="col text-center">#</div>
                    <div class="col text-center">Tên sách</div>
                    <div class="col text-center">Thể loại</div>
                    <div class="col text-center">Tác giả</div>
                    <div class="col text-center">Giá</div>
                    <div class="col text-center">Hình ảnh</div>
                    <div class="col text-center">Mô tả</div>   
                    <div class="col text-center">Sửa</div>
                    <div class="col text-center">Xóa</div>
                </div>
            </div> 
            <div class="tbody ">
                <?php
                    $i = 1;
                    $row = Product::all();
                    foreach($row as $element){?> 
                    <hr>
                    <div class="row pt-2 pb-3 ">
                    <div class="col text-center"><?php echo $i++; ?></div>
                    <div class="col"><?php echo $element->tenSach;?></div>
                    <div class="col text-center"><?php echo $element->theLoai; ?></div>
                    <div class="col text-center"><?php echo $element->tacGia; ?></div>
                    <div class="col text-center"><?php echo $element->gia; ?></div>
                    <div class="col text-center">
                        <img style="width: 80px; height: 100px;;" src="../../../image/SachKhoaHoc/<?php echo $element->image;?>">  
                    </div>
                    <div class="col "><?php echo $element->moTa; ?></div>
                   
                    <div class="col text-center"><a href="admin.php?page_layout=suasanpham&id=<?php echo $element->id_product;?>">Sửa</a></div>
                    <div class="col text-center"><a onclick="return Del('<?php echo  $element->tenSach;?>') " href="admin.php?page_layout=xoasanpham&id=<?php echo $element->id_product;?>">Xóa</a></div>
                    
                </div>
                <?php } ?>
                
            </div> 
        </div>
    </div>
    <script>
        function Del(name){
            return confirm("Bạn có chắc chắn muốn xóa sản phẩm: " + name + "?");
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</html>
