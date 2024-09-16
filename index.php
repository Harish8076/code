<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Compiler</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        #code {
            width: 80%;
            height: 200px;
            margin-top: 20px;
            font-size: 16px;
            padding: 10px;
        }
        #output {
            width: 80%;
            margin-top: 20px;
            height: 150px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #eaeaea;
        }
        button {
            padding: 10px 20px;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Online Compiler</h1>
    <textarea id="code" placeholder="Write your code here..."></textarea><br>
    <button onclick="compileCode()">Run Code</button>
    <div id="output">Output will be displayed here</div>

    <script>
        function compileCode() {
            const code = document.getElementById('code').value;

            fetch('compile.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ code: code })
            })
            .then(response => response.json())
            .then(data => {
                const output = data.output ? data.output : 'No output available';
                document.getElementById('output').innerText = output;
            })
            .catch(error => {
                document.getElementById('output').innerText = 'Error: ' + error;
            });
        }
    </script>
</body>
</html>
