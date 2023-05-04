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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_en')->after('name');
            $table->string('name_de')->after('name_en');
        });
        $categoriesEn = 
        [
            'Clothing',
            'Animals',
            'Furniture',
            'Trinkets and Miscellaneous',
            'Collectables',
            'Electronics',
            'Gardening',
            'Books and Magazines',
            'Watches And Jewelry',
            'Properties',
            'Informatics',
            'Vehicles and motors',
            'Music, CDs and Vinyls',
            'Sport',
            'Musical instruments',
            'Videogame',
            
        ];
		
		$categoriesDe = 
        [
            'Kleidung',
            'Tiere',
            'Möbel',
            'Schmuck und Sonstiges',
            'Sammlerstücke',
            'Elektronik',
            'Gartenarbeit',
            'Bücher und Zeitschriften',
            'Uhren und Juwelen',
            'Eigenschaften',
            'Informatik',
            'Motoren',
            'Musik, CDs und Vinyls',
            'Sport',
            'Musikinstrumente',
            'Videospiele',
            
        ];

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
        for ($i=0; $i<count($categories); $i++)
        {
            Category::where('name', $categories[$i])->update(['name_en'=>$categoriesEn[$i],'name_de'=>$categoriesDe[$i]]);
            /* $category->name_en=$categoriesEn[$i];
            $category->name_de=$categoriesDe[$i];
            $category->save(); */
            //(['name_en'=>$categoriesEn[$i],'name_de'=>$categoriesDe[$i]])->where('name', $categories[$i]);
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
		Schema::dropIfExists('categories');
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('name_en');
            $table->dropColumn('name_de');
        });
    }
};
