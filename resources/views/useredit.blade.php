<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('/user-update/'.$user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name:</label><br>
    <input type="text" name="name" value="{{ $user->name }}"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ $user->email }}"><br><br>

    <label>Status:</label><br>
        <select name="status">
            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select> <br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="{{ url('/users') }}">⬅ Back to User List</a>

</body>
</html>
