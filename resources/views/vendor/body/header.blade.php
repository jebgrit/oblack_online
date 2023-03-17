<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            {{-- <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span
                        class="position-absolute top-50 search-show translate-middle-y"><i
                            class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i
                            class='bx bx-x'></i></span>
                </div>
            </div> --}}
            
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">

                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">

                            @php
                                $ncount = Auth::user()
                                    ->unreadNotifications()
                                    ->count();
                            @endphp
                            <span class="alert-count">{{ $ncount }}</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>

                                    @if ($ncount == null)
                                        <!-- -->
                                    @else
                                        <p class="msg-header-clear ms-auto">
                                            <a href="{{ url('/markasread-all') }}">
                                                Marquer tout comme lue.
                                            </a>
                                        </p>
                                    @endif
                                </div>
                            </a>

                            @php
                                $user = Auth::user();
                            @endphp

                            <div class="header-notifications-list">
                                @forelse ($user->unreadNotifications as $notification)
                                    <a class="dropdown-item" href="{{ route('markasread', $notification->id) }}">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-warning text-warning"><i class="bx bx-send"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">Message
                                                    <span class="msg-time float-end">
                                                        {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                                    </span>
                                                </h6>
                                                <p class="msg-info">{{ $notification->data['message'] }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                @endforelse
                            </div>

                        </div>
                    </li>

                    <li class="nav-item dropdown dropdown-large">
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="header-message-list">
                                {{-- NB: A ne pas supprimer, la sidebar y dépend, j'sais pas pourquoi et comment?? --}}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            @php
                $id = Auth::user()->id;
                $vendorData = App\Models\User::find($id);
            @endphp

            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ !empty($vendorData->photo) ? url('upload/vendor_images/' . $vendorData->photo) : url('upload/vendor_images/no_image.jpg') }}"
                        class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                        <p class="designattion mb-0">{{ Auth::user()->role }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('vendor.profile') }}"><i
                                class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('vendor.change.setting') }}"><i
                                class="bx bx-cog"></i><span>Paramètres</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('vendor.logout') }}"><i
                                class='bx bx-log-out-circle'></i><span>Déconnexion</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
