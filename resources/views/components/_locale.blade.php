 <form class="d-inline" action="{{ route('set_language_locale', $lang)}}" method="POST">
    @csrf
    <button type="submit" class="btn" >
    {{-- <span class="flag-icon flag-icon-{{ $nation }}"></span> --}}
    <img src="{{ asset('vendor/blade-flags/language-'. $lang . '.svg')}}" width="32" height="32" alt="">
    </button>
</form>