<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    height: 100vh;
    background: linear-gradient(135deg, #90BC79, #6da65d);
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* 🔵 Floating Shapes */
.shape {
    position: absolute;
    border-radius: 20px;
    opacity: 0.5;
    filter: blur(10px);
    animation: float 6s ease-in-out infinite;
}

.shape1 {
    width: 120px;
    height: 120px;
    background: #ffffff;
    top: 10%;
    left: 15%;
}

.shape2 {
    width: 80px;
    height: 80px;
    background: #000;
    bottom: 15%;
    right: 20%;
    border-radius: 50%;
}

.shape3 {
    width: 60px;
    height: 60px;
    background: #ffffff;
    top: 70%;
    left: 10%;
    border-radius: 50%;
}

.shape4 {
    width: 100px;
    height: 100px;
    background: #2e2e2e;
    top: 20%;
    right: 10%;
}

/* Animation */
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}

/* 🧊 Glass Card */
.container {
    width: 380px;
    padding: 40px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(20px);
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    position: relative;
    z-index: 10;
}

h2 {
    margin-bottom: 25px;
    color: #000;
}

input {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 15px;
    border-radius: 25px;
    border: none;
    outline: none;
    background: rgba(255,255,255,0.8);
}

button {
    width: 100%;
    padding: 12px;
    border-radius: 25px;
    border: none;
    background: #000;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.link {
    margin-top: 15px;
    text-align: center;
}

.link a {
    text-decoration: none;
    color: #000;
}

.forgot-wrapper {
    text-align: right;
    margin-bottom: 10px;
}

.forgot-wrapper a {
    text-decoration: none;
    color: #000;
    font-size: 14px;
}
</style>
</head>

<body>

<!-- Shapes -->
<div class="shape shape1"></div>
<div class="shape shape2"></div>
<div class="shape shape3"></div>
<div class="shape shape4"></div>

<!-- Login Card -->
<div class="container">
    <h2>Login</h2>

    @if (session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form action="/login" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <div class="forgot-wrapper">
            <a href="/forgot-password">Forgot Password?</a>
        </div>
        <button type="submit">Login</button>
    </form>

    <div class="link">
        <a href="/register">Register</a>
    </div>
</div>

</body>
</html>
