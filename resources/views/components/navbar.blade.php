<nav class="main-nav navbar navbar-expand-xl" id="main-navbar">
    <div class="container">
        <div class="dropdown">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <a href="{{route('home')}}" class="navbar-brand"><img src="/LogoPresto.png" style="max-width: 112px;" id="imgID"></a> 
        
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            
            <ul class="nav navbar-link" id="nav-link">
                <li id="annunci"><a class="anchor" href="{{route('show-adverts')}}"><p class="hoverable">{{__('nav.Adverts')}}</p></a></li>
                <li id="inserisci"><a class="anchor" href="{{ route('adverts.create') }}"><p class="hoverable">{{__('nav.insertAdvert')}}</p></a></li>
                <li id="categorie">
                    <div class="dropdown">
                        <a class="dropdown-toggle anchor" data-bs-toggle="dropdown" aria-expanded="false"><p class="hoverable">{{__('nav.Categories')}}</p></a>
                        <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                        <li><a class="dropdown-item" 
                            href="{{route('categoryShow', compact('category'))}}" id="categoriesMenu">
                            {{-- {{$category['name']}} --}}
                        @if (Lang::locale()=='it'){{$category['name']}}
                        @elseif (Lang::locale()=='en'){{$category['name_en']}}
                        @elseif (Lang::locale()=='de'){{$category['name_de']}}
                        @endif 
                        </a>
                        
                        </li>
                        @endforeach
                        </ul>
                    </div>
                

                @if (Auth::check() && Auth::user()->role >= 1 && Auth::user()->role <= 5)
                    <li>    
                        <a class="anchor" href="{{ route('panel-index') }}"><p class="hoverable">Area Staff</p> 
                            <span class="badge rounded-pill bg-danger">
                                {{ App\Models\Advert::toBeReviewedCount() }}
                                <span class="visually-hidden"> unread messages</span>
                            </span>
                        </a>
                    </li>
                @endif

            </ul>   

            
            <form action="{{route('adverts.search')}}" method="GET" class="search-form d-flex" id="navbar-search-form">
                <input name="searched" class="form-control ms-1 me-2" type="search" placeholder="{{__('nav.placeSearch')}}" aria-label="Search">
                <button class="btn sm search-button" type="submit">{{__('nav.Search')}}</button>
            </form>
            
    
            <ul class="navbar-nav nav-item-language">
                <div class="dropdown">
                    <a class="btn dropdown-toggle text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                        id="lingue">
                        <span class="bi bi-globe-americas"> LAN </span>
                    </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item">
                            <x-_locale lang="it" nation='it' />
                        </a>
                        <a class="dropdown-item">
                            <x-_locale lang='en' nation='en' />
                        </a>
                        <a class="dropdown-item">
                            <x-_locale lang='de' nation='de' />
                        </a>
                    </ul>
                </div>
            </ul>

            @auth
            <ul class="logout-button navbar-nav" id="logout">
                <div class="dropdown">
                    <a class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <form id="account-form" action="{{ route('account') }}" method="GET">
                            @csrf
                            <li>
                                <a class="dropdown-item" href="{{ route('account') }}"
                                    onclick="event.preventDefault(); document.getElementById('account-form').submit();">
                                    Account
                                </a>
                            </li>
                        </form>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </form>
                    </ul>
                </div>
            </ul>
            

            
            @else
            <div class="access-buttons">
                <ul class="nav navbar-link">
                    <li class="mx-2">
                        <a class="btn" href="/login" >{{__('nav.signIn')}}</a>
                        <a class="btn" href="/register">{{__('nav.Register')}}</a>
                    </li>
                </ul>
            </div>   
            @endauth
        </div>
    </li>

    </div>
</nav>