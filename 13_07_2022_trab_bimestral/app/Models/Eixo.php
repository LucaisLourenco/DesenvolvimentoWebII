<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eixo extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function professor() {
        return $this->belongsTo('App\Models\Professor');
    }

    public function curso() {
        return $this->belongsTo('App\Models\Curso');
    }
}
