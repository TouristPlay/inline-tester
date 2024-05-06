<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $guarded = [
        'id'
    ];

    public function scopeSearch(Builder $builder, ?string $body): Builder
    {
        return $builder->whereHas('comments', function ($query) use ($body) {
            $query->where('body', 'like', '%' . $body . '%');
        });
    }

    public function comments(): HasMany
    {
        return $this->hasMany(
            Comment::class,
            'post_id',
            'id'
        );
    }
}
