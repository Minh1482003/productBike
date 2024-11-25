<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class ProductModel extends Model {
  use Sluggable, SluggableScopeHelpers;

  protected $table = 'product';
  protected $primaryKey = 'Id_SP';

  protected $fillable = [
    'Name',
    'Slug',
    'Image',
    'Price',
    'Price_hour',
    'Price_day',
    'Quantity',
    'Description',
    'Deleted',
    'Status',
    'Position',
    'View',
    'Buy_or_rent',
    'Id_DM'
  ];

  protected $attributes = [
    'Price_hour' => 0,
    'Price_day' => 0,
    'Position' => 0,
    'Deleted' => 0,
    'View' => 0, 
    'Status' => 'active'
  ];

  const CREATED_AT = 'createdAt';
  const UPDATED_AT = 'updatedAt';
  protected $dates = ['deletedAt'];

  public function sluggable(): array
  {
    return [
      'Slug' => [
          'source' => 'Name',
          'onUpdate' => true,
          'separator' => '-',
          'unique' => true,
        ] 
    ];
  }
}