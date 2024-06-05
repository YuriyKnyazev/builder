<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\StorePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Models\FieldContent;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pages = Page::query()->orderBy('sort')->get();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request): RedirectResponse
    {
        $page = Page::query()->create($request->validated());
        return to_route('admin.pages.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page): View
    {
        $page->load('blocks.template.fields.fieldType', 'blocks.fieldContents');

        $page->blocks->each(function ($block) use ($page) {
            $block->template->fields->each(function ($field) use ($page, $block) {
                $field->value = $block->fieldContents
                    ->where('field_id', $field->id)->value('content');
                $field->contentId = $block->fieldContents
                    ->where('field_id', $field->id)->value('id');
            });
        });

        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        DB::transaction(function () use ($page, $request) {
            $page->update($request->validated());

            foreach ($request->fieldContents as $id => $content) {
                FieldContent::query()->where('id', $id)->update(['content' => $content]);
            }
        });

        return to_route('admin.pages.edit', compact('page'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();
        return to_route('admin.pages.index');
    }
}
