<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chat;


class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function chat()
    {
        return $this->hasOne(Chat::class);
    }

}
