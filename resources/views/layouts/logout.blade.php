@if (Auth::user())
    <a href="{{ route('logout') }}" alt="Logout" title="Logout" class="btn btn-primary btn-icon float-right mb-3">
        <i class="glyphicon glyphicon-off"  aria-hidden="true"></i>
        Logout
    </a>
@endif
