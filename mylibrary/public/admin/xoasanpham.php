<?php
    include '../../connect.php';
    use App\Models\Product;

    $id = $_GET['id'];
    $sql = Product::where('id_product' , $id)->delete();
    header('location: admin.php?page_layout=danhsach');
?>