<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class UserModel extends Authenticatable {
    use HasFactory, Notifiable;

    protected $table = 'user'; 
    protected $primaryKey = 'Id_KH';

    protected $fillable = [
        'Name',
        'Image', 
        'Address',
        'SDT',
        'Email',
        'Status',
        'Username',
        'Password',
        'Token',
        'Is_verify',
        'Deleted',
        'Id_role',
    ];

    protected $hidden = [
        // 'Password',
        // 'Token',
    ];

    protected $attributes = [
        'Id_role' => 0,
      ];

    protected function casts(): array {
        return [
            'createdAt' => 'datetime',
            'deletedAt' => 'datetime',
            'Deleted' => 'boolean',
            'Status' => 'string',
        ];
    }

    public function setPasswordAttribute($value) {
        $this->attributes['Password'] = Hash::make($value);
    }

    protected static function boot(){
        parent::boot();
        
        static::creating(function ($model) {
            $model->Token = str()->random(50); 
        });
    }
    
    public $timestamps = false;
    
    const CREATED_AT = 'createdAt';
    const DELETED_AT = 'deletedAt';
}