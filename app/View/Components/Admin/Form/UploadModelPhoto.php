<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UploadModelPhoto extends Component
{

    public $row;
    public $isactive;
    public $pageData;

    public function __construct(
        $row = array(),
        $pageData = array(),
        $isactive = true,
    )
    {
        $this->pageData = $pageData;
        $this->row = $row;
        $this->isactive = $isactive;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.form.upload-model-photo');
    }
}
