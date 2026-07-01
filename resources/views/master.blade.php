
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/eventlist.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f5f5f5;
            text-align:center;
        }

        .seat-row{
            margin-bottom:10px;
        }

        .row-label{
            display:inline-block;
            width:30px;
            font-weight:bold;
            font-size:16px;
            margin-right:15px;
        }

        .seat{
            width:35px;
            height:35px;
            border:2px solid #731ea0;
            border-radius:5px;
            display:inline-flex;
            justify-content:center;
            align-items:center;
            margin:3px;
            background:white;
            color:#555;
            font-size:13px;
            font-weight:bold;
        }

        .booked{
            background:red;
            color:white;
            border-color:red;
        }

        h3, h2{
            margin-top:40px;
            margin-bottom:20px;
        }
    </style>
</head>
<body>
    <div class="row">
    {{-- SIDEBAR --}}
        <div class="col-md-3 col-lg-2 min-vh-100 text-white p-0">
            @include('sidebar.sidebar')
        </div>
        <div class="col-md-9 col-lg-10 p-4"> @yield('content')</div>
   
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
function deleteTask(id) {
    if (confirm('Are you sure you want to delete this event?')) {
        document.getElementById('dlt' + id).submit();
    }
}
</script>
</body>
</html>