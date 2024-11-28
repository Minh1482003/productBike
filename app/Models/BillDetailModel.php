<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillDetailModel extends Model {
    public $timestamps = false;

    protected $table = 'bill_detail';
    protected $primaryKey = ['Id_HD', 'Id_SP'];
    public $incrementing = false;

    protected $fillable = [
      'Id_HD',
      'Id_SP',
      'Price',
      'Quantity',
      'Type_rental',
      'Rental_start',
      'Rental_expectedEnd',
      'Rental_end',
      'Rental_term',
    ];
}