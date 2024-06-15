<?php

namespace App\Http\Controllers\Web\Admin;

use App\Enums\TemplateTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Block\BlockIdRequest;
use App\Http\Requests\UpdateBlockRequest;
use App\Models\Block;
use App\Models\FieldContent;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Template;
use App\Services\FieldService;

class BlockController extends Controller
{
    public function __construct(
        private FieldService $fieldService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPageBlock(Page $page)
    {
        $templates = Template::query()
            ->where('template_type', TemplateTypeEnum::Page->value)
            ->where('is_show', 1)
            ->get();

        return view('admin.blocks.create', compact(['templates', 'page']));
    }

    public function createMenuBlock(Menu $menu)
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
    public function store(Page $page, Template $template)
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

    public function storeMenu(Menu $menu, Template $template)
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
     * Display the specified resource.
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Block $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlockRequest $request, Block $block)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlockIdRequest $request)
    {
        Block::query()->where('id', $request->blockId)->delete();
        return back();
    }
}
