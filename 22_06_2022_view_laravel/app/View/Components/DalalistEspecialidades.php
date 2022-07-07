<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Datalist extends Component {

    public $header;
    public $data;
    public $hide;
    public $esp;

    public function __construct($header, $data, $hide, $esp) {
        $this->header = $header;
        $this->data = $data;    
        $this->hide = $hide;   
        $this->esp = $esp;
    }

    public function render() {

        return view('components.datalist-especialidade');
    }
}
