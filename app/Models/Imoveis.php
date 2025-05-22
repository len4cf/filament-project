<?php

namespace App\Models;

use App\Enums\StatusImoveis;
use App\Enums\TipoImovel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imoveis extends Model
{
    /** @use HasFactory<\Database\Factories\ImoveisFactory> */
    use HasFactory;


    protected $fillable = [
        'titulo',
        'descricao',
        'tipo',
        'endereco',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'area',
        'num_quartos',
        'num_banheiros',
        'valor',
        'status',
        'proprietario_id',
        'inquilino_id',
        'corretor_id'
    ];

    protected $casts = [
        'status' => StatusImoveis::class,
        'tipo' => TipoImovel::class,
    ];

    public function proprietario()
    {
        return $this->belongsTo(Clientes::class, 'proprietario_id');
    }

    public function corretor()
    {
        return $this->belongsTo(Corretores::class, 'corretor_id');
    }

    public function inquilino()
    {
        return $this->belongsTo(Clientes::class, 'inquilino_id');
    }

    public function visitas()
    {
        return $this->hasMany(Visitas::class, 'imovel_id');
    }

    public function fotos()
    {
        return $this->hasMany(ImovelFotos::class, 'imovel_id');
    }

}
