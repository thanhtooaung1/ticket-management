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
        'user_id',
        'status',
        'assigned_user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedAgent()
    {
        return $this->belongsTo(User::class, 'assigned_user_id', 'id');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getPriority()
    {
        if ($this->priority == 0) return "Low";
        if ($this->priority == 1) return "Normal";
        return "High";
    }

    public function getStatus()
    {
        if ($this->status == 0) return "Closed";
        return "Open";
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
