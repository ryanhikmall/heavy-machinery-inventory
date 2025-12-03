@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-dark text-white text-center">
                <h4>Login Sistem Inventory</h4>
            </div>
            <div class="card-body p-4">
                
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" placeholder="admin@toko.com" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="******">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </div>

                </form>
            </div>
            <div class="card-footer text-center">
                <small class="text-muted">Gunakan akun yang sudah dibuat di Seeder.</small>
            </div>
        </div>
    </div>
</div>
@endsection