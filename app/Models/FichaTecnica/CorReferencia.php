<?php

namespace App\Models\FichaTecnica;

use App\Models\Materiais\Material;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CorReferencia extends Pivot
{
    use HasFactory;

    protected $table = 'cor_referencia';

    protected $guarded = [];

    public function cor()
    {
        return $this->belongsTo(Cor::class, 'cor_id');
    }

    public function referencia()
    {
        return $this->belongsTo(Referencia::class, 'referencia_id');
    }

    

}
