<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            color: #ff0000;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        .container h1 {
            font-size: 6em;
            margin: 0;
        }
        .container p {
            font-size: 1.5em;
            margin: 20px 0;
        }
        .container a {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: #000000;
            background-color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .container a:hover {
            background-color: #3498db;
            color: #ecf0f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>403</h1>
        <p>Sorry, you do not have access to this page.</p>
        <a href="{{ url('/') }}">Go to Homepage</a>
    </div>
</body>
</html>