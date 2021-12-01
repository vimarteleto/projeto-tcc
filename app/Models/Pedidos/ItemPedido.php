<?php

namespace App\Models\Pedidos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPedido extends Model
{
    use HasFactory;

    protected $table = 'item_pedido';

    protected $guarded = [];

    
}
