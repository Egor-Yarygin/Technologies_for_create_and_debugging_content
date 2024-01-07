<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    protected $dates = ['deleted_at']; // Поле для хранения информации о мягком удалении

    // Query Scope для активных категорий
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
