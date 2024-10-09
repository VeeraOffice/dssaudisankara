<?php
include('connection.php');

$intern_id = mysqli_real_escape_string($connection, $_POST['intern_id']);

// Fetch intern details
$query = "SELECT * FROM interns WHERE dss_id = '$intern_id'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $id = $row['dss_id'];
    $batch_no = $row['batch_no'];
} else {
    echo "<script>
            alert('Wrong intern ID');
            window.location.href='index.php';
          </script>";
    exit();
}

// Fetch attendance details
$query = "
    SELECT 
        COUNT(date) AS total_classes,
        SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) AS present_count
    FROM attendance
    WHERE dss_intern_id = '$intern_id'
";
$query_runner = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($query_runner);
$total_classes = $row['total_classes'];
$attended = $row['present_count'];
$attendance_percentage = ($total_classes > 0) ? ($attended / $total_classes) * 100 : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intern Attendance</title>
</head>
<body>
    <?php include('header.php') ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Your Attendance</h2>

        <!-- Intern Details -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Intern Details</h5>
                <p><strong>ID:</strong> <?php echo htmlspecialchars($id); ?></p>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
                <p><strong>Batch:</strong> <?php echo htmlspecialchars($batch_no); ?></p>
            </div>
        </div>

        <!-- Attendance Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT date, status FROM attendance WHERE dss_intern_id = '$intern_id'";
                    $result = mysqli_query($connection, $query);

                    if (mysqli_num_rows($result) > 0) {
                        $sno = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <td>{$sno}</td>
                                    <td>{$row['date']}</td>
                                    <td>{$row['status']}</td>
                                  </tr>";
                            $sno++;
                        }
                    } else {
                        echo "<tr><td colspan='3' class='text-center'>No attendance records found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Attendance Summary -->
        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Total Classes Conducted:</strong> <?php echo htmlspecialchars($total_classes); ?></p>
                <p><strong>Total Attended:</strong> <?php echo htmlspecialchars($attended); ?></p>
                <p><strong>Attendance Percentage:</strong> <?php echo htmlspecialchars(number_format($attendance_percentage, 2)); ?>%</p>
            </div>
        </div>
    </div>

    <?php include('footer.php') ?>
</body>
</html>
