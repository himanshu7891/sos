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

    <li class="nav-item">
      <a class="nav-link" href="{{ route('branch.index') }}">{{ __('Branch') }}</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('team.index') }}">{{ __('Team') }}</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('member.index') }}">{{ __('Member') }}</a>
    </li>

@endguest