<?php

namespace App\Models;

class Product extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'product';
    protected $fillable = ['tenSach','theLoai','tacGia', 'gia', 'image','moTa'];
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_product')->withPivot('image_product', 'soLuong', 'thanhTien');
    }
}
    
?>