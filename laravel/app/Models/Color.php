<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cat;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    protected $fillable = ['name', 'hex', 'rgb'];

    public function cats()
    {
        return $this->belongsToMany(Cat::class, 'cats_colors');
    }
}
