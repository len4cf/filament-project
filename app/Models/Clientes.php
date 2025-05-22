<?php

namespace App\Models;

use App\Enums\TipoCliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    /** @use HasFactory<\Database\Factories\ClientesFactory> */
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'tipo',
        'usuario_id',
    ];

    protected $casts = [
        'tipo' => TipoCliente::class
    ];
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function imoveis()
    {
        return $this->hasMany(Imoveis::class);
    }


}
