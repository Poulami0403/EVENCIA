<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lumina Admin — Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<style>
  :root{
    --bg:#F4F5FB;
    --card:#FFFFFF;
    --border:#ECEEF6;
    --text:#1B1A33;
    --text-soft:#8C90A8;
    --text-faint:#B3B6C9;
    --purple:#6C5CE7;
    --purple-dark:#5538F0;
    --purple-bg:#EFEBFE;
    --teal:#1AAE8C;
    --teal-bg:#E1F6EE;
    --orange:#F2994A;
    --orange-bg:#FFF0DF;
    --pink:#F25C8A;
    --pink-bg:#FFE8EF;
    --blue:#4C7CF0;
    --blue-bg:#E9F0FE;
    --shadow:0 6px 20px rgba(40,42,90,0.06);
  }
  *{box-sizing:border-box;margin:0;padding:0;}
  body{
    font-family:'Inter',sans-serif;
    background:var(--bg);
    color:var(--text);
  }
  .app{display:flex;min-height:100vh;}

  /* SIDEBAR */
  .sidebar{
    width:248px;
    background:var(--card);
    border-right:1px solid var(--border);
    padding:6px 18px;
    display:flex;
    flex-direction:column;
    flex-shrink:0;
  }
  .brand{
    /* display:flex;align-items:center;gap:10px;
    font-family:'Poppins',sans-serif;font-weight:600;font-size:17px;
    color:var(--text);margin-bottom:34px;padding:0 6px; */
  }
  /* .brand-icon{
    width:14px;height:14px;border-radius:10px;flex-shrink:0;
    background:linear-gradient(135deg,#7A6CF0,#5538F0);
    display:flex;align-items:center;justify-content:center;
  } */
  /* .brand-icon svg{width:18px;height:18px;color:#fff;} */

  .nav-item{
    display:flex;align-items:center;gap:12px;
    padding:11px 14px;border-radius:11px;
    color:var(--text-soft);font-size:14px;font-weight:500;
    margin-bottom:4px;cursor:pointer;text-decoration:none;
    transition:background .15s;
  }
  .nav-item:hover{background:var(--purple-bg);color:var(--purple-dark);}
  .nav-item.active{
    background:linear-gradient(135deg,#7A6CF0,#5538F0);
    color:#fff;box-shadow:var(--shadow);
  }
  .nav-item.active:hover{background:linear-gradient(135deg,#7A6CF0,#5538F0);}
  .nav-icon{width:19px;height:19px;flex-shrink:0;display:flex;}
  .nav-icon svg{width:100%;height:100%;}
  a.nav-link{text-decoration:none;display:block;}

  .sidebar-spacer{flex:1;}
  .sidebar-footer{
    display:flex;align-items:center;gap:10px;
    border-top:1px solid var(--border);
    padding-top:18px;margin-top:10px;
  }
  .footer-avatar{
    width:38px;height:38px;border-radius:50%;flex-shrink:0;
    background:var(--purple-bg);color:var(--purple);
    display:flex;align-items:center;justify-content:center;
  }
  .footer-avatar svg{width:18px;height:18px;}
  .footer-name{font-size:13.5px;font-weight:600;color:var(--text);}
  .footer-email{font-size:11.5px;color:var(--text-soft);}

  /* MAIN */
  .main{flex:1;padding:30px 36px;min-width:0;}

  .topbar{
    display:flex;justify-content:space-between;align-items:center;
    margin-bottom:30px;flex-wrap:wrap;gap:16px;
  }
  .topbar h1{
    font-family:'Poppins',sans-serif;font-weight:600;font-size:25px;
    background:linear-gradient(135deg,#6C5CE7,#3B6EF0);
    -webkit-background-clip:text;background-clip:text;color:transparent;
  }
  .topbar-right{display:flex;align-items:center;gap:14px;}
  .search-box{
    display:flex;align-items:center;gap:9px;
    background:var(--card);border:1px solid var(--border);
    border-radius:30px;padding:10px 18px;min-width:250px;
    color:var(--text-faint);font-size:13.5px;box-shadow:var(--shadow);
  }
  .search-box svg{width:16px;height:16px;flex-shrink:0;}
  .icon-btn{
    width:42px;height:42px;border-radius:50%;
    background:var(--card);border:1px solid var(--border);
    display:flex;align-items:center;justify-content:center;
    color:var(--text-soft);position:relative;box-shadow:var(--shadow);cursor:pointer;
  }
  .icon-btn svg{width:18px;height:18px;}
  .icon-btn .dot{
    position:absolute;top:9px;right:10px;width:7px;height:7px;
    border-radius:50%;background:var(--pink);border:1.5px solid var(--card);
  }
  .profile-avatar{
    width:42px;height:42px;border-radius:50%;
    background:linear-gradient(135deg,#7A6CF0,#5538F0);color:#fff;
    display:flex;align-items:center;justify-content:center;
    font-weight:600;font-size:13.5px;box-shadow:var(--shadow);
  }
  .profile-avatar.dropdown-toggle::after {
    display: none !important;
}

  .card{
    background:var(--card);border:1px solid var(--border);
    border-radius:16px;padding:20px;box-shadow:var(--shadow);
  }

  /* STAT CARDS */
  .stats-row{
    display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:22px;
  }
  .stat-top{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:16px;}
  .stat-icon{
    width:42px;height:42px;border-radius:12px;
    display:flex;align-items:center;justify-content:center;
  }
  .stat-icon svg{width:20px;height:20px;}
  .stat-icon.violet{background:var(--purple-bg);color:var(--purple);}
  .stat-icon.teal{background:var(--teal-bg);color:var(--teal);}
  .stat-icon.orange{background:var(--orange-bg);color:var(--orange);}
  .stat-label{font-size:13.5px;color:var(--text-soft);margin-bottom:8px;}
  .stat-value{
    font-family:'Poppins',sans-serif;font-weight:700;font-size:25px;
    color:var(--text);margin-bottom:12px;
  }
  .stat-change{display:flex;align-items:center;gap:8px;margin-bottom:16px;}
  .delta{
    display:inline-flex;align-items:center;gap:3px;
    padding:3px 9px;border-radius:20px;font-size:12px;font-weight:600;
  }
  .delta.up{background:var(--teal-bg);color:var(--teal);}
  .delta.down{background:var(--pink-bg);color:var(--pink);}
  .delta svg{width:11px;height:11px;}
  .change-label{font-size:12.5px;color:var(--text-faint);}
  .stat-chart{height:46px;}

  /* GRID LAYOUTS */
  .grid-main{display:grid;grid-template-columns:1.9fr 1fr;gap:20px;margin-bottom:22px;}
  .grid-bottom{display:grid;grid-template-columns:1fr 1.25fr;gap:20px;}

  .panel-header{
    display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;
  }
  .panel-title{font-family:'Poppins',sans-serif;font-weight:600;font-size:16px;color:var(--text);}
  .view-all{font-size:13.5px;font-weight:600;color:var(--purple);cursor:pointer;}
  .menu-dots{color:var(--text-faint);cursor:pointer;font-size:18px;line-height:0;}

  /* RECENT BOOKINGS TABLE */
  table{width:100%;border-collapse:collapse;}
  thead th{
    text-align:left;font-size:11px;text-transform:uppercase;letter-spacing:.04em;
    color:var(--text-faint);font-weight:600;padding-bottom:12px;
    border-bottom:1px solid var(--border);
  }
  thead th.right, tbody td.right{text-align:right;}
  tbody td{
    padding:14px 4px;border-bottom:1px solid var(--border);
    font-size:14px;color:var(--text);vertical-align:middle;
  }
  tbody tr:last-child td{border-bottom:none;}
  .event-cell{display:flex;align-items:center;gap:12px;}
  .event-icon{
    width:38px;height:38px;border-radius:10px;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;color:#fff;
  }
  .event-icon svg{width:17px;height:17px;}
  .event-name{font-weight:600;font-size:14px;color:var(--text);}
  .customer-cell{color:var(--text-soft);}
  .amount-cell{font-weight:600;}
  .date-cell{color:var(--text-soft);}
  .status-pill{
    display:inline-block;padding:5px 13px;border-radius:20px;
    font-size:12.5px;font-weight:600;
  }
  .status-pill.confirmed{background:var(--teal-bg);color:var(--teal);}
  .status-pill.pending{background:var(--orange-bg);color:var(--orange);}
  .status-pill.cancelled{background:var(--pink-bg);color:var(--pink);}

  /* TOP VENUES */
  .venue-item{margin-bottom:18px;}
  .venue-item:last-child{margin-bottom:0;}
  .venue-top{display:flex;justify-content:space-between;align-items:baseline;margin-bottom:9px;}
  .venue-name{font-size:14px;font-weight:600;color:var(--text);}
  .venue-capacity{font-size:12px;color:var(--text-soft);font-weight:500;}
  .progress-track{height:7px;background:#EEF0F8;border-radius:10px;overflow:hidden;margin-bottom:9px;}
  .progress-fill{height:100%;border-radius:10px;}
  .venue-meta{display:flex;justify-content:space-between;font-size:11px;font-weight:600;letter-spacing:.03em;text-transform:uppercase;color:var(--text-faint);}

  /* MAP CARD */
  .map-card{
    position:relative;border-radius:16px;overflow:hidden;min-height:230px;
    border:1px solid var(--border);box-shadow:var(--shadow);
    background:radial-gradient(circle at 70% 100%, #1f3a52 0%, #0d1b2e 55%, #060d18 100%);
  }
  .map-grid{
    position:absolute;inset:0;opacity:.35;
    background-image:
      linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px);
    background-size:28px 28px;
  }
  .map-pin-btn{
    position:absolute;top:18px;left:18px;
    display:flex;align-items:center;gap:7px;
    background:rgba(255,255,255,.96);color:var(--text);
    padding:9px 17px;border-radius:30px;font-size:13px;font-weight:600;
    box-shadow:0 4px 14px rgba(0,0,0,.18);cursor:pointer;
  }
  .map-pin-btn svg{width:14px;height:14px;color:var(--pink);}
  .map-shape{position:absolute;bottom:-30px;right:-10px;width:230px;height:200px;opacity:.9;}

  /* SYSTEM LOGS */
  .logs-card{position:relative;min-height:230px;}
  .log-item{display:flex;gap:14px;}
  .log-line-col{display:flex;flex-direction:column;align-items:center;width:12px;flex-shrink:0;}
  .log-dot{
    width:10px;height:10px;border-radius:50%;background:var(--purple);
    box-shadow:0 0 0 4px var(--purple-bg);margin-top:3px;flex-shrink:0;
  }
  .log-thread{width:2px;flex:1;background:var(--border);margin-top:6px;}
  .log-body{flex:1;padding-bottom:22px;}
  .log-title-row{display:flex;justify-content:space-between;align-items:baseline;gap:10px;}
  .log-title{font-size:14px;font-weight:600;color:var(--text);}
  .log-time{font-size:11.5px;color:var(--text-faint);white-space:nowrap;}
  .log-sub{font-size:12.5px;color:var(--text-soft);margin-top:3px;}
  .fab{
    position:absolute;bottom:18px;right:18px;width:48px;height:48px;border-radius:50%;
    background:linear-gradient(135deg,#7A6CF0,#5538F0);color:#fff;
    display:flex;align-items:center;justify-content:center;
    box-shadow:0 8px 20px rgba(85,56,240,.35);cursor:pointer;
  }
  .fab svg{width:20px;height:20px;}

  @media (max-width:1100px){
    .stats-row{grid-template-columns:1fr;}
    .grid-main, .grid-bottom{grid-template-columns:1fr;}
    .sidebar{display:none;}
    .main{padding:22px;}
  }
</style>
</head>
<body>
<div class="app">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="brand">
      <img src="{{ asset('image/evencia.png') }}" width="200" height="150">
    </div>

    
    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
    <div class="nav-item active">
        <span class="nav-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <rect x="3" y="3" width="7" height="7" rx="1.5"/> <rect x="14" y="3" width="7" height="7" rx="1.5"/> <rect x="14" y="14" width="7" height="7" rx="1.5"/> <rect x="3" y="14" width="7" height="7" rx="1.5"/></svg>
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
  <main class="main">

    <div class="topbar">
    <h1>EVENCIA</h1>

    <div class="topbar-right">

        <div class="search-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/>
                <path d="M21 21l-4.3-4.3"/>
            </svg>

            <input type="text"
                   placeholder="Quick search..."
                   style="border:none; outline:none; background:transparent;">
        </div>

        <div class="icon-btn">
            <svg viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
            <span class="dot"></span>
        </div>

        @auth
          @php
              $names = explode(' ', Auth::user()->name);
              $initials = strtoupper(
                  substr($names[0], 0, 1) .
                  (count($names) > 1
                      ? substr($names[count($names)-1], 0, 1)
                      : '')
              );
          @endphp

          <div class="dropdown">

              <div class="profile-avatar dropdown-toggle"
                  data-bs-toggle="dropdown"
                  style="cursor:pointer;">

                  {{ $initials }}
              </div>

              <ul class="dropdown-menu dropdown-menu-end shadow">

                  <li class="px-3 py-2">
                      <strong>{{ Auth::user()->name }}</strong><br>
                      <small class="text-muted">
                          {{ Auth::user()->email }}
                      </small>
                  </li>

                  <li><hr class="dropdown-divider"></li>

                  <li>
                      <form method="POST"
                            action="{{ route('logout') }}">
                          @csrf

                          <button type="submit"
                                  class="dropdown-item text-danger">
                              Logout
                          </button>
                      </form>
                  </li>

              </ul>

          </div>
      @endauth
    </div>
</div>

    <!-- STATS -->
    <div class="stats-row">

      <div class="card stat-card">
        <div class="stat-top">
          <div class="stat-icon violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="13" rx="2"/><circle cx="12" cy="12.5" r="3"/><path d="M6 6V4.5A1.5 1.5 0 0 1 7.5 3h9A1.5 1.5 0 0 1 18 4.5V6"/></svg></div>
        </div>
        <div class="stat-label">Total Revenue</div>
        <div class="stat-value">{{ number_format($totalRevenue ?? 2482900) }}</div>
        <div class="stat-change">
          <span class="delta up"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 15l7-7 7 7"/></svg>12.5%</span>
          <span class="change-label">vs last month</span>
        </div>
        <div class="stat-chart"><canvas id="sparkRevenue"></canvas></div>
      </div>

      <div class="card stat-card">
        <div class="stat-top">
          <div class="stat-icon teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 3-3h14a3 3 0 0 1 3 3v1a3 3 0 0 0 0 4v1a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-1a3 3 0 0 0 0-4z"/><path d="M13 5v14" stroke-dasharray="2 2"/></svg></div>
        </div>
        <div class="stat-label">Tickets Sold</div>
        <div class="stat-value">{{ number_format($ticketsSold) }}</div>
        <div class="stat-change">
          <span class="delta up"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 15l7-7 7 7"/></svg>8.2%</span>
          <span class="change-label">vs last month</span>
        </div>
        <div class="stat-chart"><canvas id="sparkTickets"></canvas></div>
      </div>

      <div class="card stat-card">
        <div class="stat-top">
          <div class="stat-icon orange"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg></div>
        </div>
        <div class="stat-label">Active Events</div>
        <div class="stat-value">{{ $activeEvents ?? '1,204' }}</div>
        <div class="stat-change">
          <span class="delta down"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 9l7 7 7-7"/></svg>2.1%</span>
          <span class="change-label">vs last month</span>
        </div>
        <div class="stat-chart"><canvas id="sparkEvents"></canvas></div>
      </div>

    </div>

    <!-- BOOKINGS + VENUES -->
    <div class="grid-main">

      <div class="card">
        <div class="panel-header">
          <div class="panel-title">Recent Bookings</div>
          <div class="view-all">View All</div>
        </div>
        <table>
          <thead>
            <tr>
              <th>Event Name</th>
              <th>Customer</th>
              <th>Date</th>
              <th class="right">Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>

          @forelse($recentBookings as $booking)
          <tr>
            <td>
              <div class="event-cell">
                <span
                  class="event-icon" style="background:linear-gradient(135deg,#7A6CF0,#5538F0);">🎫</span>
                <span class="event-name">
                  {{ $booking->show->event->event_name }}
                </span>
              </div>
            </td>
            <td class="customer-cell">
              {{ $booking->customer_name }}
            </td>
            <td class="date-cell">
              {{ $booking->created_at->format('d M Y') }}
            </td>

              <td class="right amount-cell">
                  ₹{{ $booking->total_amount }}
              </td>

              <td>

                  @if($booking->status == 'confirmed')

                      <span class="status-pill confirmed">
                          Confirmed
                      </span>

                  @elseif($booking->status == 'Pending')

                      <span class="status-pill pending">
                          Pending
                      </span>

                  @else

                      <span class="status-pill cancelled">
                          Cancelled
                      </span>

                  @endif

              </td>

          </tr>

          @empty

          <tr>
              <td colspan="5" class="text-center">
                  No Bookings Found
              </td>
          </tr>

          @endforelse

          </tbody>
        </table>
      </div>

      <div class="card">
        <div class="panel-header">
          <div class="panel-title">Top Venues</div>
            <div class="menu-dots">&#8942;</div>
          </div>

          @forelse($topVenues as $venue)
            <div class="venue-item">
              <div class="venue-top">
                <span class="venue-name">
                  {{ $venue->venue_name }}
                </span>
                
                <span class="venue-capacity">
                  {{ $venue->shows_count }} Shows
                </span>
              </div>
              
              <div class="progress-track">
                <div class="progress-fill" style="width: {{ min($venue->shows_count * 10, 100) }}%; background: linear-gradient(90deg,#7A6CF0,#5538F0);">

                </div>
              </div>
              
              <div class="venue-meta">
                <span>
                  {{ $venue->shows_count }} Events
                </span>
                
                <span>
                  Capacity: {{ $venue->capacity }}
                </span>
              
              </div>
            </div>
            
            @empty
            <div class="text-center p-3">
              No venues available.
            </div>
            
            @endforelse
          </div>
        </div>
      </div>

    <!-- MAP + SYSTEM LOGS -->
    
  </main>
</div>

<script>
  function tinyBarChart(id, data, lightColor, darkColor, highlightLast){
    const colors = data.map((_, i) => (highlightLast && i >= data.length - 3) ? darkColor : lightColor);
    new Chart(document.getElementById(id), {
      type: 'bar',
      data: {
        labels: data.map((_,i)=>i),
        datasets: [{
          data,
          backgroundColor: colors,
          borderRadius: 4,
          borderSkipped: false,
          barPercentage: 0.65,
          categoryPercentage: 0.85
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display:false }, tooltip: { enabled:false } },
        scales: {
          x: { display:false },
          y: { display:false, beginAtZero:true }
        }
      }
    });
  }

  tinyBarChart('sparkRevenue', [5,6,5,7,8,7,9,11,10,13], '#DCD5FB', '#5538F0', true);
  tinyBarChart('sparkTickets', [8,7,9,8,10,9,11,12,11,13], '#C9EEE2', '#1AAE8C', true);
  tinyBarChart('sparkEvents', [11,10,9,9,8,7,6,5], '#FBE3C9', '#FBE3C9', false);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>