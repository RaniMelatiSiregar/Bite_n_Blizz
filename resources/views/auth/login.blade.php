@extends('public.layouts.app')

@section('content')
<div class="container">
    <div class="login-container">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-white">
                <h4 class="mb-0">Login Bite n Blizz</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-danger">Login</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <p class="mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-danger">Register</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.login-container {
    max-width: 400px;
    margin: 100px auto;
}
</style>
@endsection