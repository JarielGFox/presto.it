<x-main>
    <div class="container category-container">
        <div class="row">
            <div class="col-12 lista-annunci">
                <h3><u>{{__('adverts.categoryTitle')}} <span class="text-warning"> {{ $category->name }}</span></u></h3>
            </div>
        </div>
    </div>

        <div class="container-md category-container">
            @php $isEmpty= true @endphp
                @foreach ($category->adverts as $advert)
                    @if  ($advert->is_accepted)
                        @php $isEmpty= false @endphp
                        <div class="row my-3 mx-2">
                            <div class="card" data-aos="fade-up" data-aos-anchor-placement="center-bottom" style="min-width: 18rem;">

                                <div class="col-12 p-2">
                                    @php
                                    $firstImage = $advert->images->first();
                                    $imageUrl = $firstImage ? Storage::url($firstImage->path) : 'https://picsum.photos/400/400';
                                    @endphp
                                    <img src="{{ $imageUrl }}" class="img-fluid rounded carousel-img border border-dark border-2" alt="...">
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{$advert['title']}}</h5>
                                    <p class="card-text">{{__('adverts.categoryCategory')}} <span class="text-danger">
                                    @if (Lang::locale()=='it')  {{ $advert->category->name }}
                                    @elseif (Lang::locale()=='en') {{ $advert->category->name_en }}
                                    @elseif (Lang::locale()=='de') {{ $advert->category->name_de }}  
                                    @endif
                                    </span></p>
                                    <p class="card-text">{{__('adverts.categoryPrice')}} <span class="text-danger"> {{ $advert['price'] }} €</span></p>
                                    <center><a href="{{ route('adv-detail', ['id' => $advert['id']]) }}"
                                    class="btn btn-dark bg-primary mt-2">{{__('adverts.categoryDetails')}}</a></center>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if ($isEmpty)
                    <div class="container category-container">
                        <div class="row">
                            <div class="col-12 announce-category">
                                <p class="lead">{{__('adverts.categoryEmpty')}}<b>{{ $category->name }}</b></p>
                                <button class="btn advert-button" type="submit"><a href="{{ route('adverts.create') }}">{{__('adverts.categoryInsert')}}</a></button>
                            </div>
                        </div>
                    </div>
                @endif 
        </div>
    <div class="octagon"></div>
    @section('style')
        .octagon {
            position: fixed;
            top: 300px;
            left: -110px;
            width: 95vh;
            height: 90vh;
            background-color: #ecbc2e;
            clip-path: polygon(0% 0%, 31.25% 0%, 68.75% 0%, 100% 31.25%, 100% 68.75%, 68.75% 100%, 31.25% 100%, 0% 68.75%);
            z-index: -100;
        }
    @endsection
</x-main>