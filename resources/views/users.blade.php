<html>
    <head>
        <title>User List</title>
        <style>
        .action-link {
            color: black;
            text-decoration: none;
            font-weight: 500;
        }

        .action-link:hover {
            color: #555;
        }
    </style>
    </head>

    <body>

    <h2>User List</h2>
    <a href="{{ url('/adduser') }}" style="border: 1px solid black; padding: 8px 15px; color: black; text-decoration: none; border-radius: 5px; display:inline-block; margin-bottom: 15px;">Add User</a>

    <table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Action</th>
    </tr>

    @foreach($users as $user)
    <tr>
        
        <td>{{ $user->name }}</td>

        <td>
            <a href="{{ url('/user-detail/'.$user->id) }}" class="action-link"> Show </a> |
            <a href="{{ url('/user-edit/'.$user->id) }}" class="action-link"> Update </a> |
            <form action="{{ url('/user-delete/' .$user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure to delete this user?');"> 
                @csrf 
              <button type="submit">Delete</button>   
            </form>           
        </td>
    </tr>
    @endforeach

    </table>

    </body>
</html>
