<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "railway_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch trains with optional search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT train_id, train_name, source_station, destination_station, departure_time, arrival_time, seats_left FROM trains";

if (!empty($search)) {
    $search = "%" . $conn->real_escape_string($search) . "%";
    $sql .= " WHERE train_name LIKE ? OR source_station LIKE ? OR destination_station LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $search, $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}

$trains = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $trains[] = $row;
    }
}
echo json_encode($trains);

$conn->close();
?>
