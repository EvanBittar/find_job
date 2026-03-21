<style>
    .profile-link {
        color: #000000 !important;
        background-color: transparent;
        border: 1px solid #000000; 
        transition: all 0.3s ease; 
    }  
    .profile-link:hover {
        color: #28a745 !important; 
        border-color: #28a745;   
        background-color: rgba(40, 167, 69, 0.1);
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
    <div class="container">
        <a class="navbar-brand" href="/">Dream Jobs</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                
                 @auth
                <li class="nav-item">
                    <a href="{{ route('account') }}" class="btn profile-link me-1">
                        <i class="fa fa-user"></i> Profile
                    </a>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('jobs') }}">Find Jobs</a>
                </li>
            </ul>
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>

                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            @else
                <a href="{{ route('postJob') }}" class="btn btn-primary me-2">Post a Job</a>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>