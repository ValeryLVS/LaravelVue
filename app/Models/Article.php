<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    //Доступные поля при массовом заполнение
    protected $fillable = ['title', 'body', 'img', 'slug'];

    public $dates = ['published_at'];

    //Не доступные поля при массовом заполнение
    protected $quarded = [];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function state(): HasOne
    {
        return $this->hasOne(State::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeLastLimit($query, $numbers)
    {
        return $query->with('state', 'tags')->orderBy('created_at', 'desc')->limit($numbers)->get();
    }

    public function scopeAllPaginate($query, $numbers)
    {
        return $query->with('state', 'tags')->orderBy('created_at', 'desc')->paginate($numbers);
    }

    public function getBodyPreview(): string
    {
        return Str::limit(100);
    }

    public function createdAtForHumans()
    {
        return $this->published_at->diffForHumans();
    }

    public function scopeFindBySlug($query, $slug)
    {
        return $query->with('comments','tags', 'state')->where('slug', $slug)->firstOrFail();
    }

    public function scopeFindByTag($query)
    {
        return $query->with('tags', 'state')->orderBy('created_at', 'desc')->paginate(10);
    }
}
