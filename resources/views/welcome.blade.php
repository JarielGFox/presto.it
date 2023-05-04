<x-main>

    <div class="homepage">
            
            <div class="container homepage-carousel">
                <div class="row">
                    <div class="col-6 home-text">
                       <h1>{{__('welcome.titleOne')}}</h1>
                        <a class="btn" href="{{route('show-adverts')}}">{{__('welcome.allAdverts')}}</a>
                    </div>
                    
                    <div class="col-6">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @if($randomImages->count() > 0)
                                @foreach($randomImages as $image)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="...">
                                </div>
                                @endforeach
                                @else
                                <div class="carousel-item active">
                                    <img src="https://picsum.photos/400/350" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://loremflickr.com/400/350" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://via.placeholder.com/400x350" class="d-block w-100" alt="...">
                                </div>
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>  

            <div class="homepage-element">
                <div class="container">
                    <div class="row">
                        <div class="col-6 homepage-element-text">
                            <h1>{{ __('welcome.titleTwo') }}</h1>
                            <a class="btn" href="{{ route('adverts.create') }}">{{ __('welcome.insertAdvert') }}</a>
                         </div>
                        <div class="col-6 search">
                            <div class="search-bar">
                                <form action="{{route('adverts.search')}}" method="GET" class="search-form d-flex" id="navbar-search-form">
                                    <input name="searched" class="form-control ms-1 me-2" type="search" placeholder="{{__('nav.placeSearch')}}" aria-label="Search">
                                    <button class="btn sm search-button" type="submit">{{__('nav.Search')}}</button>
                                </form>
                            </div>
                            <h1>{{ __('welcome.titleThree') }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="homepage-element-2">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            
                            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
                                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
                                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://picsum.photos/1270/300" class="" alt="Slide 1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://picsum.photos/1271/300" class="" alt="Slide 2">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://picsum.photos/1273/300" class="" alt="Slide 3">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-main>
