<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/superadmin.css') }}">
</head>

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
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 p-0">
            @include('sidebar.sidebar')
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">

        @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Users</h3>
            </div>

            <table class="table table-bordered table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered On</th>
                        <th>Status</th>
                        
                    </tr>
                </thead>

                <tbody>

                @forelse($users as $user)

                    <tr>

                        <td>{{ $user->id }}</td>

                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>{{ $user->created_at->format('d M Y') }}</td>

                        <td>
                            <form action="{{ route('admin.users.updateStatus', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <select
                                    name="status"
                                    class="form-select form-select-sm fw-bold
                                    {{ $user->status == 1 ? 'border-success text-success' : 'border-danger text-danger' }}"
                                    onchange="this.form.submit()">

                                    <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>
                                        Suspended
                                    </option>

                                </select>
                            </form>
                        </td>

                    </tr>
                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            No users found.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>