<?php

namespace App\Models\Materiais;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function materiais()
    {
        return $this->hasMany(Material::class);
    }

}
