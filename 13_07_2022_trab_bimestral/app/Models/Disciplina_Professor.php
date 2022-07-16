<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina_Professor extends Model
{
    use HasFactory;

    protected $fillable = ['professor_id', 'disciplina_id'];
}
