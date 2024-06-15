<?php

namespace App\Services;

use App\Models\Block;
use App\Models\Field;
use App\Models\FieldContent;
use App\Models\Template;

class FieldService
{

    public function update(array $fields, Template $template): void
    {
        $i = 0;
        $createFields = [];
        $updateFields = [];
        foreach ($fields as &$field) {
            $field['sort'] = $i;
            $field['template_id'] = $template->getKey();
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
            ->where('template_id', $template->getKey())
            ->delete();
        Field::query()->upsert($updateFields, ['id'], ['label', 'name', 'sort', 'field_type_id']);
        Field::query()->insert($createFields);
    }

    public function storeFields(Template $template, Block $block): void
    {
        $fields = $template->fields()->get();

        $fieldsContentArray = [];
        foreach ($fields as $field) {
            $fieldsContentArray[$field->id]['field_id'] = $field->getKey();
            $fieldsContentArray[$field->id]['block_id'] = $block->getKey();
        }

        FieldContent::query()->insert($fieldsContentArray);
    }
}
