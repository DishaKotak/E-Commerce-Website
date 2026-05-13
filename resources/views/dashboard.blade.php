<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Single Page Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background: 
                linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                url('https://images.unsplash.com/photo-1499346030926-9a72daac6c63') center/cover no-repeat;
            color: #fff;
            position: relative;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 80px;
        }

        .logo {
            font-size: 22px;
            font-weight: 600;
        }

        .logo span {
            color: #4da6ff;
        }

        .nav-links a {
            margin-left: 25px;
            text-decoration: none;
            color: #fff;
            font-size: 14px;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #4da6ff;
        }

        /* Hero Content */
        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            max-width: 800px;
            padding: 20px;
        }

        .hero-content h1 {
            font-size: 52px;
            font-weight: 700;
            letter-spacing: 3px;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 35px;
        }

        .hero-content button {
            background: #4da6ff;
            color: #fff;
            border: none;
            padding: 14px 30px;
            font-size: 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .hero-content button:hover {
            background: #1e8cff;
        }

    </style>
</head>
<body>

    <section class="hero">

        <!-- Navbar -->
        <div class="navbar">
            <div class="logo">Single Page <span>Website</span></div>
            <div class="nav-links">
                <a href="#" class="active">HOME</a>
                <a href="#">ABOUT</a>
                <a href="#">PORTFOLIO</a>
                <a href="{{ route('users.index') }}">USERS</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
    @csrf
    <button type="submit" style="
        background:none;
        border:none;
        color:white;
        font-size:14px;
        letter-spacing:1px;
        cursor:pointer;
        margin-left:25px;
    ">
        LOGOUT
    </button>
</form>

            </div>
        </div>

        <!-- Hero Content -->
        <div class="hero-content">
            <h1>HI, WELCOME TO THIS TEMPLATE</h1>
            <p>Get started below to create a great business</p>
            <button>See all features</button>
        </div>

    </section>

</body>
</html>
