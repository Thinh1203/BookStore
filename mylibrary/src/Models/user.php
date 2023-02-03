<?php

namespace App\Models;

class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'users';
    protected $fillable = ['tenDangNhap','matKhau','ngayDangKy','type_user'];
    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'user_product')->withPivot('image_product', 'soLuong', 'thanhTien');
    }

}

?>