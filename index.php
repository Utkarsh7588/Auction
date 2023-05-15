<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auction Site</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        header {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }
        
        h1 {
            margin: 0;
        }
        
        main {
            text-align: center;
            margin: 50px auto;
        }
        
        h2 {
            margin-top: 0;
        }
        
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px; /* Added margin for spacing */
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        .button:hover {
            background-color: #45a049;
        }
        
        footer {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Auction Site</h1>
    </header>
    <main>
        <h2>Please choose an option:</h2>
        <div class="button-container">
            <a href="sign-up.html" class="button">Sign Up</a>
            <a href="sign-in.html" class="button">Sign In</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2023 Auction Site</p>
    </footer>
</body>
</html>
