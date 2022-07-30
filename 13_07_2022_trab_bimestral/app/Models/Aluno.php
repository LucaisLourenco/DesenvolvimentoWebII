<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function disciplina() {
        return $this->belongsToMany('\App\Models\Disciplina')
            ->withPivot('descricao');
    }

    public function curso() {
        return $this->belongsTo('App\Models\Curso');
    }
}
