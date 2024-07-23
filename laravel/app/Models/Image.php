<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'file_path', 'cat_id'];

    /**
     * Get the cat that owns the image.
     */
    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }
}
