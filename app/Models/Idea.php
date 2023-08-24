<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = [];
    const PAGINATION_COUNT = 10;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'firstUniqueSuffix' => 1
            ]
        ];
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
