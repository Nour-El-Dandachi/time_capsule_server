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
        Schema::create('capsules', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->string("title");
            $table->text("message");
            $table->string("gps_location");
            $table->string("ip_address");
            $table->date("reveal_date");
            $table->string("visibility");
            $table->string("mode");
            $table->string("color");
            $table->string("emoji");
            $table->boolean("is_revealed")->default(0);
            $table->timestamps();
        });

        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->integer("capsule_id");
            $table->string("type");
            $table->text("file_path");
            $table->timestamps();
        });

        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->integer("capsule_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capsules');
        Schema::dropIfExists('media');
        Schema::dropIfExists('emails');
    }
};
