<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class CategoryModel extends Model {
  use Sluggable, SluggableScopeHelpers;

  public $timestamps = false;

  protected $table = 'category';
  protected $primaryKey = 'Id_DM';

  protected $fillable = [
    'Name',
    'Deleted',
  ];

  protected $attributes = [
    'Deleted' => 0,
  ];

  public function sluggable(): array {
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