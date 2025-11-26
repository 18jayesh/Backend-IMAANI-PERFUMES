<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
  <link rel="stylesheet" href="CSS/bootstrap.min.css">

    <style>
        body{
            font-family: Arial;
            background:#f0f0f0;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }
        .login-box{
            width:350px;
            padding:25px;
            background:white;
            border-radius:10px;
            box-shadow:0 4px 10px rgba(0,0,0,0.2);
        }
        input{
            width:100%;
            padding:12px;
            margin:10px 0;
            border-radius:6px;
            border:1px solid #ccc;
        }
        button{
            width:100%;
            padding:12px;
            background:#111827;
            color:white;
            border:none;
            border-radius:6px;
            cursor:pointer;
        }
        button:hover{
            background:#1f2937;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2 style="text-align:center;">Login</h2>
    
    <form action="login_process.php" method="POST">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
        <a  class="btn btn-outline-dark w-100 mt-2"href="index.php">Back To Home</a>
    </form>
</div>

</body>
</html>
