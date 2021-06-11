@extends('adminlte::page')

@section('title', 'Create Users')

@section('content')

<div class="card">
    <div class="card-header border-bottom-0">
        <h3 class="card-title text-bold" style="font-size:1.4rem">Create User</h3>
        <div class="card-tools">
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-info">
                <i class="fas fa-fw fa-arrow-left mr-1"></i>
                <span>Go Back</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input
                    type="text"
                    name="name" id="name"
                    value="{{ old('name') ?? '' }}"
                    class="form-control @error('name') is-invalid @enderror"
                    autofocus
                >
                @error('name')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    name="email" id="email"
                    value="{{ old('email') ?? '' }}"
                    class="form-control @error('email') is-invalid @enderror"
                >
                @error('email')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror"
                >
                @error('password')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input
                    type="password"
                    name="password_confirmation" id="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                >
                @error('password_confirmation')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select
                    name="role" id="role"
                    class="form-control @error('role') is-invalid @enderror"
                >
                    @foreach($roles as $role)
                        <option value="{{ $role }}" @if(old('role') == $role) selected @endif>{{ $role }}</option>
                    @endforeach
                </select>

                @error('role')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-4 mb-1">
                <input type="submit" class="btn btn-primary" value="Add New User">
                <a href="{{ route('admin.users.index') }}" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</div>
@stop
