<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Models\FieldContent;
use App\Models\Menu;
use App\Services\BlockService;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function __construct(
        private BlockService $blockService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::query()
            ->orderBy('sort')
            ->get();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $fields = $request->validated();
        $fields['sort'] = Menu::query()->count();
        $menu = Menu::query()->create($fields);
        return to_route('admin.menus.edit', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $menu->load('block.template.fields.fieldType', 'block.fieldContents');

        if ($menu->block) {
            $this->blockService->parseSingleData($menu);
        }

        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {


        $fieldData = $request->fieldContents;

        DB::transaction(function () use ($menu, $fieldData, $request) {
            $menu->update($request->validated());
            foreach ($fieldData as $id => $content) {
                FieldContent::query()->where('id', $id)->update(['content' => $content]);
            }
        });

        return to_route('admin.menus.edit', compact('menu'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
