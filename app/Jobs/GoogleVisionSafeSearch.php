<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionSafeSearch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $advert_image_id;

    /**
     * Create a new job instance.
     */
    public function __construct($advert_image_id)
    {
        $this->advert_image_id = $advert_image_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $i = Image::find($this->advert_image_id);

        if (!$i) { // se l'immagine non esiste terminiamo l'esecuzione del job siccome ritorna nada
            return;
        }

        $image = file_get_contents(storage_path('app/public/' . $i->path));

        // Imposta la variabile di ambiente GOOGLE_APPLICATION_CREDENTIALS al path del json delle credenziali

        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->safeSearchDetection($image);
        $imageAnnotator->close(); // dopo aver recuperato l'immagine, chiudiamo collegamento con Google

        $safe = $response->getSafeSearchAnnotation(); // recuperiamo response della SafeSearchAnnotation

        $adult = $safe->getAdult();
        $medical = $safe->getMedical();
        $spoof = $safe->getSpoof();
        $violence = $safe->getViolence();
        $racy = $safe->getRacy();

        $likelihoodName = [ // array di classi bootstrap per "giudicare" contenuto immagine
            'text-secondary fas fa-circle', 'text-success fas fa-circle', 'text-success fas fa-circle',
            'text-warning fas fa-circle', 'text-warning fas fa-circle', 'text-danger fas fa-circle'
        ];

        $i->adult = $likelihoodName[$adult];
        $i->medical = $likelihoodName[$medical];
        $i->spoof = $likelihoodName[$spoof];
        $i->violence = $likelihoodName[$violence];
        $i->racy = $likelihoodName[$racy];

        $i->save();
    }
}
