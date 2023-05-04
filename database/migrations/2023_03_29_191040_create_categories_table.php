<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $categories =
            [
                'Abbigliamento',
                'Animali',
                'Arredamento',
                'Chincaglierie e Miscellanea',
                'Collezionismo',
                'Elettronica',
                'Giardinaggio',
                'Libri e Riviste',
                'Orologi e Gioielli',
                'Immobili',
                'Informatica',
                'Motori',
                'Musica, CD e Vinili',
                'Sport',
                'Strumenti Musicali',
                'Videogiochi',

            ];
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
