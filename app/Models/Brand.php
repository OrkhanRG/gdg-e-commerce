<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array|null $data)
 */
class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
        'logo',
        'is_featured',
        'order'
    ];
}
