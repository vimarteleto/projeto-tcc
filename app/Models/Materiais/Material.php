<?php

namespace App\Models\Materiais;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'materiais';

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
