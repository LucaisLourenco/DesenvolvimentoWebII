<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina_Professor extends Model
{
    use HasFactory;

    protected $fillable = ['professor_id', 'disciplina_id'];

    public function disciplina() {
        return $this->belongsToMany('\App\Models\Disciplina', 'matriculas')
            ->withPivot('descricao');
    }
 
    public function professor() {
        return $this->belongsTo('App\Models\Professor');
    }
}
