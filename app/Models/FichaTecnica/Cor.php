<?php

namespace App\Models\FichaTecnica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'cores';
    

    public function skus()
    {
        return $this->hasMany(CorReferencia::class);
    }
}
