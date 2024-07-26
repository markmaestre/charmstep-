<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center; 
            justify-content: center; 
   
            margin: 0;
        }
        h1 {
            text-align: center; 
        }
        canvas {
            margin: 20px; 
        }
    </style>
</head>
<body>
    <h1>Dashboard</h1>
    <canvas id="usersChart" width="700" height="100"></canvas>
    <canvas id="itemsQuantityChart" width="400" height="100"></canvas>
    <canvas id="salesChart" width="400" height="100"></canvas>

    <script src="/js/chart.js"></script> 
</body>
</html>
