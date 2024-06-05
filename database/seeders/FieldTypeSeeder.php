<?php

namespace Database\Seeders;

use App\Models\FieldType;
use Illuminate\Database\Seeder;

class FieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fieldTypes = [
            ['name'=> 'Input'],
            ['name'=> 'Textarea'],
            ['name'=> 'Image'],
            ['name'=> 'Number'],
        ];
        foreach ($fieldTypes as $fieldType) {
            FieldType::query()->create($fieldType);
        }
    }
}
