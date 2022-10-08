@guest
  
@else

  {{-- @if (Route::has('home')) --}}
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
  {{-- @endif --}}

  {{-- @if (Route::has('application.index') || Route::has('change/application.status')) --}}
    <li class="nav-item">
      <a class="nav-link" href="{{ route('application.index') }}">{{ __('Application') }}</a>
    </li>
  {{-- @endif --}}

@endguest