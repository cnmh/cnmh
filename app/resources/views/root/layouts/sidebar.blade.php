<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('assets/images/logo-cnmh.png') }}" alt="CNMH Logo" class="" style="max-width: 100%;">
        <span class="brand-text font-weight-light"></span>
    </a>
    <br>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('root.layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
