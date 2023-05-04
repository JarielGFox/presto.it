<x-main>

<div class="container mt-5">
    @if (session('status'))
        <div class="mb-4 text text-danger">
            {{ session('status') }}
        </div>
</div>
@endif

<div class="mt-5">
    <div class="col-6">
        <div class="row-6">
            <form action="/forgot-password" method="POST">
                @csrf
                <input type="email" name="email" id="email">
                <p> @error ('email') <span class="text-danger">{{$message}}</span> @enderror </p>
                <button class="btn btn-danger" type="submit">Reset password</button>
            </form>
        </div>
    </div>        
</div>

</x-main>