<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Maintenance</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .maintenance-container {
            text-align: center;
        }

        .maintenance-icon {
            font-size: 80px;
            color: #FF5733;
            margin-bottom: 20px;
        }

        .maintenance-text {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .btn-index {
            font-size: 18px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-index:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="maintenance-container">
    <!-- Maintenance Icon -->
    <div class="maintenance-icon">
        <i class="fas fa-tools"></i>
    </div>
    
    <!-- Maintenance Text -->
    <div class="maintenance-text">
        <strong>We're Sorry!</strong> The site is currently under maintenance.
        <br>
        We are working hard to bring it back online soon. Thank you for your patience.
    </div>

    <!-- Button to Redirect to index.php -->
    <a href="index.php" class="btn btn-index">Go Back to Home</a>
</div>

<!-- Bootstrap JS and jQuery (for Bootstrap functionality) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Font Awesome JS (for Bootstrap icons) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
