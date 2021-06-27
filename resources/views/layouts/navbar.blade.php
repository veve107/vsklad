<div class="sl-logo">
    <a href="{{route('admin.home')}}">
        <i class="icon ion-android-star-outline">
        </i> Virtuálny sklad
    </a>
</div>
<div class="sl-sideleft">
    <div class="sl-sideleft-menu">
        <a href="{{route('admin.home')}}" class="sl-menu-link {{request()->routeIs('admin.home') ? 'active' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        @if(\Illuminate\Support\Facades\Auth::user()->role->id == 1)
            <a href="#" class="sl-menu-link {{request()->routeIs('users*') ? 'active' : '' }}">
                <div class="sl-menu-item">
                    <i class="menu-item-icon ion-ios-people-outline tx-20"></i>
                    <span class="menu-item-label">Používatelia</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{route('users')}}" class="nav-link">Používatelia</a></li>
                {{--                <li class="nav-item"><a href="{{route('admin.positions.roles')}}" class="nav-link">Role</a></li>--}}
                <li class="nav-item"><a href="{{route('users.positions')}}" class="nav-link">Pozície</a></li>
                <li class="nav-item"><a href="{{route('users.departments')}}" class="nav-link">Oddelenia</a>
                </li>
            </ul>
        @endif
        <a href="#" class="sl-menu-link {{request()->routeIs('request*') ? 'active' : '' }}">
            <div class="sl-menu-item">
                <i class="menu-item-icon ion-stats-bars tx-20"></i>
                <span class="menu-item-label">Žiadosti</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{route('request.add')}}" class="nav-link">Žiadosť o techniku</a></li>
            <li class="nav-item"><a href="{{route('request.index')}}" class="nav-link">Zoznam žiadostí</a></li>
        </ul>
        @if(\Illuminate\Support\Facades\Auth::user()->role->id == 1 || \Illuminate\Support\Facades\Auth::user()->role->id == 2)
            <a href="#" class="sl-menu-link {{request()->routeIs('hardware*') ? 'active' : '' }}">
                <div class="sl-menu-item">
                    <i class="menu-item-icon ion-android-laptop tx-20"></i>
                    <span class="menu-item-label">Technika</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{route('hardware')}}" class="nav-link">Dostupná technika</a></li>
                <li class="nav-item"><a href="{{route('hardware.add')}}" class="nav-link">Pridať techniku</a></li>
                <li class="nav-item"><a href="{{route('hardware.types')}}" class="nav-link">Typy techniky</a></li>
                <li class="nav-item"><a href="{{route('hardware.orders')}}" class="nav-link">Objednávky</a></li>
                <li class="nav-item"><a href="{{route('hardware.brands')}}" class="nav-link">Značky</a></li>
            </ul>
        @endif
    </div><!-- sl-sideleft-menu -->

    <br>
</div>
