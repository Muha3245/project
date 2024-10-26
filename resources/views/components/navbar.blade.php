@php
        // Fetch categories with their subcategories using the helper method
        $categories = helper::category();
    @endphp

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>

                    <!-- Loop through categories -->
                    @foreach($categories as $category)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                {{ $category->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- Loop through subcategories for each category -->
                                @foreach($category->subcategories as $subcategory)
                                    <li><a class="dropdown-item" href="#">{{ $subcategory->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>

                <!-- Authentication Links in Navbar -->
                <ul class="navbar-nav ml-auto">
                    @if (Route::has('login'))
                        @auth
                        @hasrole('Admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard') }}">dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" >{{ auth()->user()->name }}</a>
                            </li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @endhasrole
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>

                <!-- Search form -->
                <form class="d-flex ml-3">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
