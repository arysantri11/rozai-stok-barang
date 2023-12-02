@extends('auth.layouts.main')

@section('main-body')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col">
                            <div class="" style="margin-top: 40px; margin-bottom: 40px">
                                <div class="text-center mb-5">
                                    <h1 class="h2 text-secondary fw-semibold">Please Login</h1>
                                    <img src="{{ asset('images/logo/logo-bsi.png') }}" alt="logo" width="140px" class="mt-2">
                                </div>
                                <form class="user" action="{{ route('login.authenticate') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="username" class="form-control form-control-user" name="username" placeholder="Enter Username..." required>
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="password" class="form-control form-control-user" name="password"  placeholder="Password" required>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary w-100">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection