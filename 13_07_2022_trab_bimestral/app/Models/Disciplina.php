<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'curso_id', 'carga'];

    public function curso() {
        return $this->belongsTo('App\Models\Curso');
    }

    public function aluno() {
        return $this->belongsToMany('\App\Models\Aluno');
    }

    public function professor() {
        return $this->belongsToMany('\App\Models\Professor');
    }
}
