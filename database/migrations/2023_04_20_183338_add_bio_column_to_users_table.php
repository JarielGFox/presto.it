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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 100)->nullable()->after('remember_token');
            $table->string('surname', 100)->nullable()->after('first_name');
            $table->date('date_of_birth')->nullable()->after('surname');
            $table->string('country', 50)->nullable()->after('date_of_birth');
            $table->text('address')->nullable()->after('country');
            $table->longText('biography')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('surname');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('country');
            $table->dropColumn('address');
            $table->dropColumn('biography');
        });
    }
};
