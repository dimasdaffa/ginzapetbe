<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Stringable;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'price',
        'category_id',
        'is_popular',
        'stok',
    ];

    //Mutator for the 'slug' attribute
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    //Banyak data realis dalam 1 tabel
    public function benefits(): HasMany
    {
        return $this->hasMany(ProductBenefit::class);
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(ProductTestimonial::class);
    }
    //Relasi ke tabel kategori 1 aja
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
