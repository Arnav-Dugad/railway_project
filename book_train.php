<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "railway_db";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $train_id = $_POST['train_id'];
    $seats = (int)$_POST['seats'];
    $payment_method = $_POST['payment_method'];
    $username = $_SESSION['username']; // Ensure the username is stored in the session

    // Check available seats
    $checkSeatsQuery = "SELECT seats_left FROM trains WHERE train_id = ?";
    $stmt = $conn->prepare($checkSeatsQuery);
    $stmt->bind_param("i", $train_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $train = $result->fetch_assoc();

        if ($train['seats_left'] >= $seats) {
            // Deduct seats
            $updateSeatsQuery = "UPDATE trains SET seats_left = seats_left - ? WHERE train_id = ?";
            $stmt = $conn->prepare($updateSeatsQuery);
            $stmt->bind_param("ii", $seats, $train_id);
            $stmt->execute();

            // Insert booking
            $insertBookingQuery = "INSERT INTO bookings (username, train_id, seats_booked, status) VALUES (?, ?, ?, 'Active')";
            $stmt = $conn->prepare($insertBookingQuery);
            $stmt->bind_param("sii", $username, $train_id, $seats);
            $stmt->execute();

            echo "Booking successful!";
        } else {
            echo "Not enough seats available.";
        }
    } else {
        echo "Train not found.";
    }
}

$conn->close();
?>
