<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sides', function (Blueprint $table) {

            $table->string('id')->primary();
            $table->string('name')->unique();
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('memberships', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('side_id')->nullable(false);
            $table->enum('role', array_column(Role::cases(), 'value'));

            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreign('side_id')->references('id')->on('sides');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
        Schema::dropIfExists('sides');
    }
};
