<?php

namespace App\Services;

use App\Models\Block;
use App\Models\Field;
use App\Models\FieldContent;
use App\Models\Language;
use App\Models\Template;

class FieldService
{

    public function update(array $fields, array $templateIds): void
    {
        $i = 0;
        $createFields = [];
        $updateFields = [];
        foreach ($fields as &$field) {
            $field['sort'] = $i;
            $i++;
            if (isset($field['id'])) {
                $updateFields[] = $field;
            } else {
                $createFields[] = $field;
            }
        }

        $fieldIds = array_column($updateFields, 'id');

        Field::query()
            ->whereNotIn('id', $fieldIds)
            ->whereIn('template_id', $templateIds)
            ->delete();

        Field::query()->upsert($updateFields, ['id'], ['label', 'name', 'sort', 'field_type_id']);
        Field::query()->insert($createFields);
    }

    public function storeFields(Template $template, Block $block): void
    {
        $languages = Language::all();

        $fields = $template->fields()->get();

        $fieldsContentArray = [];

        $i = 0;
        foreach ($languages as $language) {
            foreach ($fields as $field) {
                $fieldsContentArray[$i]['field_id'] = $field->getKey();
                $fieldsContentArray[$i]['block_id'] = $block->getKey();
                $fieldsContentArray[$i]['language_id'] = $language->getKey();
                $i++;
            }
        }

        FieldContent::query()->insert($fieldsContentArray);
    }
}
