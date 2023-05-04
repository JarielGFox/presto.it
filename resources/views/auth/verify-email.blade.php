<x-main>

<div class="container email-verify">
    <div>
        {{__('auth.verH1a')}}

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-danger">
                {{__('auth.verH1b')}} <br/>
                {{__('auth.verH1c')}}
            </div>
        @endif

        <br />
        <br />
        {{__('auth.verNoMail')}} 
        <br />
        <br />
        <form action="/email/verification-notification" method="POST">
            @csrf
            <button class="btn advert-button">{{__('auth.verMailNew')}}</button>
        </form>
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
</x-main>