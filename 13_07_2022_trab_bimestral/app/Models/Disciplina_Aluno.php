<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina_Aluno extends Model
{
    use HasFactory;

    protected $fillable = ['aluno_id', 'disciplina_id'];

    public function disciplina() {
        return $this->belongsToMany('\App\Models\Disciplina');
    }

    public function aluno() {
        return $this->belongsToMany('\App\Models\Aluno');
    }
}
