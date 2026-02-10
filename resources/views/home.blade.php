<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @auth
    <h2>Your account has succesfully logged-in</h2>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Log-out</button>
        </form>

    <div style= "border: 3px solid black;">
        <h2>Create a new Post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="post title"><br><br>
            <textarea name="body" placeholder="post body here..."></textarea><br><br>
            <button type="submit">Create Post</button>
        </form>
    </div>

    @else
    <div style= "border: 3px solid black;">
        <h2>Register</h2>
        <form action="/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Name"><br><br>
            <input type="email" name="email" placeholder="Email"><br><br>
            <input type="password" name="password" placeholder="Password"><br><br>
            <button type="submit">Register</button>
        </form>
    </div>
    <div style= "border: 3px solid black;">
        <h2>Log-in</h2>
        <form action="/login" method="POST">
            @csrf
            <input type="text" name="loginname" placeholder="Name"><br><br>
            <input type="password" name="loginpassword" placeholder="Password"><br><br>
            <button type="submit">Log-in</button>
        </form>
    </div>

    @endauth
    
</body>
</html>