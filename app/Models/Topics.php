<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'topic_id');
    }

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search'])) {
            $query->where('title', 'LIKE', '%' . $filters['search'] . '%')
                ->orWhere('content', 'LIKE', '%' . $filters['search'] . '%');
        }
    }
}
