<?php
// establish database connection
$servername = "192.168.150.213";
$username = "webprogss211";
$password = "fancyR!ce36";
$dbname = "webprogss211";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check if connection failed
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// handle search query
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM jdgonzales2_myguests WHERE ANSname LIKE '%$search%' OR email LIKE '%$search%' OR ANSmessage LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM jdgonzales2_myguests";
}
$result = mysqli_query($conn, $sql);

// close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Guest List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid py-5">
        <div class="container">
            <h1 class="display-2 text-uppercase text-center mb-5" style="-webkit-text-stroke: 2px #dee2e6;">Guest List</h1>
            <form class="form-inline justify-content-center mb-3" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Search...">
                </div>
                <button type="submit" class="btn btn-primary ml-2">Search</button>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>" . $row["ANSname"] . "</td><td>" . $row["email"] . "</td><td>" . $row["ANSsubject"] . "</td><td>" . $row["ANSmessage"] . "</td><tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No results found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="text-center">
                <a href="index.html" class="btn btn-primary">Back to Contact Form</a>
            </div>
        </div>
    </div>
</body>

</html>
