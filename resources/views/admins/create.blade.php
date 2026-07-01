<!-- @extends('master')
@section('content')
<div class="container-fluid">
    <div class="row">

       

        {{-- MAIN CONTENT --}}
       

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="page-header mb-4">
                <h2 class="fw-bold mb-1">Create Admin</h2>
                <p class="text-muted">
                    Add a new admin to the ticket booking system.
                </p>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-5">

                    <form action="{{ route('admins.store') }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    Admin Name
                                </label>
                                <input type="text"
                                       name="admin_name"
                                       value="{{ old('admin_name') }}"
                                       class="form-control form-control-lg"
                                       placeholder="Enter Admin Name"
                                       required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    Admin Email
                                </label>

                                <input type="email"
                                       name="admin_email"
                                       value="{{ old('admin_email') }}"
                                       class="form-control form-control-lg"
                                       placeholder="Enter Email"
                                       required>
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label fw-semibold">
                                    Password
                                </label>

                                <input type="password"
                                       name="password"
                                       value="{{ old('admin_name') }}"
                                       class="form-control form-control-lg"
                                       placeholder="Enter Password"
                                       required>
                            </div>


                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <select name="status"
                                        class="form-select form-select-lg"
                                        required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <div class="col-12 mt-3">
                                <button type="submit"
                                        class="btn btn-primary btn-lg px-5">
                                    Create admin
                                </button>

                                <a href="{{ route('admins.index') }}"
                                   class="btn btn-outline-secondary btn-lg ms-2">
                                    Cancel
                                </a>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection -->