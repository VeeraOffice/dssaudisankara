<?php
include('connection.php');

// Fetch data from the contests table
$query = "SELECT * FROM contests ORDER BY id ASC";
$query_runner = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="style.css"/>
     <title>Contests</title>

    
</head>
<body>
     <?php include('header.php'); ?>

     <div class="container mt-5">
          <h3 class='text-center mb-5'>Dss Coding Contests</h3>
          
          <div class="table-responsive">
              <table class="table table-striped table-bordered">
                  <thead class="table-dark">
                      <tr>
                          <th scope="col">S.No</th>
                          <th scope="col">Contest Name</th>
                          <th scope="col">Conducted On</th>
                          <th scope="col">Start Time</th>
                          <th scope="col">End Time</th>
                          <th scope="col">Link</th>
                        
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      if (mysqli_num_rows($query_runner) > 0) {
                          $sno = 1;
                          while ($row = mysqli_fetch_assoc($query_runner)) {
                              echo "<tr>
                                      <td data-label='S.No'>{$sno}</td>
                                      <td data-label='Contest Name'>{$row['contest_name']}</td>
                                      <td data-label='Conducted On'>{$row['date']}</td>
                                      <td data-label='Start Time'>{$row['start_time']}</td>
                                      <td data-label='End Time'>{$row['end_time']}</td>
                                      <td data-label='Link'><a href='{$row['link']}' class='btn btn-primary btn-sm' target='_blank'>Go to Contest</a></td>
                                     
                                    </tr>";
                              $sno++;
                          }
                      } else {
                          echo "<tr><td colspan='8' class='text-center'>No Contests Found</td></tr>";
                      }
                      ?>
                  </tbody>
              </table>
          </div>
     </div>

     <?php include('footer.php'); ?>

</body>
</html>
