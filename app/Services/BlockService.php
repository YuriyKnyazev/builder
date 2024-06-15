<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BlockService
{

    public function parseData(Model $model): void
    {
        $model->blocks->each(function ($block) {
            $block->template->fields->each(function ($field) use ($block) {
                $field->value = $block->fieldContents
                    ->where('field_id', $field->id)->value('content');
                $field->contentId = $block->fieldContents
                    ->where('field_id', $field->id)->value('id');
            });
        });
    }

    public function parseSingleData(Model $model): void
    {
        $model->block->template->fields->each(function ($field) use ($model) {
            $field->value = $model->block->fieldContents
                ->where('field_id', $field->id)->value('content');
            $field->contentId = $model->block->fieldContents
                ->where('field_id', $field->id)->value('id');
        });
    }
}
