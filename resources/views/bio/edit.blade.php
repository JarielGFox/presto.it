<x-main>

    <div class="container py-3 edit-bio">
        <form action="{{route('bio.update', $user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf

            @method('PUT')

            @if($errors->all())
            <div class="alert alert-danger mt-5">
                @foreach ($errors->all() as $error)
                <span>{{$error}}</span><br>
                @endforeach
            </div>
            @endif

            <div class="title mb-4">
                <h2>Modifica Biografia</h2>
            </div>
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input class="form-control @error ('first_name') is-invalid @enderror" type="text" placeholder="nome personale"
                    name="first_name" maxlength="100" value="{{old('first_name', $user->first_name)}}" />
                @error('first_name') <span class="text-danger small">{{$message}}</span>@enderror
            </div>

            <!--  -->
            <div class="mb-3">
                <label class="form-label">Cognome</label>
                <input class="form-control  @error ('surname') is-invalid @enderror" type="text" placeholder="cognome"
                    name="surname" maxlength="100" value="{{old('surname', $user->surname)}}" />
                @error('surname') <span class="text-danger small">{{$message}}</span>@enderror
            </div>

            <!--  -->
            <div class="mb-3">
                <label class="form-label">Data di Nascita</label>
                <input class="form-control  @error ('date_of_birth') is-invalid @enderror" type="date"
                    placeholder="data di nascita" name="date_of_birth" maxlength="100"
                    value="{{old('date_of_birth', $user->date_of_birth)}}" />
                @error('date_of_birth') <span class="text-danger small">{{$message}}</span>@enderror
            </div>

            <!--  -->
            <div class="mb-3">
                <label class="form-label">Nazione</label>
                <input class="form-control  @error ('country') is-invalid @enderror" type="text" placeholder="nazione"
                    name="country" maxlength="100" value="{{old('country', $user->country)}}" />
                @error('country') <span class="text-danger small">{{$message}}</span>@enderror
            </div>

            <!-- -->
            <div class="mb-3">
                <label class="form-label">Indirizzo:</label>
                <textarea class="form-control @error ('address') is-invalid @enderror" type="text" placeholder="scrivi indirizzo" style="height: 10rem;" name="address" maxlength="5000">{{old('address', $user->address)}}</textarea>
                @error('address') <span class="text-danger small">{{$message}}</span>@enderror
            </div>

                <!-- -->
                <div class="mb-3">
                    <label class="form-label">Biografia</label>
                    <textarea class="form-control @error ('biography') is-invalid @enderror" type="text"
                        placeholder="scrivi qualche riga su di te" style="height: 10rem;" name="biography"
                        maxlength="5000">{{old('biography', $user->biography)}}</textarea>
                    @error('biography') <span class="text-danger small">{{$message}}</span>@enderror
                </div>
                <!--  -->
                {{-- <div class="mb-3">
                    <label for="image" class="form-label">Immagine</label>
                    <input type="file" name="image" id="image">
                    @if ($article->image)
                    <img src="{{ asset('storage/'.$article->image) }}" alt="Current Image">
                    @endif
                </div> --}}


                <div class="edit-btn">
                    <button class="btn advert-button" type="submit">Modifica</button>
                </div>

        </form>

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