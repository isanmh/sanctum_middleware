<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    // jika data yang diinputkan tidak sesuai dengan field yang ada di database
    // protected $fillable = [
    //     'name',
    //     'price',
    //     'image',
    // ];

    // field yang tidak boleh diisi
    protected $guarded = ['id'];
}
