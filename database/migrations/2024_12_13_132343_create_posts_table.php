<?php

use App\Models\VoteType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('body');
            $table->foreignUuid('membership_id')->references('id')->on('memberships');
            $table->timestamps();
        });

        Schema::create('votes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->tinyInteger('type');
            $table->foreignUuid('membership_id')->references('id')->on('memberships');
            $table->foreignUuid('post_id')->references('id')->on('posts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
        Schema::dropIfExists('posts');
    }
};
