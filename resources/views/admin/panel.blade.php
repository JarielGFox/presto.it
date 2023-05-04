<x-main>

    {{-- da mettere nel CSS --}}

    <style> 
        .carousel-image {
        max-height: 300px;
        max-width: 300px;
        object-fit: contain;
        }
    </style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-light p-5">
            <h1 class="display-5 text-dark">
                {{ $adverts_to_check_count > 0 ? __('adverts.revHave') . $adverts_to_check_count . __('adverts.revToRev') : __('adverts.revNoTo') }}

            </h1>
        </div>
    </div>


    @if ($adverts_to_check_count > 0)
    @foreach ($adverts_to_check as $advert_to_check)
    <div class="container card my-5 py-5 rounded">
        {{-- <div class="row d-flex align-items-start"> --}}
            <div class="col-12">
                <div id="showCarousel_{{ $advert_to_check->id }}" class="carousel slide" data-bs-target="carousel">
                    @if ($advert_to_check->images)
                        <div class="carousel-inner">
                            @foreach ($advert_to_check->images as $image)
                                <div class="carousel-item @if($loop->first)active @endif">
                                    <img src="{{Storage::url($image->path)}}" class="img-fluid border border-dark rounded carousel-image mx-auto d-block" alt="...">

                                    {{-- Inizio validazione contenuto immagine --}}
                                    
                                        <div class="col-12">
                                           <center> <h5 class="tc-accent mt-3">Tags</h5>
                                            <div class="p-2">
                                                @if ($image->labels)
                                                    @foreach ($image->labels as $label)
                                                        <p class="d-inline">{{$label}},</p>
                                                    @endforeach
                                                @endif
                                            </div></center>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <center><div class="card-body">
                                                <h5 class="tc-accent">{{__('adverts.revImg')}}</h5>
                                                <p>{{__('adverts.revAdults')}}<span class="{{$image->adult}}"></span></p>
                                                <p>{{__('adverts.revSat')}}<span class="{{$image->spoof}}"></span></p>
                                                <p>{{__('adverts.revMed')}}<span class="{{$image->medical}}"></span></p>
                                                <p>{{__('adverts.revViol')}}<span class="{{$image->violence}}"></span></p>
                                                <p>{{__('adverts.revRacy')}}<span class="{{$image->racy}}"></span></p>
                                            </div></center>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    @else
                    <div class="carousel-inner">
                        <div class="carousel-item">
                            <img src="https://picsum.photos/id/29/1200/400" class="img-fluid p-3 rounded" alt="...">
                        </div>

                        <div class="carousel-item">
                            <img src="https://picsum.photos/id/28/1200/400" class="img-fluid p-3 rounded" alt="...">
                        </div>

                        <div class="carousel-item active">
                            <img src="https://picsum.photos/id/27/1200/400" class="img-fluid p-3 rounded" alt="...">
                        </div>
                    </div>
                    @endif
                    <button class="carousel-control-prev" type="button" data-bs-target="#showCarousel_{{ $advert_to_check->id }}"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{__('adverts.revPrev')}}</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#showCarousel_{{ $advert_to_check->id }}"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{__('adverts.revFow')}}</span>
                    </button>
                </div>
                <div class="col-12 col-md-8 text-center mx-auto">
                    <h5 class="card-title text-danger mt-3">{{__('adverts.revTitle')}}{{ $advert_to_check->title }}</h5>
                    <p class="card-text text-secondary mt-3 mb-3"> {{__('adverts.advDescription')}}{{ $advert_to_check->body }} </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 mb-3">
                <form action="{{route('allow-advert', ['advert' => $advert_to_check])}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <center><button type="submit" class="btn btn-success shadow">{{__('adverts.revOK')}}</button></center>
                </form>     
            </div>
            
            <div class="col-12 col-md-6">
                <form action="{{route('refuse-advert', ['advert' => $advert_to_check])}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <center><button type="submit" class="btn btn-danger shadow">{{__('adverts.revKO')}}</button></center>
                </form>
            </div>
        </div>
        <p class="card-footer text-center">{{__('adverts.revIns')}} {{ $advert_to_check->created_at}}</p>
    </div>

    
    @endforeach
@endif



<div class="octagon"></div>
@section('style')
    .octagon {
        position: fixed;
        top: 300px;
        left: -110px;
        width: 95vh;
        height: 90vh;
        background-color: #eccec0;
        clip-path: polygon(0% 0%, 31.25% 0%, 68.75% 0%, 100% 31.25%, 100% 68.75%, 68.75% 100%, 31.25% 100%, 0% 68.75%);
        z-index: -100;
    }
@endsection
</x-main>
