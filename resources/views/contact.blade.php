<x-main>
    <div class="advert-form">
        <div class="card col-4">
            <form action="{{ route('send') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input class="form-control" type="text" placeholder="Nome" name="nome" />
                    </div>

                    <!--  -->
                    <div class="mb-3">
                        <label class="form-label">Telefono</label>
                        <input class="form-control" type="number" placeholder="" name="telefono" />
                    </div>
                    <!--  -->
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" placeholder="Email" name="mail" />
                    </div>
                    <!-- -->
                    <div class="mb-3">
                        <label class="form-label">Messaggio</label>
                        <textarea class="form-control" type="text" placeholder="Messaggio" style="height: 10rem;" name="messaggio"></textarea>
                    </div>

                    <!--  -->
                    <div class="login-button">
                        <button class="btn" type="submit">Invia</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-main>
