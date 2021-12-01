<?php

namespace App\Models\Pedidos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialPedido extends Model
{
    use HasFactory;

    protected $table = 'material_pedido';

    protected $guarded = [];
}
