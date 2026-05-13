<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel Session Practice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        input {
            padding: 8px;
            width: 250px;
        }
        button {
            padding: 8px 15px;
            margin-top: 5px;
        }
        .success {
            color: green;
            margin-top: 10px;
        }
        .box {
            margin-bottom: 25px;
        }
    </style>
</head>
<body>

    <h2>Laravel Session Example</h2>

    {{-- Show success message --}}
    @if(session()->has('success'))
        <p class="success" id="flash-message">{{ session('success') }}</p>
    @endif

    {{-- Show stored session value --}}
    @if(session()->has('user'))
        <h3>Welcome, {{ session('user') }}</h3>
    @endif

    <div class="box">
        <h4>Save Session</h4>
        <form action="{{ url('/session-save') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Enter your name" required>
            <br>
            <button type="submit">Save</button>
        </form>
    </div>

    <div class="box">
        <h4>Update Session</h4>
        <form action="{{ url('/session-update') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Update your name" required>
            <br>
            <button type="submit">Update</button>
        </form>
    </div>

    <div class="box">
        <a href="{{ url('/session-view') }}">View Session Value</a>
        <br><br>
        <a href="{{ url('/session-delete') }}">Delete Session</a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                setTimeout(function() {
                    flashMessage.style.display = 'none';
                }, 3000); 
            }
        });
    </script>

</body>
</html>
