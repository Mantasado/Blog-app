@if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 mt-2 mr-2 sm:block">
        @auth
            @if (Route::current()->getName() != 'admin.panel')
                <a href="{{ route('admin.panel') }}" class="btn btn-info mb-1">Admin panel</a>
            @endif
            <div class="space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="route('logout')" class="btn btn-secondary"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        Log out
                    </a>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-secondary">Log in</a>
        @endauth
    </div>
@endif