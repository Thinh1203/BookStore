<?php
    include '../../connect.php';
    use App\Models\Product;
    use Illuminate\Database\Capsule\Manager as Manager;
    
    $id = $_GET['id'];

    $sql_product = Product::where('id_product', $id)->get();
    
    if(isset($_POST['sbm'])){

        $prd_name = $_POST['prd_name'];
        foreach($sql_product as $element){
        if($image = $_FILES['image']['name']=='[]'){
            $image = $element->image;
        }else{
            $image = $element->image;
        }
    }
        $brand = $_POST['brand'];
        $actor = $_POST['actor'];
        $price = $_POST['price'];
        $description = $_POST['description'];  
        
        Manager::table('product')->where('id_product', $id)->update(['tenSach' => $prd_name, 'theLoai' => $brand, 'tacGia' => $actor, 'gia' => $price, 'image' =>  $image, 'moTa' => $description]);
        header('Location: admin.php?page_layout=danhsach'); 
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị viên</title>
</head>
<body>
    <div class="container-fluid">
        <div class="card">
            <!--Card header-->
            <div class="card-header">
                <h2 class="text-center">Sửa thông tin</h2> 
            </div>

            <!--Card header-->
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                <?php foreach($sql_product as $element){?>
                <div class="form-group">
                        <label for="prd_name">Tên sản phẩm</label>
                        <input type="text" id="prd_name" name="prd_name" class="form-control" require value="<?php echo $element->tenSach; ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Thể loại</label>
                        <select name="brand" id="brand" class="form-control">
                            <option value="Sách thiếu nhi">Sách thiếu nhi</option>
                            <option value="Sách văn học">Sách văn học</option>
                            <option value="Sách kinh tế">Sách kinh tế</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Tác giả</label>
                        <input type="text" id="price" name="actor" class="form-control" require value="<?php echo $element->tacGia; ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Giá</label>
                        <input type="number" id="price" name="price" class="form-control" require value="<?php echo $element->gia; ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" id="image" name="image" class="form-control" require>
                    </div>

                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <input type="text" id="description" name="description" class="form-control" require value="<?php echo $element->moTa; ?>">
                    </div>
                <?php } ?>
                    <button class="btn btn-primary" type="submit" name="sbm">Sửa</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>