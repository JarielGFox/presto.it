<x-main>

    <div class="container mt-5">
        <form action="/reset-password" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <div class="row">
                <div class="col-12">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" value="{{ request()->email}}">
                    <p> @error ('email') <span class="text-danger">{{$message}}</span> @enderror </p>
                </div>
                
                <div class="col-12">
                    <label for="password">Nuova password</label>
                    <input type="password" name="password" id="password">
                    <p> @error ('password') <span class="text-danger">{{$message}}</span> @enderror </p>
                </div>

                <div class="col-12">
                    <label for="password_confirmation">Conferma nuova password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                    <p> @error ('password_confirmation') <span class="text-danger">{{$message}}</span> @enderror </p>
                </div>

                <div class="col-12">
                    <button class="btn btn-success" type="submit">Modifica password</button>
                </div>
            </div>    
        </form>
    </div>

</x-main>