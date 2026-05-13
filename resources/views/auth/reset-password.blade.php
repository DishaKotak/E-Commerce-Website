<style>
    body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6f9;
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
    width: 350px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    text-align: center;
}

h2 {
    margin: 10px 0;
}

.subtitle {
    font-size: 14px;
    color: #777;
    margin-bottom: 20px;
}

input {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ddd;
    font-size: 14px;
}

button {
    width: 100%;
    padding: 12px;
    background: #90BC79;
    border: none;
    color: #fff;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
}

button:hover {
    background: #90d36b;
}
</style>

<div class="page-wrapper">
    <div class="card">

        <h2>Reset Password</h2>
        <p class="subtitle">Reset your password if you forgot them,</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <input type="email" name="email" placeholder="Email" required>

            <input type="password" name="password" placeholder="Password" required>

            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

            <button type="submit">Send Code</button>
        </form>
    </div>
</div>
