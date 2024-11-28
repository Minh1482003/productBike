<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillModel extends Model {
    public $timestamps = false;

    protected $table = 'bill';
    protected $primaryKey = 'Id_HD';

    protected $fillable = [
      'Id_KH',
      'Oder_date',
      'Status',
      'Type_bill',
      'Total_price',
      'Note'
    ];
    
}