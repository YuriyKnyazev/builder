<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\GetFrontendRequest;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Support\Collection;

class FrontendController extends Controller
{
    public function index(GetFrontendRequest $request)
    {
        $languages = Language::query()
            ->where('is_show', 1)
            ->orderBy('sort')
            ->get();

        $currentLanguage = Language::query()
            ->where('code', app()->getLocale())
            ->first();

        $url = $request->url ?: '/';

        $page = Page::query()
            ->where('path', $url)
            ->with(['blocks' => function ($query) use ($currentLanguage) {
                $query->where('is_show', 1)
                    ->with('template')
                    ->with('fieldContents', function ($query) use ($currentLanguage) {
                        $query->with('field.fieldType')->where('language_id', $currentLanguage->id);
                    })
                    ->with(['blocks' => function ($query) use ($currentLanguage) {
                        $query->where('is_show', 1)
                            ->with('template')
                            ->with('fieldContents', function ($query) use ($currentLanguage) {
                                $query->with('field.fieldType')->where('language_id', $currentLanguage->id);
                            });
                    }]);
            }])
            ->firstOrFail();

        $blocks = $this->parseFrontBlocks($page->blocks);

        $menusModels = Menu::query()
            ->orderBy('sort')
            ->where('is_show', 1)
            ->with(['block' => function ($query) use ($currentLanguage) {
                $query->where('is_show', 1)
                    ->with('template')
                    ->with('fieldContents', function ($query) use ($currentLanguage) {
                        $query->with('field.fieldType')->where('language_id', $currentLanguage->id);
                    })
                    ->with(['blocks' => function ($query) use ($currentLanguage) {
                        $query->where('is_show', 1)
                            ->with('template')
                            ->with('fieldContents', function ($query) use ($currentLanguage) {
                                $query->with('field.fieldType')->where('language_id', $currentLanguage->id);
                            });
                    }]);
            }])
            ->get();

        $menus = $this->parseMenuBlocks($menusModels);

        return view('frontend.index', compact(['page', 'blocks', 'menus', 'languages']));
    }

    public function parseFrontBlocks(Collection $blocks): array
    {
        $blocksArray = [];
        $blocks->each(function ($block) use (&$blocksArray) {
            $blocksArray[$block->id]['template'] = str($block->template->name)->camel()->toString();
            $block->fieldContents->each(function ($fieldContent) use ($block, &$blocksArray) {
                $block->{$fieldContent->field->name} = $fieldContent->content;
                $blocksArray[$block->id][$fieldContent->field->name] = $fieldContent->content;
            });
            if (count($block->blocks)) {
                $blocksArray[$block->id]['blocks'] = $this->parseFrontBlocks($block->blocks);
            }
        });

        return $blocksArray;
    }

    private function parseMenuBlocks(Collection $menusModels): array
    {
        $menus = [];
        $menusModels->each(function ($menu) use (&$menus, &$pageIds) {
            $menus[$menu->block->id]['template'] = str($menu->block->template->name)->camel()->toString();

            $menu->block->fieldContents->each(function ($fieldContent) use ($menu, &$menus) {
                $menu->block->{$fieldContent->field->name} = $fieldContent->content;
                $menus[$menu->block->id][$fieldContent->field->name] = $fieldContent->content;
            });

            if (count($menu->block->blocks)) {
                $menus[$menu->block->id]['blocks'] = $this->parseFrontBlocks($menu->block->blocks);
            }
        });

        $pages = Page::query()->select('id', 'path')->get();

        foreach ($menus as &$menu) {
            if (isset($menu['page'])) {
                $menu['link'] = $pages->where('id', $menu['page'])->value('path');
            }

            foreach ($menu['blocks'] ?? [] as $key => $block) {
                if (isset($block['page'])) {
                    $menu['blocks'][$key]['link'] = $pages->where('id', $block['page'])->value('path');
                }
            }
        }

        return $menus;
    }
}
