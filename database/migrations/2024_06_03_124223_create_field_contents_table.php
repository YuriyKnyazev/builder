<?php

use App\Models\Block;
use App\Models\Field;
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
        Schema::create('field_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Block::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Field::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_contents');
    }
};
