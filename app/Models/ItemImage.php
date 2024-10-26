<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'item_id','coloure']; // Add other fields as needed

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

