<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Presto.it</title>

    <script>
        function showPW(){
            let inputPW = document.getElementById("myInput");
            if (inputPW.type === 'password'){
                inputPW.type = 'text';
            }
            else{
                inputPW.type = 'password';
            }
        }
        function changeImageColorOnScroll(scrollPixel, imgId) {
            window.addEventListener("scroll", function() {
            var img = document.getElementById(imgId);
            if (window.scrollY >= scrollPixel) {
                img.style.filter = "invert(100%)";
            } else {
            img.style.filter = "none";
            }
            });
            }
    </script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    
    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="icon" type="image/x-icon" href="/favicon.ico"/>

    <style>
        @yield('style');
    </style>
    
</head>

<body>
    
    <div class="page-container">
        <main class="content-wrap" id="main">
            <header class="header-area">
                <x-navbar>

                </x-navbar>
            </header>

           <div class="spacing"></div>          

            {{ $slot }}
            
        </main>

        <footer>
            
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <p>Copyright backEnd streetBoys &copy; 2023</p>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('contacts') }}">{{__('main.contactUS')}}</a>
                    </div>
                    @if (Auth::check() && Auth::user()->role < 1) 
                        <div class="col-4">     
                            <a href="{{route('become-reviser')}}">{{__('main.workWith')}}</a>
                        </div>
                    @endif
                </div>
            </div>

        </footer>

        <div class="color-filler"></div>

        @livewireScripts

    </div>

</body>


<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
  </script>
<script src="https://unpkg.com/typed.js@2.0.15/dist/typed.umd.js"> </script>
<script>
  var typed = new Typed('.auto-type', {
  strings: ["Vendi", "Inserisci Annunci", "Acquista", "Presto.it"],
  typeSpeed: 50,
  backSpeed: 45,
  loop:true
});
</script>

<script>
    changeImageColorOnScroll(10, "imgID");
</script>

</html>






<!-- Modal -->

<!-- Da usare se vogliamo modale JS Bootstrap -->

{{-- <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ATTENZIONE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                SEI SICURO DI VOLER CANCELLARE
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" id="confirm" class="btn btn-danger">Conferma</button>
            </div>
        </div>
    </div>
</div> --}}