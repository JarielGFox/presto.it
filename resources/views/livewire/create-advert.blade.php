<div class="advert-form">
    <div class="advert-form-card">
        <div class="card text-center rounded">
            <div>
                <h1>{{__('adverts.createTitleOne')}}</h1>
            </div>
    
            <form wire:submit.prevent="store">
                @if (session()->has('message'))
                <div class="flex flex-row justify-center my-2 alert alert-success shadow">
                    {{ session('message')}}
                </div>
                @endif
    
                <div class="card-body mb-3" style="width: 30wh;">
    
                    <label for="title">{{__('adverts.createTitleAdv')}}</label>
                    <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                    {{$message}}
                    @enderror
    
                    <div class="col-6 mx-auto dropdown-container">
                        <label for="category">{{__('adverts.createCategoryT')}}</label>
                            <select wire:model.defer="category" id="category" class="form-check">
                                <option value="">{{__('adverts.createCategorySel')}}</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">
                            @if (Lang::locale()=='it') {{$category->name }}
                            @elseif (Lang::locale()=='en') {{ $category->name_en }}
                            @elseif (Lang::locale()=='de') {{ $category->name_de }}
                            @endif
                        </option>
                        @endforeach
                        </select>
                    </div>
    
                    <div class="mb-3">
                        <label for="body">{{__('adverts.createDescription')}}</label>
                        <textarea wire:model="body" type="text"
                            class="form-control mt-2 @error('body') is-invalid @enderror" rows="6" cols="50"></textarea>
                        @error('body')
                        {{$message}}
                        @enderror
                    </div>

                    <div class="col-6 mx-auto dropdown-container">
                        <label for="typology">Condizione</label>
                        <select wire:model.defer="typology" id="typology" class="form-check">
                            <option value="1">Nuovo</option>
                            <option value="2">Usato</option>
                            <option value="3">Altro</option>
                        </select>
                    </div>
    
                    <div class="mb-3">
                        <label for="price">{{__('adverts.createPrice')}}</label>
                        <input wire:model="price" type="number" min="0" step="0.01"
                            class="form-control @error('price') is-invalid @enderror">
                        @error('price')
                        {{$message}}
                        @enderror
                    </div>
    
                    <div class="my-3">
                        <input wire:model="temporary_images" type="file" name="images" multiple
                            class="form-control shadow @error('temporary_images.*') is-invalid @enderror"
                            placeholder="Img" />
                        @error('temporary_images.*')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
    
                    @if(!empty($images))
                    <div class="row">
                        <div class="col-12">
                            <p>Picture preview:</p>
                            <div class="row border border-4 border-warning rounded shadow py-3">
                                @foreach ($images as $key => $image)
                                <div class="col my-3">
                                    <div class="img-preview mx-auto shadow rounded"
                                        style="background-image: url({{$image->temporaryUrl()}});">
                                    </div>
                                    <button type="button" class="btn btn-danger shadow d-block text-center mt-2 mx-auto"
                                        wire:click="removeImage({{$key}})">{{__('adverts.createCancel')}}
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
    
                    <div class="advert-div">
                        <button type="submit" class="btn advert-button"
                            id="create-advert">{{__('adverts.createInsert')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="octagon">
    @section('style')
    .octagon {
        position: fixed;
        top: 500px;
        left: -110px;
        width: 95vh;
        height: 90vh;
        background-color: #a9d3d3;
        clip-path: polygon(0% 0%, 31.25% 0%, 68.75% 0%, 100% 31.25%, 100% 68.75%, 68.75% 100%, 31.25% 100%, 0% 68.75%);
        z-index: -100;
    }
    @endsection
</div>
