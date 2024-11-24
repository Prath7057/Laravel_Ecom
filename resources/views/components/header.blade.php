@php
    $panelName = $panelName ?? '';
@endphp
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="brand" href="#">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if ($panelName == 'admin')
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-3">
                        <a class="nav-link is-active" href="{{ route('addItem') }}">Add Item</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#">Item List</a>
                    </li>
                </ul>
            </div>
            @else
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-3">
                        <a class="nav-link is-active" href="#">Home</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#">Offers</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
            @endif            
        </div>
    </nav>
</header>