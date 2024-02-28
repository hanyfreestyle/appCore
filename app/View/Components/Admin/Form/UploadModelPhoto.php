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
    public $file;
    public $filde;
    public $filter;
    public $col;
    public $route;
    public $filterName;

    public function __construct(
        $row = array(),
        $pageData = array(),
        $isactive = true,
        $file='image',
        $filde='photo',
        $filter='_filterid',
        $col='6',
        $route='.emptyPhoto',
        $filterName='filter_id',
    )
    {
        $this->pageData = $pageData;
        $this->row = $row;
        $this->isactive = $isactive;
        $this->filde = $filde;
        $this->filter = $filter;
        $this->col = $col;
        $this->route = $route;
        $this->file = $file;
        $this->filterName = $filterName;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.form.upload-model-photo');
    }
}
