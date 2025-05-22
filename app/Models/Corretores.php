<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corretores extends Model
{
    /** @use HasFactory<\Database\Factories\CorretoresFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'creci',
        'telefone',
    ];

}
