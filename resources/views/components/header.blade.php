@php
    $panelName = $panelName ?? '';
@endphp
<style>
    .nav-link {
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .fa-user-circle{
            display: none;
        }
        .nav-link{
            text-align: center;
        }
        .collapse {
            position: absolute;
            top: 100%; 
            left: 0;
            right: 0;
            z-index: 1050;
            background-color: white;
            padding-bottom: 5%;
        }
    }
</style>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light"  onmouseover="removeImageZoom();">
        <div class="container">
            <a class="brand" href="@if ($panelName == 'admin') /admin @else / @endif">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if ($panelName == 'admin')
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @if (request()->routeIs('updateItem'))
                            <li class="nav-item me-3">
                                <a class="nav-link is-active">Update Item</a>
                            </li>
                        @endif
                        <li class="nav-item me-3">
                            <a class="nav-link {{ request()->routeIs('addItem') || request()->is('admin') ? 'is-active' : '' }}"
                                href="{{ route('addItem') }}">Add Item</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link {{ request()->routeIs('itemList') ? 'is-active' : '' }}"
                                href="{{ route('itemList') }}">Item List</a>
                        </li>
                    </ul>
                </div>
            @else
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li id="main_ajax_loading_div" class="nav-item me-3 pt-2" style="visibility: hidden">
                            <img src="{{ asset('images/ajaxMainLoading.gif') }}" />
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}"
                                href="/">Home</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="">About</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="">Offers</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="">Contact</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link {{ request()->routeIs('signin') || request()->routeIs('signup') ? 'is-active' : '' }}"
                                href="{{ route('signin') }}" title="click here to login">
                                <i class="fa fa-user-circle" style="color:green" aria-hidden="true"></i> {{ request()->routeIs('signup') ? 'Sign Up' : 'Sign In' }}
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </nav>
</header>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        document.getElementById('main_ajax_loading_div').style.visibility = 'hidden';
    });
</script>
