<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImovelFotos extends Model
{
    use HasFactory;

    protected $fillable = ['imovel_id', 'caminho'];

    public function imovel()
    {
        return $this->belongsTo(Imoveis::class);
    }

    public function getUrlAttribute()
    {
        return Storage::disk('public')->url($this->caminho);
    }

}
