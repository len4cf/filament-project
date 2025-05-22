<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitas extends Model
{
    /** @use HasFactory<\Database\Factories\VisitasFactory> */
    use HasFactory;

    protected $table = 'visitas';

    protected $fillable = [
        'imovel_id',
        'corretor_id',
        'cliente_id',
        'data_hora',
        'status',
        'observacoes'
    ];

    public function imovel()
    {
        return $this->belongsTo(Imoveis::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id', 'id');
    }

    public function corretor()
    {
        return $this->belongsTo(Corretores::class);
    }

}
