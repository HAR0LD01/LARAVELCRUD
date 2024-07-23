@extends('users.layout')

@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Edit User</h2>
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

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="FirstName"><strong>First Name:</strong></label>
                            <input type="text" id="FirstName" name="FirstName" class="form-control" value="{{ old('FirstName', $user->FirstName) }}">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="LastName"><strong>Last Name:</strong></label>
                            <input type="text" id="LastName" name="LastName" class="form-control" value="{{ old('LastName', $user->LastName) }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="Email"><strong>Email:</strong></label>
                            <input type="email" id="Email" name="Email" class="form-control" value="{{ old('Email', $user->Email) }}">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="PhoneNumber"><strong>Phone Number:</strong></label>
                            <input type="text" id="PhoneNumber" name="PhoneNumber" class="form-control" value="{{ old('PhoneNumber', $user->PhoneNumber) }}">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for="Password"><strong>Password:</strong></label>
                            <input type="password" id="Password" name="Password" class="form-control" placeholder="Leave blank to keep current password">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="ProfilePicture"><strong>Profile Picture:</strong></label>
                            <input type="file" id="ProfilePicture" name="ProfilePicture" class="form-control">
                            @if ($user->ProfilePicture)
                                <div class="image-box mt-2">
                                    <img src="{{ asset('storage/custom_folder/' . $user->ProfilePicture) }}" alt="Profile Picture" width="100">
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>

@endsection

<style>
.table-bordered {
    border-collapse: collapse;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #ddd;
    padding: 8px;
}
.image-box {
    border: 1px solid #ddd;
    padding: 10px;
    width: 120px;
    height: 120px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}
.image-box img {
    max-width: 100%;
    max-height: 100%;
}
</style>
