<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;

    // Specify the table associated with the model if it's not "books"
    protected $table = 'books';

    // Specify the primary key if it's not "id"
    protected $primaryKey = 'id';

    // Specify the properties that are mass assignable
    protected $fillable = [
        'title',
        'isbn',
        'authors',
        'publisher',
        'edition',
        'category_id',
        'cover_art',
        'user_id',
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
