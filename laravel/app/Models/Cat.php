<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $table = 'cats';

    protected $fillable = ['breeds', 'estimatedLife', 'origin'];

    protected $colors = [
        'color_ids' => 'array'
    ];

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'cats_colors', 'cat_id', 'color_id');
        // 'cats_colors' is pivot table, it has 'cat_id' and 'color_id' as fields
    }
}
