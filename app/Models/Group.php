<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;


class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function message()
    {
        return $this->hasOne(Message::class);
    }

}