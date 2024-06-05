<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Block\BlockIdRequest;
use App\Http\Requests\UpdateBlockRequest;
use App\Models\Block;
use App\Models\FieldContent;
use App\Models\Page;
use App\Models\Template;

class BlockController extends Controller
{
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
    public function create(Page $page)
    {
        $templates = Template::query()->where('is_show', 1)->get();
        return view('admin.blocks.create', compact(['templates', 'page']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Page $page, Template $template)
    {
        $blockCount = $page->blocks()->count();

        $block = $page->blocks()->create([
            'sort' => $blockCount,
            'template_id' => $template->getKey()
        ]);

        $fields = $template->fields()->get();

        $fieldsContentArray = [];
        foreach ($fields as $field) {
            $fieldsContentArray[$field->id]['field_id'] = $field->getKey();
            $fieldsContentArray[$field->id]['block_id'] = $block->getKey();
        }

        FieldContent::query()->insert($fieldsContentArray);

        return to_route('admin.pages.edit', compact('page'));
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
