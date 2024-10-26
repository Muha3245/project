<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HighlightImage extends Model
{
    use HasFactory;
    protected $fillable = ['highlight_id', 'image', 'name', 'detail'];

    public function highlight()
    {
        return $this->belongsTo(Highlight::class);
    }
}
