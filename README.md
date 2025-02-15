🚆 Railway Train Booking System

📌 Overview

The Railway Train Booking System is a web-based application that allows users to search for trains, book tickets, manage their bookings, and view their profiles. It provides authentication features, a train listing system, and payment processing functionalities. The project is developed using PHP, MySQL, JavaScript, and Bootstrap, and it runs on a local XAMPP server.

✨ Features

✅ User Authentication: Users can sign up, log in, and log out securely.

🚄 Train Listings: Display available trains with details such as train ID, name, source, destination, departure time, arrival time, and available seats.

🎟️ Booking Management: Users can book train tickets and cancel bookings.

💳 Payment Processing: Supports different payment methods for booking confirmation.

👤 User Profile: View personal details including username, email, phone number, and profile picture.

🔎 Search Functionality: Allows users to search for trains based on name, source, or destination.

🛠 Installation

🔹 Prerequisites

Install XAMPP (Apache, MySQL, PHP, and phpMyAdmin) on your local system.

Enable Apache and MySQL from the XAMPP control panel.

🔹 Steps to Setup

Download and Extract the Project

Place all project files in the htdocs folder inside the XAMPP directory.

Database Setup

Open phpMyAdmin (http://localhost/phpmyadmin/).

Create a new database named railway_booking_system.

Import the provided database.sql file to set up the necessary tables.

Configure Database Connection

Open config.php and update the database connection settings:

<?php
$conn = new mysqli('localhost', 'root', '', 'railway_booking_system');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>

Start the Application

Open a web browser and go to: http://localhost/railway_project/index.html

📂 File Structure

/railway_project
│── index.html           # Main page with login & signup forms
│── login.php            # Handles user login
│── signup.php           # Handles user registration
│── logout.php           # Logs out the user
│── book_train.php       # Handles ticket booking
│── cancel_booking.php   # Handles booking cancellation
│── get_trains.php       # Fetches available train data
│── get_bookings.php     # Fetches user bookings
│── get_profile.php      # Fetches user profile data
│── profile.php          # User profile page
│── database.sql         # SQL file to set up database

🚀 Usage

Register or Login

New users need to sign up before accessing the system.

Existing users can log in using their credentials.

Search and Book Trains

Use the search bar to find trains.

Click on the Book button to reserve seats and complete payment.

Manage Bookings

View your bookings and cancel them if necessary.

Logout

Click the Logout button to exit the system securely.

🏗️ Technologies Used

Frontend: HTML, CSS, JavaScript, Bootstrap

Backend: PHP, MySQL

Database Management: phpMyAdmin

Server: Apache (XAMPP)

🔮 Future Enhancements

🎯 Implement seat selection during booking.

📧 Add email notifications for booking confirmations.

🎨 Enhance UI with better styling and responsiveness.

👨‍💻 Author

Developed by Arnav Dugad
