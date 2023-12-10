<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'due_date', 'priority', 'category_id']; // Add 'category_id' to fillable fields

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

