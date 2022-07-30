<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'siape', 'eixo_id', 'ativo'];

    public function disciplina() {
        return $this->belongsToMany('\App\Models\Disciplina', 'matriculas')
            ->withPivot('descricao');
    }

    public function eixo() {
        return $this->belongsTo('App\Models\Eixo');
    }
}
