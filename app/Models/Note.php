<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'element_type',
        'ram',
        'cpu',
        'gpu',
        'resolution',
        'size',
        'loudness',
        'storage',
        'note',
        'room',
        'date',
        'scrapped',
        'user_id',
        'disk'
    ];
}
