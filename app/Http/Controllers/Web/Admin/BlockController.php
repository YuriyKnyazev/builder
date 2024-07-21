<?php

namespace App\Http\Controllers\Web\Admin;

use App\Enums\TemplateTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Block\BlockIdRequest;
use App\Http\Requests\Block\BulkStoreBlockRequest;
use App\Models\Block;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Template;
use App\Services\FieldService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlockController extends Controller
{
    public function __construct(
        private readonly FieldService $fieldService
    )
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPageBlock(Page $page): View
    {
        $templates = Template::query()
            ->where('template_type', TemplateTypeEnum::Page->value)
            ->where('is_show', 1)
            ->get();

        return view('admin.blocks.create', compact(['templates', 'page']));
    }

    public function createMenuBlock(Menu $menu): View
    {
        $templates = Template::query()
            ->where('template_type', TemplateTypeEnum::Menu->value)
            ->where('is_show', 1)
            ->get();

        return view('admin.blocks.createMenu', compact(['templates', 'menu']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Page $page, Template $template): RedirectResponse
    {
        $blockCount = $page->blocks()->count();

        /* @var Block $block */
        $block = $page->blocks()->create([
            'sort' => $blockCount,
            'template_id' => $template->getKey()
        ]);

        $this->fieldService->storeFields($template, $block);

        return to_route('admin.pages.edit', compact('page'));
    }

    public function bulkStore(BulkStoreBlockRequest $request): RedirectResponse
    {
        $blocks = [];
        /* @var Template $template */
        $template = Template::query()->find($request->templateId);

        for ($i = 0; $i < $request->number; $i++) {
            $blocks[] = [
                'template_id' => $request->templateId,
                'block_id' => $request->blockId,
                'block_type' => 'App\Models\Block',
                'sort' => $i,
                'is_show' => 1
            ];
        }
        foreach ($blocks as $block) {
            $block = Block::create($block);
            $this->fieldService->storeFields($template, $block);
        }
        return back();
    }

    public function storeMenu(Menu $menu, Template $template): RedirectResponse
    {
        $blockCount = $menu->block()->count();

        /* @var Block $block */
        $block = $menu->block()->create([
            'sort' => $blockCount,
            'template_id' => $template->getKey()
        ]);

        $this->fieldService->storeFields($template, $block);

        return to_route('admin.menus.edit', compact('menu'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlockIdRequest $request): RedirectResponse
    {
        Block::query()->where('id', $request->blockId)->delete();
        return back();
    }
}
