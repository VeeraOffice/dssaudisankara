<?php
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Interns</title>

     <style>
          /* Make the table responsive */
.table-responsive {
     
    overflow-x: auto;
}

@media (max-width: 767.98px) {
    /* Apply to screens smaller than 768px (Bootstrap's md breakpoint) */
    
    .table thead {
        display: none; /* Hide table header */
    }
    
    .table, .table tbody, .table tr, .table td {
        display: block; /* Make everything block-level */
        width: 100%; /* Full width */
    }
    
    .table tr {
        margin-bottom: 1rem; /* Add space between rows */
        border: 1px solid #dee2e6; /* Optional: Add a border around each row */
        border-radius: 0.5rem; /* Optional: Add rounded corners */
        padding: 1rem; /* Optional: Add padding for spacing */
    }
    
    .table td {
        display: flex; /* Flexbox layout */
        justify-content: space-between; /* Space between label and content */
        align-items: center; /* Vertically align items */
        padding: 0.5rem 1rem; /* Padding inside each cell */
        border: none; /* Remove default table cell borders */
        border-bottom: 1px solid #dee2e6; /* Add border between items */
    }

    .table td:last-child {
        border-bottom: none; /* Remove border from the last item */
    }
    
    .table td::before {
        content: attr(data-label); /* Use the data-label attribute for labels */
        font-weight: bold; /* Make labels bold */
        flex-basis: 50%; /* Set label width */
        text-align: left; /* Align labels to the left */
        padding-right: 1rem; /* Space between label and content */
        color: #495057; /* Label text color */
    }
}

     </style>
</head>
<body>
     <?php include('header.php'); ?>

     <div class="container mt-5">
          <h1 class='text-center'>Interns Data</h1>
          <div class="d-flex justify-content-center mt-3 mb-3">
        <a href="intern_add.php" class="btn btn-primary">Add Intern</a>
    </div>
         <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">DSS_Intern_ID</th>
                <th scope="col">Intern Name</th>
                <th scope="col">Batch Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $query = "SELECT *
                      FROM interns order by dss_id asc";

            $query_runner = mysqli_query($connection, $query);

            if (mysqli_num_rows($query_runner) > 0) {
                $sno = 1;
                while ($row = mysqli_fetch_assoc($query_runner)) {
                    echo "<tr>
                            <td data-label='S.No'>{$sno}</td>
                            <td data-label='DSS_Intern_ID'>{$row['dss_id']}</td>
                            <td data-label='Intern Name'>{$row['name']}</td>
                            <td data-label='Batch Name'>{$row['batch_no']}</td>
                            <td data-label='Edit'><a href='edit_intern.php?id={$row['id']}' class='btn btn-secondary btn-sm'>Edit</a></td>
                            <td data-label='Delete'><a href='delete_intern.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a></td>
                          </tr>";
                    $sno++;
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No Interns Found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
          </div><br><br><br><br><br><br><br><br><br><br>

     <?php include('footer.php'); ?>

</body>
</html>