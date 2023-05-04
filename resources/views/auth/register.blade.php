<x-main>
<div class="login-container">
    <div class="advert-form" id="register-form">
        <div class="col-4">
            <div class="card text-center rounded" id="color-card">
                <h1 class="card-title mt-3 ">{{__('auth.authRegister')}}</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="col-12">
                            <label class="form-label " for="name">{{__('auth.authUser')}}</label>
                            <input type="text" name="name" id="name" class="form-control">
                            @error ('name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-2 mt-2">
                            <label for="email">E-mail</label>
                            <input type="text" name="email" id="email" class="form-control">
                            @error ('email') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-2 mt-2">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error ('password') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-2 mt-2">
                            <label for="password_confirmation">{{__('auth.authConfPwd')}}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            @error ('password_confirmation') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        </div>  
                        <div class="row">
                            <div class="advert-div">
                                <button type="submit" class="btn advert-button" id="register">{{__('auth.authRegister')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
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