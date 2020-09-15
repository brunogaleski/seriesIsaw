<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link @if($active == 'series') active @endif" href="/series">Series</a>
            <a class="nav-item nav-link @if($active == 'platform') active @endif" href="/platform">Platform</a>
        </div>
    </div>

    @include('layouts.logout')
</nav>
