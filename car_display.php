<?php
session_start();

// Check if session has selected cars
if (!isset($_SESSION['selected_cars'])) {
    $_SESSION['selected_cars'] = array();
}

// Handle clearing selections
if (isset($_POST['clear_selection'])) {
    $_SESSION['selected_cars'] = array();
    header("Location: car_display.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Display Page</title>
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
        .selected-cars {
            margin: 20px 0;
        }
        .car-item {
            margin: 10px 0;
            padding: 15px;
            background-color: #e8f5e8;
            border: 1px solid #4CAF50;
            border-radius: 3px;
        }
        .no-cars {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 5px;
            text-decoration: none;
            display: inline-block;
        }
        .button:hover {
            background-color: #45a049;
        }
        .clear-btn {
            background-color: #f44336;
        }
        .clear-btn:hover {
            background-color: #da190b;
        }
        .info {
            background-color: #e7f3ff;
            padding: 15px;
            border: 1px solid #b3d9ff;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .actions {
            text-align: center;
            margin-top: 20px;
        }
        .session-info {
            background-color: #fff3cd;
            padding: 10px;
            border: 1px solid #ffeaa7;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Car Display Page</h1>
        
        <div class="session-info">
            <p><strong>Session ID:</strong> <?php echo session_id(); ?></p>
            <p><strong>Total Cars Selected:</strong> <?php echo count($_SESSION['selected_cars']); ?></p>
        </div>
        
        <div class="info">
            <p><strong>Your Selected Cars:</strong> This page displays all the cars you have selected. The selections are stored in your session and will persist until you clear them or your session expires.</p>
        </div>
        
        <div class="selected-cars">
            <?php if (empty($_SESSION['selected_cars'])): ?>
                <div class="no-cars">
                    <p>No cars have been selected yet.</p>
                    <p>Please go back to the Car Selection Page to make your selections.</p>
                </div>
            <?php else: ?>
                <h3>Selected Automobiles:</h3>
                <?php foreach ($_SESSION['selected_cars'] as $index => $car): ?>
                    <div class="car-item">
                        <strong><?php echo ($index + 1); ?>.</strong> <?php echo htmlspecialchars($car); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="actions">
            <a href="car_selection.php" class="button">Back to Car Selection Page</a>
            
            <?php if (!empty($_SESSION['selected_cars'])): ?>
                <form method="POST" action="" style="display: inline;">
                    <button type="submit" name="clear_selection" class="button clear-btn" 
                            onclick="return confirm('Are you sure you want to clear all selections?')">
                        Clear All Selections
                    </button>
                </form>
            <?php endif; ?>
        </div>
        
        <?php if (!empty($_SESSION['selected_cars'])): ?>
            <div class="info">
                <p><strong>Session Details:</strong></p>
                <p>Selected cars are stored in session array: $_SESSION['selected_cars']</p>
                <p>Session data persists across page requests until cleared or session expires.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
