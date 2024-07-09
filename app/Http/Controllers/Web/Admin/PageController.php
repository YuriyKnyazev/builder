<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\StorePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Models\FieldContent;
use App\Models\Language;
use App\Models\Page;
use App\Services\BlockService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class PageController extends Controller
{
    public function __construct(
        private BlockService $blockService
    ){
    }
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
        $languages = Language::query()->orderBy('sort')->get();

        $page->load(
            'blocks.template.fields.fieldType',
            'blocks.fieldContents',
            'blocks.template.template',
            'blocks.blocks.blocks'
        );

        $blocks = $this->blockService->parseData($page);

        return view('admin.pages.edit', compact('page', 'languages', 'blocks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $fieldData = $request->fieldContents;

        if ($files = $request->file('fieldContents')) {
            foreach ($files as $id => $file) {
                $fileName = rand(111111, 999999). '.' . $file->getClientOriginalExtension();
                Storage::putFileAs('pages/' . $page->getKey(), $file, $fileName);
                $fieldData[$id] = 'storage/pages/' . $page->getKey() . '/' . $fileName;
            }
        }

        DB::transaction(function () use ($page, $fieldData, $request) {
            $page->update($request->validated());

            foreach ($fieldData as $id => $content) {
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
