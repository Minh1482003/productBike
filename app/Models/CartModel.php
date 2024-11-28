<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model{

    protected $table = 'cart';

    protected $fillable = ['Id_KH', 'Id_SP', 'Quantity'];

    protected $primaryKey = ['Id_KH', 'Id_SP'];

    public $incrementing = false;

    public $timestamps = false;
}
