<x-main>

    @if (session('message'))
    <div class="alert alert-warning" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <h1 class="text-center my-5 text-secondary">File Not Found! MIAOOOO!</h1>

    <center>
        <picture>
            <source srcset="https://thumbs.gfycat.com/AccurateBadBoilweevil.webp" type="image/webp"><img
                class="image media" id="image-accuratebadboilweevil"
                alt="transparent sticker pixel art pastel kawaii cat animated GIF"
                src="https://thumbs.gfycat.com/AccurateBadBoilweevil-size_restricted.gif" height="456" width="500"
                style="max-width: 500px;">
        </picture>
    </center>

</x-main>
