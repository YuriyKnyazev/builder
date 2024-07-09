<?php

use App\Models\Language;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('field_contents', function (Blueprint $table) {
                $table->foreignIdFor(Language::class)
                    ->default(Language::query()->where('code', 'en')->value('id'))
                    ->constrained()
                    ->cascadeOnDelete();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('field_contents', function (Blueprint $table) {
                $table->dropForeignIdFor(Language::class);
                $table->dropColumn('template_id');
        });
    }
};
