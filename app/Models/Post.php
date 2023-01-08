<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function getRouteKeyName() {

        return 'slug';
        
    }

    protected $fillable = [
        'title',
        'image',
        'text',
        'tags',
        'user_id',
        'slug'
    ];

    public function scopeFilter($query, array $filters) {

        if($filters['search'] ?? false) {
            return $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('text', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }

    }

    public function user() {

        return $this->belongsTo('\App\Models\User');

    }

    public function comment() {

        return $this->hasMany('\App\Models\Comment');

    }
}
