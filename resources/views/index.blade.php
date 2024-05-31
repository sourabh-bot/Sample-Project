<html>
    <head>
        <title>Sample</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center my-3">Welcome</h1>
            <div class="row">
                <div class="col-4">
                    <div class="alert" role="alert"></div>
                    <form class="user_form needs-validation" method="post" action="{{ route('store') }}" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="" name="name">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="" name="email">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mobile number</label>
                            <input type="text" class="form-control" value="" name="mobile_number">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select class="form-control" name="role_id">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"> {{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <div class="invalid-feedback"></div>
                        </div>
                        <button class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div class="col-8">
                    <table class="table user_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile number</th>
                                <th>Description</th>
                                <th>Role</th>
                                <th>Profile Image</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        <div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/index.js') }}"></script>
    </body>
</html>