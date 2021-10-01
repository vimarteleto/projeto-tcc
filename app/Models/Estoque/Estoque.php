<?php

namespace App\Models\Estoque;

use App\Models\Materiais\Material;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
