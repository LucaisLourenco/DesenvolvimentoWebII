<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function type() {
        return $this->belongsTo('\App\Models\Type');
    }

    public function role() {
        return $this->belongsTo('\App\Models\Role');
    }
}
