<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'photo',
        'photo_white',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function productServices(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function popularServices()
    {
        return $this->hasMany(Product::class)
            ->where('is_popular', true)
            ->orderBy('created_at', 'desc'); // Optional: order by created date
    }
}
