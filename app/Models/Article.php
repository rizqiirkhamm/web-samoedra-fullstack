<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'category_id',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke model Event untuk kategori
    public function category()
    {
        return $this->belongsTo(EventModel::class, 'category_id', 'id');
    }

    // Accessor untuk memastikan tags selalu array
    public function getTagsAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    // Mutator untuk menyimpan tags sebagai JSON
    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = is_array($value) ? json_encode($value) : $value;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
