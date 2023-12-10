<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="text-center mb-4">User Login</h2>

    @if(isset($message))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p class="mt-3 text-center">Don't have an account? <a href="{{ url('/registration') }}">Register here</a>.</p>
</div>

</body>
</html>
