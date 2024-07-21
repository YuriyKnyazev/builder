<?php

namespace App\Services;

use App\Models\Block;
use App\Models\Field;
use App\Models\FieldContent;
use App\Models\Language;

class LanguageService
{
    public function create(array $params): Language
    {
        $sort = Language::query()->count();

        /* @var Language $language */
        $language = Language::query()->create($params
            + compact('sort'));

        return $language;
    }

    public function insertFieldContents(Language $language): void
    {
        $insertData = [];

        $blocks = Block::query()->with('template.fields')->get();

        foreach ($blocks as $block) {
            /* @var Block $block */
            foreach ($block->template->fields as $field) {
                /* @var Field $field */
                $insertData[] = [
                    'block_id' => $block->getKey(),
                    'field_id' => $field->getKey(),
                    'language_id' => $language->getKey(),
                ];
            }
        }
        FieldContent::query()->insert($insertData);
    }
}
