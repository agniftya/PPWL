<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ["nama"];

    // TAMBAHKAN INI: Agar Category bisa memanggil $category->products
    public function products()
    {
        // Kita spesifikasikan 'kategori_id' sebagai foreign key-nya
        return $this->hasMany(Product::class, 'kategori_id');
    }
}