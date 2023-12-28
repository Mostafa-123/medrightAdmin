<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Queue\NullQueue;
use Illuminate\View\Component;

class textInputComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $id;
    public $text;
    public $value;
    public $placeholder;
    public $type;

    public function __construct($name,$id,$text, $value=null, $placeholder,$type)
    {
        $this->name = $name;
        $this->id = $id;
        $this->text = $text;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // dd($this->span_name);
        return view('components.forms.text-input-component');
    }
}
