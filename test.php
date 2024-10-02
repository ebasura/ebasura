<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worksheet 2.1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
        }
        
        header {
            background-color: purple;
            color: white;
            padding: 10px;
        }
        
        nav {
            padding: 10px;
        }
        
        nav ul {
            list-style: none;
        }
        
        nav ul li {
            margin: 10px 0;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            background-color: #2980b9;
            border-radius: 5px;
        }
        
        main {
            padding: 20px;
            background-color: #f8f8f8;
        }
        
        aside {
            padding: 20px;
            background-color: #ecf0f1;
        }
        
        footer {
            text-align: center;
            padding: 10px;
            background-color: purple;
            color: white;
        }
        
        .tasks {
            display: flex;
            flex-wrap: wrap;
        }
        
        .task {
            background-color: #95a5a6;
            margin: 10px;
            padding: 20px;
            flex: 1;
            min-width: 200px;
            text-align: center;
            border-radius: 5px;
        }
        
        .calculator {
            margin-top: 20px;
        }
        
        .calculator button {
            width: 50px;
            height: 50px;
            margin: 5px;
            font-size: 18px;
        }
        
        #calc-display {
            width: 100%;
            height: 50px;
            font-size: 20px;
            text-align: right;
            margin-bottom: 10px;
        }
        
        @media (max-width: 460px) {
            nav, main, aside {
                width: 100%;
            }
        
            .tasks {
                flex-direction: column;
            }
        }

        /* Hide content by default */
        #ws2.2 {
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Prof Elective 1</h1>
        <h2>BSIT 3</h2>
    </header>
    
    <div class="container py-2">
        <div class="row">
            <div class="col-md-3">
                <nav>
                    <ul>
                        <li><a href="#" onclick="showWorksheet('ws2.1')">Worksheet 2.1</a></li>
                        <li><a href="#" onclick="showWorksheet('ws2.2')">Worksheet 2.2</a></li>
                        <li><a href="#">Worksheet 2.3</a></li>
                        <li><a href="#">Worksheet 2.4</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-9">
                <main id="ws2.1">
                    <section>
                        <h2>Worksheet 2.1</h2>
                        <p><strong>Instructions:</strong> Make this website responsive.</p>
                    </section>
                </main>

                <main id="ws2.2">
                    <section>
                        <h2>Worksheet 2.2</h2>
                        <div class="task">
                            <p>Calculator</p>
                            <!-- Calculator -->
                            <div class="calculator">
                                <input type="text" id="calc-display" disabled>
                                <br>
                                <button onclick="appendToDisplay('1')">1</button>
                                <button onclick="appendToDisplay('2')">2</button>
                                <button onclick="appendToDisplay('3')">3</button>
                                <button onclick="performOperation('+')">+</button>
                                <br>
                                <button onclick="appendToDisplay('4')">4</button>
                                <button onclick="appendToDisplay('5')">5</button>
                                <button onclick="appendToDisplay('6')">6</button>
                                <button onclick="performOperation('-')">-</button>
                                <br>
                                <button onclick="appendToDisplay('7')">7</button>
                                <button onclick="appendToDisplay('8')">8</button>
                                <button onclick="appendToDisplay('9')">9</button>
                                <button onclick="performOperation('*')">*</button>
                                <br>
                                <button onclick="clearDisplay()">C</button>
                                <button onclick="appendToDisplay('0')">0</button>
                                <button onclick="calculate()">=</button>
                                <button onclick="performOperation('/')">/</button>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </div>

    <aside>
        <h2>Additional Info</h2>
        <p>Some additional information here.</p>
    </aside>

    <footer>
        <p>&copy; 2024 Prof Elective 1</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.getElementById('ws2.2').style.display = 'none'
        // Function to show one worksheet and hide others
        function showWorksheet(id) {
            // Hide both worksheets
            document.getElementById('ws2.1').style.display = 'none';
            document.getElementById('ws2.2').style.display = 'none';
            
            // Show the selected worksheet
            document.getElementById(id).style.display = 'block';
        }

        let currentInput = '';
        let operator = null;
        let previousInput = '';

        function appendToDisplay(value) {
            currentInput += value;
            document.getElementById('calc-display').value = currentInput;
        }

        function performOperation(op) {
            if (currentInput === '') return;
            operator = op;
            previousInput = currentInput;
            currentInput = '';
        }

        function calculate() {
            if (operator === null || currentInput === '') return;
            const result = eval(`${previousInput} ${operator} ${currentInput}`);
            document.getElementById('calc-display').value = result;
            currentInput = result;
            operator = null;
            previousInput = '';
        }

        function clearDisplay() {
            currentInput = '';
            operator = null;
            previousInput = '';
            document.getElementById('calc-display').value = '';
        }
    </script>
</body>
</html>
