<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAudio extends Model
{
    protected $table = 'product_audios';
    use HasFactory;

    protected $fillable = ['product_id', 'audio_path'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
