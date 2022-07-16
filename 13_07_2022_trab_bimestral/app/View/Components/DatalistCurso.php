<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DatalistCurso extends Component
{
    public $header;
    public $data;
    public $hide;
    public $eixos;

    public function __construct($header, $data, $hide, $eixos, $mensagem) {
        $this->header = $header;
        $this->data = $data;    
        $this->hide = $hide;   
        $this->eixos = $eixos;
    }

    public function render()
    {
        return view('components.datalist-curso');
    }
}
