<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogleVisionFieldsToImagesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->text('labels')->nullable();
            $table->string('adult')->nullable();
            $table->string('spoof')->nullable();
            $table->string('medical')->nullable();
            $table->string('violence')->nullable();
            $table->string('racy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn(['labels', 'adult', 'spoof', 'medical', 'violence', 'racy']);
        });
    }
};
