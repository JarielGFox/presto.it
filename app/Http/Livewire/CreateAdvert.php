<?php

namespace App\Http\Livewire;

use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use Livewire\Component;
use App\Models\Advert;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CreateAdvert extends Component
{
    use WithFileUploads;

    public $title;
    public $body;
    public $price;
    public $category;
    public $message;
    public $validated;
    public $temporary_images;
    public $images = [];
    public $image;
    public $form_id;
    public $advert;

    protected $rules = [
        'title' => 'required|min:4',
        'body' => 'required|min:8',
        'price' => 'required|numeric|min:1',
        'category' => 'required',
        'images.*' => 'image|max:8024',
        'temporary_images.*' => 'image|max:8024'
    ];

    public function messages()
    {
        return [
            'required'                     => __('messages.required'),
            'title.min'                 => __('messages.title.min'),
            'body.min'                     => __('messages.body.min'),
            'price.min'                 => __('messages.price.min'),
            'numeric'                     => __('messages.numeric'),
            'temporary_images.required' => __('messages.temporary_images.required'),
            'temporary_images.*.image'     => __('messages.temporary_images.*.image'),
            'temporary_images.*.max'     => __('messages.temporary_images.*.max'),
            'temporary_images.*.max'     => __('messages.images.im'),
            'images.max'                 => __('messages.images.max'),

        ];
    }

    /*      protected $messages =
    [
        'required' => 'Il campo :attribute è richiesto',
        'title.min' => 'Il campo :attribute è troppo corto',
        'body.min' => 'Il campo :attribute è troppo corto',
        'price.min' => 'Il valore deve essere superiore a 1',
        'numeric' => 'Il campo :attribute deve essere un numero',
        'temporary_images.required' => 'L\'immagine è richiesta',
        'temporary_images.*.image' => 'I file devono essere delle immagini',
        'temporary_images.*.max' => 'Il peso delle immagini è di massimo 8MB',
        'images.image' => 'L\'immagine selezionata deve essere di un tipo immagine valido',
        'images.max' => 'L\'immagine selezionata deve essere di massimo 8MB'
    ];  */

    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporary_images.*' => 'image|max:8024',
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }

    public function store()
    {
        $this->validate();

        $category = Category::find($this->category);
        $this->advert = $category->adverts()->create([
            'title' => $this->title,
            'body' => $this->body,
            'price' => $this->price,
            'category_id' => $this->category,
        ]);

        if (count($this->images)) {
            foreach ($this->images as $image) {
                // $this->advert->images()->create(['path' => $image->store('images', 'public')]);
                $newFileName = "adverts/{$this->advert->id}";
                $newImage = $this->advert->images()->create(['path' => $image->store($newFileName, 'public')]);

                // runniamo job

                RemoveFaces::withChain([
                    new ResizeImage($newImage->path , 400, 350),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id)
                ])->dispatch($newImage->id);
            }

            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        session()->flash('message', 'Inserzione inserita con succeso. Attendi che venga revisionata!');
        $this->cleanForm();

        $this->advert->user()->associate(Auth::user());
        $this->advert->save();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function cleanForm() // pulisce il form dopo l'inserimento dell'inserzione
    {
        $this->title = '';
        $this->body = '';
        $this->price = '';
        $this->category = '';
        $this->image = '';
        $this->images = [];
        $this->temporary_images = [];
        $this->form_id = rand();
    }

    public function create()
    {
        return view('adverts.create');
    }

    public function render()
    {
        return view('livewire.create-advert');
    }
}
