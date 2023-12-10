<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar {
            background-color: #f8f9fa; 
        }
        .navbar-brand {
            margin-left: auto; 
            margin-right: auto;
            font-weight: bold;
            color: #343a40;
        }
        .navbar-brand:hover {
            color: #007bff; 
        }
        .nav-link {
            color: #343a40;
        }
        .nav-link:hover {
            color: #007bff; 
        }
        .scrollable-table {
            max-height: 400px;
            overflow-y: auto;
        }
     
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
        }
        .form-heading {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff; 
        }
        .home {
        display: block;
        text-align: center;
        margin-top: 20px; 
    }
    </style>
</head>
<body>
<!-- <nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <a class="navbar-brand" href="#">Task List App</a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/registration') }}">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Login</a>
            </li>
        </ul>
    </div>
</nav> -->
<div class="container mt-5">
    <div class="form-container"> 
    <h2 class="form-heading">Create Task</h2>

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>


        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Due Date:</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}">
        </div>

        <div class="form-group">
            <label for="priority">Priority:</label>
            <select class="form-control" id="priority" name="priority" required>
                <option value="High">High</option>
                <option value="Medium" selected>Medium</option>
                <option value="Low">Low</option>
            </select>
        </div>

        <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" name="category_name" class="form-control" id="category_name" required>
    </div>
        <div class="text-center">
                <button type="submit" class="btn btn-primary">Create Task</button>
               
            </div>
            <a href="{{ route('tasks.index') }}" class="home">Home</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
