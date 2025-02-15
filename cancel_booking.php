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
    $booking_id = $_POST['booking_id'];

    // Get the number of seats booked and train_id
    $query = "SELECT train_id, seats_booked FROM bookings WHERE booking_id = ? AND status = 'Active'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $booking = $result->fetch_assoc();
        $train_id = $booking['train_id'];
        $seats = $booking['seats_booked'];

        // Update train seats
        $updateTrainQuery = "UPDATE trains SET seats_left = seats_left + ? WHERE train_id = ?";
        $stmt = $conn->prepare($updateTrainQuery);
        $stmt->bind_param("ii", $seats, $train_id);
        $stmt->execute();

        // Mark booking as cancelled
        $updateBookingQuery = "UPDATE bookings SET status = 'Cancelled' WHERE booking_id = ?";
        $stmt = $conn->prepare($updateBookingQuery);
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();

        echo "Booking cancelled successfully!";
    } else {
        echo "Invalid booking ID or booking is already cancelled.";
    }
}

$conn->close();
?>
