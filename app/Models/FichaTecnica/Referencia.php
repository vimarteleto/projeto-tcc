<?php

namespace App\Models\FichaTecnica;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function linha()
    {
        return $this->belongsTo(Linha::class);
    }
}
