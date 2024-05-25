<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="https://dashboard.amandemy.co.id/images/amandemy-logo.png" alt="" srcset="" width="130px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="nav justify-content-end p-2" id="navbarSupportedContent">
            @auth
            <a href="{{ route('dashboard') }}" class="text-decoration-none fw-bold text-black me-2 my-auto">HOME</a>
            @if (isset(Auth::user()->roles[0]) && Auth::user()->roles[0]->name == 'superadmin')
                <a href="{{ route('product') }}"
                    class="text-decoration-none fw-bold text-black me-2 my-auto">PRODUCTS</a>
                <a href="{{ route('admin_page') }}" class="text-decoration-none fw-bold text-black me-2 my-auto">MANAGE
                    PRODUCTS</a>
            @else
                <a href="{{ route('product') }}"
                    class="text-decoration-none fw-bold text-black me-2 my-auto">PRODUCTS</a>
            @endif
            <div class="dropdown">
                <a class="text-decoration-none btn btn-info fw-bold text-black my-auto dropdown-toggle" href="#"
                    role="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('get_profile') }}">Profile</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ route('home') }}" class="text-decoration-none fw-bold text-black me-2 my-auto">HOME</a>
            <a href="{{ route('product') }}" class="text-decoration-none fw-bold text-black me-2 my-auto">PRODUCTS</a>
            <a href="{{ route('login') }}" class="text-decoration-none btn btn-info fw-bold text-black my-auto">LOGIN</a>
        @endauth
        </div>
    </div>
</nav>