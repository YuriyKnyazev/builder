<?php

namespace App\Services;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;

class BlockService
{
    public function parseData(Model $model): array
    {
        return $this->parseBlocks($model->blocks);
    }

    public function parseBlocks($blocks): array
    {
        $languages = Language::all();
        $fields = [];

        foreach ($languages as $language) {
            $fields[$language->id] = $this->parseByLanguage($blocks, $language);
        }

        return $fields;
    }

    public function parseByLanguage($blocks, Language $language): array
    {
        $fields = [];

        foreach ($blocks as $block) {
            $fields[$block->id] = $this->parseSingleBlockByLanguage($block, $language);
        }
        return $fields;
    }

    public function parseSingleBlockByLanguage($block, Language $language): array
    {
        $fields['template'] = $block->template->name;

        foreach ($block->template->fields as $field) {
            $field->value = $block->fieldContents
                ->where('field_id', $field->id)->where('language_id', $language->id)->value('content');
            $field->contentId = $block->fieldContents
                ->where('field_id', $field->id)->where('language_id', $language->id)->value('id');

            $fields['fields'][$field->contentId]['value'] = $field->value;
            $fields['fields'][$field->contentId]['id'] = $field->contentId;
            $fields['fields'][$field->contentId]['type'] = $field->fieldType->name;
            $fields['fields'][$field->contentId]['name'] = $field->name;
            $fields['fields'][$field->contentId]['label'] = $field->label;
        }

        if (count($block->blocks)) {
            $fields['subBlocks'] = $this->parseByLanguage($block->blocks, $language);
        }
        return $fields;
    }

    public function parseSingleData(Model $model): array
    {
        $languages = Language::all();
        $fields = [];

        foreach ($languages as $language) {
            $fields[$language->id][$model->block->id] = $this->parseSingleBlockByLanguage($model->block, $language);
        }
        return $fields;
    }
}
