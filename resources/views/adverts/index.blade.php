@php
    use Illuminate\Support\Str;
@endphp

<x-main>

    <div class="text-center lista-annunci">
        <h3><u>{{__('adverts.listAdv')}}</u></h3>
    </div>


    <div class="d-flex flex-start flex-wrap w-100">
        <div class="container-adv">

        @forelse ($adverts as $advert)
    
    
            <article class="card-adv" data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                <div class="temporary_text">
                <img src="{{!$advert->images()->get()->isEmpty() ? $advert->images()->first()->getUrl(400, 350) : 'https://picsum.photos/400/400'}}" class="img-fluid mx-auto d-block" alt="">
            </div>
            <div class="card_content-adv">
                <div class="card_content-adv2">
                <center>
                    <span class="card_title-adv mb-2">{{ $advert['title'] }}</span>
                    <span class="
                                                                    @if ($advert['typology'] === 1)
                                                                        badge bg-primary bg-gradient rounded-pill mt-2
                                                                    @elseif ($advert['typology'] === 2)
                                                                        badge bg-danger bg-gradient rounded-pill 
                                                                    @elseif ($advert['typology'] === 3)
                                                                        badge bg-secondary bg-gradient rounded-pill
                                                                    @endif
                                                                ">
                        @if ($advert['typology'] === 1)
                        Nuovo
                        @elseif ($advert['typology'] === 2)
                        Usato
                        @elseif ($advert['typology'] === 3)
                        Altro
                        @endif
                    </span>
                </center>

                <center><span class="card_subtitle-adv">{{ $advert['price'] }}€</span></center>
               
                <center>
                    <p class="card-text">{{__('adverts.categories')}} 
                    @if (Lang::locale()=='it'){{$advert->category['name']}}
                    @elseif (Lang::locale()=='en'){{$advert->category['name_en']}}
                    @elseif (Lang::locale()=='de'){{$advert->category['name_de']}}
                    @endif 
                    </p>
                </center>
                <center><p class="card_description-adv ms-3 me-3">{{ Str::limit($advert['body'], 28) }}</p></center>
                <center><a href="{{ route('adv-detail', ['id' => $advert['id']]) }}" class="btn advert-button">{{__('adverts.details')}}</a></center>
            </div>
            </div>
            </article>   
        
        @empty
            <div class="col-12">
                <div class="alert alert-warning py-3 shadow">
                    <p class="lead">{{__('adverts.noAdv')}}</p>
                </div>
            </div>
        @endforelse
    </div>
    </div>

    <div class="title p-5">
        {{$adverts->links()}}
    </div>
    
    <div class="octagon"></div>
    @section('style')
        .octagon {
            position: fixed;
            top: 300px;
            left: -110px;
            width: 95vh;
            height: 90vh;
            background-color: #df85b2;
            clip-path: polygon(0% 0%, 31.25% 0%, 68.75% 0%, 100% 31.25%, 100% 68.75%, 68.75% 100%, 31.25% 100%, 0% 68.75%);
            z-index: -100;
        }
    @endsection
</x-main>


{{-- JS DA UTILIZZARE IN CASO CI SERVE. Filtri fatti tutti in JS --}}

{{-- <header class="container-fluid header-title">
    <h1 class="header-content text-center">Cerca tra i nostri <span class="green-text">Annunci</span></h1>
</header>

<div class="container" id="filtri-annunci">
    <div class="row col-md-12">
        <div class="col-6 col-md-12">
            <div>
                <div class="col-6 col-md-3">
                    <input type="text" class="form-control" id="input-ricerca-libera" placeholder="ricerca libera"
                        required />
                </div>
            </div>
        </div>
        <div class="filter-options">
            <div class="col-2 col-md-2">

            </div>
            <select id="sort-select">
                <option value="no-sort">Ordine di Ricerca</option>
                <option value="a-alla-z">Dalla A alla Z</option>
                <option value="z-alla-a">Dalla Z alla A</option>
                <option value="more-expensive">Più costoso</option>
                <option value="less-expensive">Meno costoso</option>
                <option value="older">Più vecchio</option>
                <option value="newer">Più recente</option>
            </select>
            <label for="category-search"></label>
            <select id="category-search">
                <option value="" id="no-category">Categorie:</option>
            </select>
            <label for="min-price"></label>
            <input type="number" id="min-price" placeholder="prezzo min">

            <label for="max-price"></label>
            <input type="number" id="max-price" placeholder="prezzo max">
            <button type="button" class="btn btn-dark" id="cerca-btn">Search</button>
        </div>
    </div>
</div>

<section class="container mt-5">
    <div class="row" id="elenco-annunci">

    </div>
</section> --}}


{{-- <div class="col-12 col-md-2 custom-col">
    <div class="card" data-aos="fade-up" data-aos-anchor-placement="center-bottom" style="min-width: 18rem;">
        <div class="card-img-top">
            <img src="{{!$advert->images()->get()->isEmpty() ? $advert->images()->first()->getUrl(300,300) : 'https://picsum.photos/400/400'}}"
                class="card-img-top" alt="...">
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $advert['title'] }}</h5>
            <p class="card-text">{{__('adverts.categories')}} {{ $advert->category->name }} </p>
            <p class="card-text">{{__('adverts.price')}} {{ $advert['price'] }} €</p> --}}
            {{-- <p class="card-text">Descrizione: {{ $advert['body'] }}</p> --}}
            {{-- <center><a href="{{ route('adv-detail', ['id' => $advert['id']]) }}"
                    class="btn advert-button">{{__('adverts.details')}}</a></center>
        </div>
    </div> --}}


{{-- <script src="/js/script.js"></script>

<script src="/js/utils/renders.js"></script>
<script src="/js/utils/filter.js"></script>
<script src="/js/utils/sort.js"></script>
<script src="/js/adverts.js"></script> --}}