@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
@endpush
<nav class="navbar navbar-expand-lg bg-light shadow-sm p-3 mb-5 bg-body-tertiary rounded">
    <x-container>
        <a class="navbar-brand" href={{ route('home') }}>Sistem Akreditasi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href={{ route('dashboard') }}>Dashboard</a>
                </li>
                @auth
                    @can('create', \App\Models\User::class)
                        <li class="nav-item">
                            <a class="nav-link" href={{ route('reviewer.users.index') }}>Users</a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link" href={{ route('lpppm.assignment.index') }}>Assignment</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                @endauth
            </ul>
            <div class="navbar-text">
                @auth
                    <div class="navbar-nav dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <form action={{ route('logout') }} method="post">
                                    @csrf
                                    <input type="submit" class="dropdown-item" value="Logout">
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
                @guest
                    <a class="nav-link" href="login">Log in</a>
                @endguest
            </div>
        </div>
    </x-container>
</nav>
