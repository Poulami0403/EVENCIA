@php
use Illuminate\Support\Facades\Session;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>venues List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <style>
        body {
            background-color: #f8f9fa;

        }

        .container {
            max-width: 1100px;
        }

        .card-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.05);
            padding: 20px;
        }

        img {
            border-radius: 8px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR --}}
        <div class="col-md-3 col-lg-2 p-0">
            @include('sidebar.sidebar')
        </div>

        {{-- MAIN CONTENT --}}
        <div class="col-md-9 col-lg-10 p-4">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold">Venues List</h3>

                    <a href="{{ route('admin.venues.create') }}" class="btn btn-primary">
                        + Create Venue
                    </a>
                </div>

                <div class="card-box">

                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Venue Name</th>
                                <th>Location</th>
                                <th>Capacity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($venue as $venue)
                                <tr>
                                    <!-- <td>{{ $venue->id }}</td> -->
                                    <td>{{ $venue->venue_name }}</td>
                                    <td style="max-width:250px; word-break:break-word;">
                                        {{ $venue->location }}
                                    </td>

                                    <td>{{ $venue->capacity }}</td>

                                    <td>
                                        @if($venue->status)
                                            <span class="badge bg-success">Available</span>
                                        @else
                                            <span class="badge bg-secondary">Unavailable</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.venues.edit', encrypt($venue->id)) }}"
                                        class="btn btn-primary">
                                            Edit
                                        </a>
                                        <a href="#"
                                       onclick="deleteTask({{ $venue->id }}); return false;"
                                       class="btn btn-danger">
                                        Delete
                                    </a>

                                    <form id="dlt{{ $venue->id }}"
                                          action="{{ route('admin.venues.destroy',encrypt($venue->id)) }}"
                                          method="POST"
                                          class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No venues found</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function deleteTask(id) {
    if (confirm('Are you sure you want to delete this venue?')) {
        document.getElementById('dlt' + id).submit();
    }
}
</script>
</body>
</html>