<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/superadmin.css') }}">
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 p-0">
            @include('sidebar.sidebar')
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">

            <h3 class="mb-4">
                Search Results for "{{ $search }}"
            </h3>

            @if($events->count())

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Event Name</th>
                            <th>Category</th>
                            <th>Duration</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($events as $event)

                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->event_name }}</td>
                            <td>{{ $event->category }}</td>
                            <td>{{ $event->duration }} mins</td>
                        </tr>

                    @endforeach

                    </tbody>

                </table>

            

            @endif

            

            <!-- venue -->

            @if($venues->count())

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Venue Name</th>
                            <th>Location</th>
                            <th>Capacity</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($venues as $venue)

                        <tr>
                            <td>{{ $venue->id }}</td>
                            <td>{{ $venue->venue_name }}</td>
                            <td>{{ $venue->location }}</td>
                            <td>{{ $venue->capacity }}</td>
                        </tr>

                    @endforeach

                    </tbody>

                </table>

            @endif

            <!-- User -->

            @if($users->count())

            <table class="table table-bordered">

            @foreach($users as $user)

            <thead class="table-primary">
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                </tr>
            </thead>

            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>

            @endforeach

            </table>

            @endif


            @if(
                $events->isEmpty() &&
                $venues->isEmpty() &&
                $users->isEmpty() &&
                $bookings->isEmpty() &&
                $shows->isEmpty()
            )

            <div class="alert alert-warning mt-3">
                No results found for "<strong>{{ $search }}</strong>".
            </div>

            @endif
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>