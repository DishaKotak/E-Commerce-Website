<h2> Add User </h2>
@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
        <p>{{ $error }} </p>
        @endforeach
</div>
@endif
<form action="/adduser" method="POST">
    @csrf 
    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br><br>
    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="">--Select Status--</option>
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>
    <br><br>
    <button type="submit">Add User</button>
</form>
<a href="/login">Login</a>