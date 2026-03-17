<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
    <div class="container">
        <a class="navbar-brand" href="/">Dream Jobs</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="jobs">Find Jobs</a>
                </li>
            </ul>
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            @else
                <a href="{{ route('postJob') }}" class="btn btn-primary">Post a Job</a>
                
                <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
