<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DatalistMatricula extends Component
{
    public function __construct($header, $data, $hide) {
        $this->header = $header;
        $this->data = $data;    
        $this->hide = $hide;   
    }

    public function render()
    {
        return view('components.datalist-matricula');
    }
}
