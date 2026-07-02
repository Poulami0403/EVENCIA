
      
  <!-- SIDEBAR -->
    <aside class="sidebar">
    <div class="brand">
      <img src="{{ asset('image/evencia.png') }}" width="200" height="150" style="height: 150px">
    </div>

    
    @if(auth()->user()->role == 'super_admin')
    <a href="{{ route('superadmin.dashboard') }}" class="text-decoration-none">
    @else
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
    @endif

        <div class="nav-item active">
            <span class="nav-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                    <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                    <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                    <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                </svg>
            </span>
            Dashboard
        </div>

    </a>
 
    <div class="nav-section-label">MANAGE</div>
    <a href="{{ route('admin.events.index') }}">
        <div class="nav-item">
            <span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg></span>
                Events
        </div>
    </a>
    <a href="{{ route('admin.venues.index') }}">
        <div class="nav-item">
        <span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><path d="M9 22V12h6v10"/></svg></span>
        Venues
        </div>
    </a>

    <a href="{{ route('admin.shows.index') }}">
        <div class="nav-item">
        <span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 10h20"/><path d="M4 6l8-4 8 4"/><path d="M4 10v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/></svg></span>
        Shows
        </div>
    </a>

    <a href="{{ route('admin.seats.index') }}">
        <div class="nav-item">
        <span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg></span>
        Seats
        </div>
    </a>

    @if(auth()->user()->role === 'super_admin')
    <a href="{{ route('admins.index') }}">
        <div class="nav-item">
            <span class="nav-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 2l7 4v6c0 5-3.5 9-7 10-3.5-1-7-5-7-10V6l7-4z"/>
                  <path d="M9 12l2 2 4-4"/>
              </svg>
          </span>
            Admin
        </div>
    </a>
    @endif

    <div class="nav-section-label">BOOKINGS</div>
    <a href="{{ route('admin.bookings.index') }}">
      <div class="nav-item">
        <span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg></span>
        Bookings
      </div>
    </a>
    
    
    @if(auth()->user()->role === 'admin')
    <div class="nav-section-label">USERS </div>
    <a href="{{ route('admin.users.index') }}">
        <div class="nav-item">
            <span class="nav-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 2l7 4v6c0 5-3.5 9-7 10-3.5-1-7-5-7-10V6l7-4z"/>
                  <path d="M9 12l2 2 4-4"/>
              </svg>
          </span>
            Users
        </div>
    </a>
    @endif
  </aside>

  