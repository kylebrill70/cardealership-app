@extends('layout.loginlayout')
@section('content')

<style>
  body {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background:url('../img/dl.jpg');
    background-size: cover;
    background-position: center;
}
.container {
    display: flex;
}
.logo{
  width: 500px;
}

  .left-section {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
  }
  .right-section {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
  }
  .login-form {
      width: 400px; /* Wider login form */
      padding: 30px;
      background-color: rgba(255, 255, 255, 0.15); /* Glassmorphism effect */
      backdrop-filter: blur(3px); /* Glassmorphism effect */
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.1), 0 0 40px rgba(0, 0, 0, 0.1);
  }
  .form-group {
      margin-bottom: 20px;
  }
  .form-group label {
      display: block;
      margin-bottom: 5px;
      color: white;
  }
  .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
  }
  .form-group button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
  }
  .form-group button:hover {
      background-color: #0056b3;
  }
  .signup-link {
      text-align: center;
      color: white;
  }
  .signup-link a {
      color: #007bff;
      text-decoration: none;
  }
  @media screen and (max-width: 768px) {
  .container {
    display: block;
  }
  .logo{
    width: 250px;
  }
}
</style>
</head>
<body>
<div class="container">
  <div class="left-section">
    <img src="../img/logo/bg.png" class="logo" alt="Logo" >
</div>
  <div class="right-section">
    <form action="/user/process/login" method="post">
        @csrf
          <div class="form-group">
              <label for="username">Username</label>
              <input type="text" id="username" name="username"><!--required-->
          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password"><!--required-->
          </div>
          <div class="form-group">
              <button type="submit">Login</button>
          </div>
          <div class="signup-link">
              Don't have an account? <a href="/signup">Sign up</a>
          </div>
      </form>
  </div>
</div>

@endsection
