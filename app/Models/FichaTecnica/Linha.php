<?php

namespace App\Models\FichaTecnica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linha extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function referencias()
    {
        return $this->hasMany(Referencia::class);
    }
}
