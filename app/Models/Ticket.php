<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'priority',
    ];

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getPriority()
    {
        if ($this->priority == 0) return "Low";
        if ($this->priority == 1) return "Normal";
        return "High";
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
