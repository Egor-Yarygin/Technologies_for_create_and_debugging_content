<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['content', 'user_id', 'post_id'];

    // Дополнительные настройки модели, если необходимо

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Query Scope для комментариев, созданных за последние 7 дней
    public function scopeRecent($query)
    {
        return $query->where('created_at', '>', now()->subDays(7));
    }
}
