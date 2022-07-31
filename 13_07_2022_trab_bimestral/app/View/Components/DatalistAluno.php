<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DatalistAluno extends Component
{
    public $header;
    public $data;
    public $hide;
    public $cursos;
    
    public function __construct($header, $data, $hide) {
        $this->header = $header;
        $this->data = $data;    
        $this->hide = $hide;   
    }

    public function render()
    {
        return view('components.datalist-aluno');
    }
}
