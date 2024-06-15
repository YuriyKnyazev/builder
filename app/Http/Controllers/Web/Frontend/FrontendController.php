<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\GetFrontendRequest;
use App\Models\Menu;
use App\Models\Page;

class FrontendController extends Controller
{
    public function index(GetFrontendRequest $request)
    {
        $url = $request->url ?: '/';

        $page = Page::query()
            ->where('path', $url)
            ->with(['blocks' => function ($query) {
                $query->where('is_show', 1)
                    ->with('template', 'fieldContents.field.fieldType');
            }])
            ->firstOrFail();

        $blocks = [];

        $page->blocks->each(function ($block) use (&$blocks) {
            $blocks[$block->id]['template'] = str($block->template->name)->camel()->toString();
            $block->fieldContents->each(function ($fieldContent) use ($block, &$blocks) {
                $block->{$fieldContent->field->name} = $fieldContent->content;
                $blocks[$block->id][$fieldContent->field->name] = $fieldContent->content;
            });
        });

        $menusModels = Menu::query()
            ->orderBy('sort')
            ->where('is_show', 1)
            ->with(['block' => function ($query) {
                $query->where('is_show', 1)
                    ->with('template', 'fieldContents.field.fieldType');
            }])
            ->get();

        $menus = [];

        $menusModels->each(function ($menu) use (&$menus) {
            $menus[$menu->block->id]['template'] = str($menu->block->template->name)->camel()->toString();

            $menu->block->fieldContents->each(function ($fieldContent) use ($menu, &$menus) {
                $menu->block->{$fieldContent->field->name} = $fieldContent->content;
                $menus[$menu->block->id][$fieldContent->field->name] = $fieldContent->content;
            });
        });
        return view('frontend.index', compact(['page', 'blocks', 'menus']));
    }
}
