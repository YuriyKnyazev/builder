<?php

namespace App\View\Components\Admin\Fields;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Page extends Component
{
    public Collection $pages;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public string $name,
        public string $id,
        public string|null $value = null,
    )
    {
        $this->pages = \App\Models\Page::query()
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
