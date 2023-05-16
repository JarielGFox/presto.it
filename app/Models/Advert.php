<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Advert extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['title', 'body', 'price', 'typology', 'category_id'];

    public function toSearchableArray()
    {
        $category = $this->category;
        $array = [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'typology' => $this->typology,
            'category' => $category,
        ];
        return $array;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public static function toBeReviewedCount()
    {
        return Advert::where('is_accepted', null)->count();
    }
}
