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
                    <h3 class="fw-bold">Admin Lists</h3>

                    <!-- <a href="{{ route('admins.create') }}" class="btn btn-primary">
                        + Create Admin
                    </a> -->
                </div>

                <div class="card-box">

                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Admin ID</th>
                                <th>Admin Name</th>
                                <th>Admin Email</th>
                                <th>Creadted On</th>
                                <th>Status</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>

                                 <td>{{ $admin->created_at->format('d M Y') }}</td>

                               <td>
                                <form action="{{ route('admins.updateStatus', $admin->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="status"
                                        class="form-select form-select-sm fw-bold
                                        {{ $admin->status == 1 ? 'border-success text-success' : 'border-danger text-danger' }}"
                                        onchange="this.form.submit()">

                                        <option value="1" {{ $admin->status == 1 ? 'selected' : '' }}>
                                            Active
                                        </option>

                                        <option value="0" {{ $admin->status == 0 ? 'selected' : '' }}>
                                            Suspended
                                        </option>

                                    </select>
                                </form>
                            </td>

                               

                                
                            </tr>
                            @endforeach
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