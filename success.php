<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .message-container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #aaa;
        }
        h2 {
            color: green;
        }
        .countdown {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h2>✅ Registration Successful!</h2>
        <p class="countdown">Redirecting in <span id="timer">5</span> seconds...</p>
    </div>

    <script>
        var seconds = 5;
        var countdown = setInterval(function() {
            seconds--;
            document.getElementById('timer').textContent = seconds;
            if (seconds <= 0) {
                clearInterval(countdown);
                window.location.href = 'display.php'; // Redirect after countdown
            }
        }, 1000);
    </script>
</body>
</html>