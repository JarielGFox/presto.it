<x-main>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container-md">
        <div class="row">
            <div class="col-12 account-card">
                {{-- <h1>{{__('auth.authWelcome')}} {{auth()->user()->name}}</h1> --}}

                <div class="nav-button">
                    <ul class="nav nav-tabs other card-header-tabs">                    
                        <li class="nav-item">
                            <a class="nav-link active text-center" aria-current="true" href="#" data-target="#tab1"><i class="bi bi-person"></i></a>
                        </li>
                        <li class="nav-item other">
                            <a class="nav-link text-center" href="#" data-target="#tab2"><i class="bi bi-star"></i></a>
                        </li>
                        <li class="nav-item other">
                            <a class="nav-link text-center" href="#" data-target="#tab3"><i class="bi bi-bag"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="account-content">
                        <div class="user-card profile-pic"> 
                            <img src="{{auth()->user()->profilepic ? auth()->user()->profilepic : 'https://picsum.photos/200/200'}}" class="card-img-top" alt="...">
                        </div>
                        <a class="d-flex justify-content-end pic-changer" onclick="uploadImage();">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <h5 class="card-title"> {{__('auth.authWelcome')}} <span class="text-danger">{{auth()->user()->name}}</span></h5>
                        <div class="card-body data other" id="tab1">
                            <p class="card-text lh-sm"> {{__('account.Email')}} <span class="text-primary"><u>{{ auth()->user()->email }} </u></span> </p>
                            <p class="card-text lh-sm"> {{__('account.Name')}} <span class="text-danger">{{ auth()->user()->first_name }} </span> </p>
                            <p class="card-text lh-sm"> {{__('account.Surname')}} <span class="text-danger">{{ auth()->user()->surname }} </span> </p>
                            <p class="card-text lh-sm"> {{__('account.DateBirth')}} <span class="text-danger">{{ auth()->user()->date_of_birth }} </span> </p>
                            <p class="card-text lh-sm"> {{__('account.Nation')}} <span class="text-danger">{{ auth()->user()->country }} </span> </p>
                            <p class="card-text lh-sm"> {{__('account.Address')}} <span class="text-success">{{ auth()->user()->address }} </span> </p>
                            <p class="card-text lh-sm"> {{__('account.Biography')}} <span class="text-secondary">{{ auth()->user()->biography }} </span> </p>

                            <center><span class="">
                                <a href="{{route('bio.edit', auth()->user()->id)}}" class="btn">{{__('account.Edit')}}</a>
                            </span></center>
                        </div>
                        

                        <div class="card-body" id="tab2">
                            @php
                            $approvedAdvertsCount = \App\Http\Controllers\AdvertController::approvedAdvertsCount(auth()->user()->id);
                            $stars = 0;
                            
                            if ($approvedAdvertsCount >= 20) {
                            $stars = 5;
                            } elseif ($approvedAdvertsCount >= 15) {
                            $stars = 4;
                            } elseif ($approvedAdvertsCount >= 10) {
                            $stars = 3;
                            } elseif ($approvedAdvertsCount >= 6) {
                            $stars = 2;
                            } elseif ($approvedAdvertsCount >= 3) {
                            $stars = 1;
                            }
                            @endphp
                            
                           <p class="card-text text-center">Questo utente ha inserito <span class="text-danger"> {{ $approvedAdvertsCount }}</span> annunci</p>

                            <p class="card-text text-center"> Fidelity Rank:
                            @for ($i = 0; $i < $stars; $i++) <i class="bi bi-star-fill"></i>
                                @endfor
                            
                                @for ($i = 0; $i < (5 - $stars); $i++) <i class="bi bi-star"></i>
                                    @endfor
                            </p>        
                        </div>

                        <div class="card-body" id="tab3">
                            @php
                            $lastApprovedAdverts = \App\Http\Controllers\AdvertController::lastApprovedAdverts(auth()->user()->id);
                            @endphp

                            <h5 class="card-text text-center">Ultimi annunci inseriti:</h5>
                            <ul class="list-group list-group-flush">
                                @forelse ($lastApprovedAdverts as $advert)
                                <li class="list-group-item">
                                    <div class="border border-1 border-dark rounded text-center">
                                        <strong class="text-success">Titolo:</strong> <span class="text-danger"> {{ $advert->title }}</span> <br>
                                        <strong class="text-success">Categoria:</strong> <span class="text-danger">{{ $advert->category->name }} </span>
                                    </div>    
                                </li>
                                @empty
                                <li class="list-group-item text-center text-bg-danger rounded-pill"> Non sono stati trovati annunci.</li>
                                @endforelse
                            </ul>

                        </div>

                    </div>
                </div>

                <a href="{{ route('adverts.create') }}" class="btn advert-button" id="inserisci-annuncio">{{__('nav.insertAdvert')}}</a>
            </div>
        </div>
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

        .card-body {
        display: none !important;
        }
        
        .card-body.data {
        display: block !important;
        }
    @endsection

<form class="d-none" action="{{route('store-pic', ['id' => auth()->user()->id])}}" method="POST" enctype="multipart/form-data" id="file_form">
    @csrf   
    <input type="file" name="profilepic" id="file_input" accept="image/*"/>
</form>
<script>
// Cambio immagine profilo

const fileInput = document.getElementById('file_input');
fileInput.addEventListener("change", handleFiles, false);

function handleFiles() {
    document.getElementById('file_form').submit();
}

function uploadImage() {
    fileInput.click();
}

// Cambio tab account
const navLinks = document.querySelectorAll('.nav-link');

navLinks.forEach((navLink) => {
navLink.addEventListener('click', (event) => {
event.preventDefault();

// Remove active class from all nav-links
navLinks.forEach((link) => {
link.classList.remove('active');
link.classList.add('other'); // Add 'other' class to non-selected tabs
});

// Add active class to the clicked nav-link
navLink.classList.add('active');
navLink.classList.remove('other'); // Remove 'other' class from selected tab

// Hide all tab panes
const tabPanes = document.querySelectorAll('.card-body');
tabPanes.forEach((pane) => {
pane.classList.remove('other', 'data');
});

// Show the clicked tab pane
const targetPane = document.querySelector(navLink.dataset.target);
targetPane.classList.add('data', 'other');
});
});

</script>

</x-main>