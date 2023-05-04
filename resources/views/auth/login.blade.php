<x-main>

    <div class="container mt-5">
        @if (session('status'))
        <div class="mb-4 text text-danger">
            {{ session('status') }}
        </div>
    </div>
    @endif
<div class="login-container">
    <div class="advert-form">
        <div class="col-12">
            <div class="card text-center rounded" style="border: 0px;" id="color-card">
               <div>
                <h1 class="card-title mt-3">LOGIN</h1>
               </div>
                <form action="/login" method="POST">
                    @csrf
                <div class="card-body mb-3">
                    <label class="form-label mb-2">Email</label>

                        <input type="text" name="email" id="email" class="form-control" required>
                        @error ('email') <span class="text-danger">{{$message}}</span> @enderror
                    
                    <label class="form-label mb-2 mt-2">Password</label>
                    
                    <input type="password" name="password" id="myInput" class="form-control" required>
                    <input type="checkbox" onclick="showPW()" class="mt-3">{{__('auth.authPwd')}}
                    
                    @error ('password') <span class="text-danger">{{$message}}</span> @enderror

                
                    <div class="form-check">
                        <input name="remember" type="checkbox" class="form-checkbox-input" id="exampleCheck1">
                        <label class="form-check-label mt-4" for="exampleCheck1">{{__('auth.authRemember')}}</label>
                    </div>
                    <div class="row">
                        <div class="advert-div">
                            <button type="submit" class="btn advert-button">Login</button>
                        </div>
                        <div class="brands-div">
                            <a href="/auth/google"><i class="fa-brands fa-google fa-2xl" style="color: #20304e;"></i></a>
                            <a href="/auth/facebook/redirect"><i class="fa-brands fa-facebook fa-2xl" style="color: #20304e;"></i></a>
                        </div>

                        <div class="advert-div my-3">
                            <p>{{__('auth.authLostPwd')}}</p>
                            <a href="/forgot-password"> <span class="btn advert-button">Reset password </a></span>
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