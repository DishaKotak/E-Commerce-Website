<html>
<head>
    <title>User Detail</title>
</head>
<body>

<h2>User Detail</h2>

<p><b>ID:</b> {{ $user->id }}</p>
<p><b>Name:</b> {{ $user->name }}</p>
<p><b>Email:</b> {{ $user->email }}</p>
<p><b>Status:</b> {{ $user->status }}</p>

<br>

<a href="{{ url('/users') }}">⬅ Back to User List</a>

</body>
</html>