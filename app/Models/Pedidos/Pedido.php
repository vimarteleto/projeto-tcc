<?php

namespace App\Models\Pedidos;

use App\Models\Cadastros\Cadastros;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cliente()
    {
        return $this->hasMany(Cadastros::class, 'id', 'cliente_id');
    }

}
