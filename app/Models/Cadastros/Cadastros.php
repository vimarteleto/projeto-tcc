<?php

namespace App\Models\Cadastros;

use App\Models\Pedidos\Pedido;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cadastros extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
