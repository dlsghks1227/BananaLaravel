@extends('layouts.app')

@section('title', 'login')

@push('scripts')
    <link rel="stylesheet" type="text/css" href={{ URL::asset('css/login.css'); }}>
@endpush

@section('content')
<body class="login">
    <main class="login-form">
        @if ($errors->any())            
            <div>{{$errors->first('message');}}</div>
        @endif
        <form class="text-center" method="POST" action="{{ route('login'); }}">
            @csrf
            <h1 class="mb-3">클릭 클릭</h1>
            <div class="form-floating mb-3">
                {{-- https://laravel.com/docs/8.x/blade#validation-errors --}}
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="floatingInput" name="username" placeholder="Username" aria-describedby="validationServerUsernameFeedback">
                <label for="floatingInput">Username</label>
                @error('username')
                    <div class="invalid-feedback" id="validationServerUsernameFeedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" name="password" placeholder="Password" aria-describedby="validationServerPasswordFeedback">
                <label for="floatingPassword">Password</label>
                @error('password')
                    <div class="invalid-feedback" id="validationServerPasswordFeedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="w-100 btn btn-lg btn-primary">Start !</button>
        </form>
    </main>
</body>
@endsection