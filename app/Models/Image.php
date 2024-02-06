<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function Ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function imageUrl()
    {
        return asset('storage/tickets/' . $this->image);
    }
}
