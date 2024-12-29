<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('body');
            $table->foreignUuid('post_id')->references('id')->on('posts');
            $table->foreignUuid('membership_id')->references('id')->on('memberships');

            $table->timestamps();
        });

        Schema::create('replies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('body')->primary();
            $table->foreignUuid('membership_id')->references('id')->on('memberships');
            $table->foreignUuid('comment_id')->references('id')->on('comments');
            $table->uuid('reply_to')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
        Schema::dropIfExists('comments');
    }
};
