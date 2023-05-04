<x-main>

  <div class="container category-container pb-2" id="back-btn">
    <div class="row">
      <a href="{{route('show-adverts')}}" class="btn advert-button">{{__('adverts.advReturnBTN')}}</a>
    </div>
  </div>

  <div class="container-md card mt-2 shadow-lg" id="adv-detail">
    <div class="row">
      <div class="col-12">
        <div id="carouselDark-{{ $advert->id }}" class="carousel carousel-dark slide" data-bs-interval="false">
          <div class="carousel-indicators">
            @foreach ($advert->images as $image)
            <button type="button" data-bs-target="#carouselDark-{{ $advert->id }}" data-bs-slide-to="{{$loop->index}}"
              class="{{$loop->first ? 'active' : ''}}" aria-label="Slide {{$loop->iteration}}"></button>
            @endforeach
          </div>
          <div class="carousel-inner">
            @forelse ($advert->images as $image)
            <div class="carousel-item {{$loop->first ? 'active' : ''}}">
              <img src="{{$image->getUrl(400, 350)}}" class="img-fluid rounded carousel-img" alt="...">
            </div>
            @empty
            <div class="carousel-item active">
              <img src="https://picsum.photos/400/400" class="card-img-top carousel-img" alt="...">
            </div>
            <div class="carousel-item">
              <img src="https://picsum.photos/400/400" class="card-img-top carousel-img" alt="...">
            </div>
            @endforelse
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselDark-{{ $advert->id }}"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselDark-{{ $advert->id }}"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card-body">
          <h3 class="card-title text-center my-2">{{ $advert['title'] }}</h3>
          <p class="card-title text-center mt-2"><span class="text-danger">{{__('adverts.advDetcategories')}}</span>
             @if (Lang::locale()=='it' ){{$advert->category['name']}}
                @elseif (Lang::locale()=='en'){{$advert->category['name_en']}}
                @elseif (Lang::locale()=='de'){{$advert->category['name_de']}}
                @endif
          </p>
          <p class="text-center border-end my-2"><span class="text-danger">{{__('adverts.advDescription')}}</span> {{
            $advert['body'] }}</p>
          <p class="text-center border-end my-2"><span class="text-danger">{{__('adverts.advPrice')}}</span> {{
            $advert['price'] }} €</p>
        </div>
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
  @endsection
</x-main>