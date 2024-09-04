<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive SSH Command Executor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
        }
        .output {
            background-color: #333;
            color: #fff;
            padding: 15px;
            border-radius: 8px;
            overflow-x: auto;
            height: 300px;
            white-space: pre-wrap;
        }
        .error {
            background-color: #ffdddd;
            padding: 20px;
            border-radius: 10px;
            margin-top: 10px;
        }
        .success {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Interactive SSH Command Executor</h2>
    <form id="commandForm">
        <label for="commandInput">Enter SSH Command:</label><br>
        <input type="text" id="commandInput" name="command" style="width: 100%; padding: 8px;" required><br><br>
        <button type="submit" style="padding: 10px 20px;">Execute</button>
    </form>
    <div id="response" class="output"></div>
</div>

<script>
    document.getElementById('commandForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const command = document.getElementById('commandInput').value;
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'execute.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('response').innerHTML = xhr.responseText;
            } else {
                document.getElementById('response').innerHTML = '<div class="error">An error occurred while executing the command.</div>';
            }
        };
        xhr.send('command=' + encodeURIComponent(command));
    });
</script>
</body>
</html>
