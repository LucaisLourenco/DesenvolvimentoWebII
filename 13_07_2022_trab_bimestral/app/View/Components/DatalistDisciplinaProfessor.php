<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DatalistDisciplinaProfessor extends Component
{
    public $header;
    public $data;
    public $hide;
    public $disciplina;
    public $professor;

    public function __construct($header, $data, $hide, $disciplina, $professor) {
        $this->header = $header;
        $this->data = $data;    
        $this->hide = $hide;   
        $this->disciplina = $disciplina;
        $this->professor = $professor;
    }


    public function render()
    {
        return view('components.datalist-disciplina-professor');
    }
}
