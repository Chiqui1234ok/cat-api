<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $table = 'cats';

    protected $fillable = ['name', 'breed', 'origin', 'estimatedLife', 'user_id',];

    protected $colors = [
        'color_ids' => 'array'
    ];

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'cats_colors');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
