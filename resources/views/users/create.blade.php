@extends('users.layout')

@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Add New User</h2>
                <a class="btn btn-secondary" href="{{ route('users.index') }}">Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="userForm" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
    
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="FirstName"><strong>First Name:</strong></label>
                            <input type="text" id="FirstName" name="FirstName" class="form-control" placeholder="Enter first name" value="{{ old('FirstName') }}">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="LastName"><strong>Last Name:</strong></label>
                            <input type="text" id="LastName" name="LastName" class="form-control" placeholder="Enter last name" value="{{ old('LastName') }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="Email"><strong>Email:</strong></label>
                            <input type="email" id="Email" name="Email" class="form-control" placeholder="Enter email" value="{{ old('Email') }}">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="PhoneNumber"><strong>Phone Number:</strong></label>
                            <input type="text" id="PhoneNumber" name="PhoneNumber" class="form-control" placeholder="Enter phone number" value="{{ old('PhoneNumber') }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="Password"><strong>Password:</strong></label>
                            <input type="password" id="Password" name="Password" class="form-control" placeholder="Enter password">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="ProfilePicture"><strong>Profile Picture:</strong></label>
                            <input type="file" id="ProfilePicture" name="ProfilePicture" class="form-control">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#userForm').on('submit', function(e) {
            e.preventDefault(); 

            var formData = new FormData(this); 
            $.ajax({
                url: "{{ route('users.store') }}",
                type: 'POST',
                data: formData,
                processData: false, 
                contentType: false, 
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#userForm')[0].reset();
                    } else {
                        let errorMessage = 'There were some problems with your input:\n\n';
                        if (response.errors) {
                            $.each(response.errors, function(key, value) {
                                errorMessage += value.join('\n') + '\n';
                            });
                        }
                        alert(errorMessage);
                    }
                },
                error: function(xhr) {
                    alert('There was an error adding the user.');
                }
            });
        });
    });
</script>

@endsection

<style>
.table-bordered {
    border-collapse: collapse;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #ddd;
    padding: 8px;
}
</style>
