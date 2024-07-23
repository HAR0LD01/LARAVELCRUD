@extends('users.layout')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>All Users</h2>
                <a class="btn btn-primary" href="{{ route('users.create') }}">Add New User</a>
            </div>
        </div>
    </div>

    @if ($users->isEmpty())
        <div class="alert alert-info">
            No users found.
        </div>
    @else
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Profile Picture</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->FirstName }}</td>
                            <td>{{ $user->LastName }}</td>
                            <td>{{ $user->Email }}</td>
                            <td>{{ $user->PhoneNumber }}</td>
                            <td>
                                @if ($user->ProfilePicture)
                                    <div class="image-box">
                                        <img src="{{ asset('storage/custom_folder/' . $user->ProfilePicture) }}" alt="Profile Picture" width="100">
                                    </div>
                                @else
                                    No image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
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
}
.image-box img {
    max-width: 100%;
    max-height: 100%;
}
.table-responsive {
    margin-top: 20px;
}
</style>
