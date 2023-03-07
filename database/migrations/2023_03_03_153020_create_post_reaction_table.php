<?php

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
        Schema::create('post_reaction', function (Blueprint $table) {
            $table->foreignUuid('post_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('reaction_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary(['post_id', 'user_id']);
            $table->timestamp('created_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_reaction');
    }
};
