<?php
session_start();

// Initialize session array if not exists
if (!isset($_SESSION['selected_cars'])) {
    $_SESSION['selected_cars'] = array();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_cars'])) {
    $_SESSION['selected_cars'] = $_POST['selected_cars'];
    header("Location: car_display.php");
    exit();
}

// List of 7 automobiles
$automobiles = array(
    "Toyota Camry",
    "Honda Civic",
    "Ford Mustang",
    "Chevrolet Corvette",
    "BMW 3 Series",
    "Mercedes-Benz C-Class",
    "Audi A4"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Selection Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .car-list {
            margin: 20px 0;
        }
        .car-item {
            margin: 10px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .car-item label {
            display: block;
            cursor: pointer;
            font-size: 16px;
        }
        .car-item input[type="checkbox"] {
            margin-right: 10px;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .info {
            background-color: #e7f3ff;
            padding: 15px;
            border: 1px solid #b3d9ff;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .link {
            margin-top: 20px;
            text-align: center;
        }
        .link a {
            color: #007bff;
            text-decoration: none;
        }
        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Car Selection Page</h1>
        
        <div class="info">
            <p><strong>Instructions:</strong> Select the cars you are interested in from the list below. You can select multiple cars. Once you submit your selection, the cars will be stored in your session.</p>
        </div>
        
        <form method="POST" action="">
            <div class="car-list">
                <h3>Available Automobiles:</h3>
                <?php foreach ($automobiles as $index => $car): ?>
                    <div class="car-item">
                        <label>
                            <input type="checkbox" 
                                   name="selected_cars[]" 
                                   value="<?php echo htmlspecialchars($car); ?>"
                                   <?php echo (in_array($car, $_SESSION['selected_cars']) ? 'checked' : ''); ?>>
                            <?php echo htmlspecialchars($car); ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <button type="submit" class="submit-btn">Submit Car Selection</button>
        </form>
        
        <div class="link">
            <a href="car_display.php">View Currently Selected Cars</a>
        </div>
        
        <?php if (!empty($_SESSION['selected_cars'])): ?>
            <div class="info">
                <p><strong>Currently Selected Cars:</strong> <?php echo count($_SESSION['selected_cars']); ?> car(s) selected</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
