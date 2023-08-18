<aside id="sidebar-wrapper" style="background: #FFFFFF">
    <div class="sidebar-brand">
        <img class="navbar-brand-full app-header-logo" src="{{ asset('img/logo_innova.png') }}" width="190"
             alt="Infyom Logo">
        <a href="{{ url('/') }}"></a>
    </div>
    <div class="separator" style="height: 20px;"></div>
    <div class="sidebar-brand sidebar-brand-sm" >
        <a href="{{ url('/') }}" class="small-sidebar-text" >
            <img class="navbar-brand-full" src="{{ asset('img/logo_ito.png') }}" width="45px" alt=""/>
        </a>
    </div>
    <div class="separator" style="height: 20px;"></div>
    <ul class="sidebar-menu" style="background-color: #FA7A1E;">
        @include('layouts.menu')
    </ul>
</aside>
