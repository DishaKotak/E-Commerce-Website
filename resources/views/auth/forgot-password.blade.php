<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f5f6f8;
}

.page-wrapper {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.card {
    background: #fff;
    padding: 40px;
    width: 380px;
    border-radius: 12px;
    border: 1px solid #cce5dc;
    text-align: center;
}

h2 {
    margin-bottom: 25px;
}

label {
    display: block;
    text-align: left;
    font-size: 14px;
    margin-bottom: 8px;
    color: #333;
}

.input-group {
    display: flex;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 20px;
}

.mail-icon {
    margin-right: 8px;
    color: #888;
}

.input-group input {
    border: none;
    outline: none;
    width: 100%;
    font-size: 14px;
}

button {
    width: 100%;
    padding: 12px;
    background: #90BC79;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    cursor: pointer;
}

button:hover {
    background: #90d36b;
}

.back-link {
    display: block;
    margin-top: 15px;
    color: #90BC79;
    text-decoration: none;
    font-size: 14px;
}

.success {
    color: green;
    font-size: 14px;
    margin-bottom: 15px;
}
</style>

<div class="page-wrapper">
    <div class="card">

        <h2>Forgot Password?</h2>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label>Email Address</label>

            <div class="input-group">
                <span class="mail-icon">✉️</span>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <button type="submit">Reset Password</button>
        </form>

        <a href="{{ route('login') }}" class="back-link">Back to Login</a>

    </div>
</div>
