<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DatalistDisciplina extends Component
{
    public $header;
    public $data;
    public $hide;
    public $cursos;

    public function __construct($header, $data, $hide, $cursos) {
        $this->header = $header;
        $this->data = $data;    
        $this->hide = $hide;   
        $this->cursos = $cursos;
    }

    public function render()
    {
        return view('components.datalist-disciplina');
    }
}
