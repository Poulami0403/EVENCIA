
      
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
    <!-- <div class="nav-item">
      <span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></span>
      Payments
    </div>
    <div class="nav-item">
      <span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v1a3 3 0 0 0 0 4v1a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-1a3 3 0 0 0 0-4z"/><path d="M13 5v14" stroke-dasharray="2 2"/></svg></span>
      Tickets
    </div> -->
 
    <div class="nav-section-label">USERS &amp; SYSTEM</div>
    <div class="nav-item">
      <span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a6.5 6.5 0 0 1 13 0"/></svg></span>
      Users
    </div>
    <!-- <div class="nav-item">
      <span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M7 15l4-6 4 3 5-7"/></svg></span>
      Reports
    </div>
    <div class="nav-item">
      <span class="nav-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .34 1.87l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.7 1.7 0 0 0-1.87-.34 1.7 1.7 0 0 0-1 1.55V21a2 2 0 0 1-4 0v-.09A1.7 1.7 0 0 0 9 19.4a1.7 1.7 0 0 0-1.87.34l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.7 1.7 0 0 0 4.6 15a1.7 1.7 0 0 0-1.55-1H3a2 2 0 0 1 0-4h.09A1.7 1.7 0 0 0 4.6 9a1.7 1.7 0 0 0-.34-1.87l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.7 1.7 0 0 0 9 4.6a1.7 1.7 0 0 0 1-1.55V3a2 2 0 0 1 4 0v.09a1.7 1.7 0 0 0 1 1.55 1.7 1.7 0 0 0 1.87-.34l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06A1.7 1.7 0 0 0 19.4 9a1.7 1.7 0 0 0 1.55 1H21a2 2 0 0 1 0 4h-.09a1.7 1.7 0 0 0-1.55 1z"/></svg></span>
      Settings
    </div> -->
  </aside>

  <!-- MAIN -->
  <!-- <main class="main">
 
    <div class="topbar">
      <div>
        <h1>Dashboard</h1>
        <p>Welcome back, Admin! Here's what's happening with your events.</p>
      </div>
      <div class="topbar-right">
        <div class="search-box">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.3-4.3"/></svg>
          Search events, users, bookings...
          <span class="kbd">⌘K</span>
        </div>
        <div class="icon-btn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
          <span class="badge">3</span>
        </div>
        <div class="profile">
          <div class="avatar">A</div>
          <div>
            <div class="profile-name">Admin</div>
            <div class="profile-role">Super Admin</div>
          </div>
        </div>
      </div>
    </div>
</main> -->

  