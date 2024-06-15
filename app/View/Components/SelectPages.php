<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SelectPages extends Component
{
public Collection $pages;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->pages = Page::query()
            ->where('is_show', 1)
            ->orderBy('sort')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.fields.page');
    }
}
