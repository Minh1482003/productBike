<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model {

  public $timestamps = false;

  protected $table = 'role';
  protected $primaryKey = 'Id_role';

  protected $fillable = [
    'Name',
    'Description',
    'Permission'
  ];

}