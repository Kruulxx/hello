<?php
// Load the database configuration file
include_once 'connection.php';
require_once('home.php');  
// Get status message$result=mysqli_query($con,"select * from employee");
 
$con=mysqli_connect('localhost','root','','eirish_payroll');
$result=mysqli_query($con,"select * from attendancee");

if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>
<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Datatable</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
 
</head>
<body>
 <div class="container" style="margin-top:50px;">    
         
 <div class="border-bottom my-3"></div> 
            <div class="dropdown my-3">
            
        
       
            <a href="javascript:void(0);" class="btn btn-outline-primary" onclick="formToggle('importFrm');"><i class="plus"></i> Import Attendance</a>
      
 
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="import.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />

            <input type="submit" class="btn btn-outline-primary" name="importSubmit" value="IMPORT">
        </form>
    </div>
    <a href="javascript:void(0);" class="btn btn-outline-primary" onclick="formToggle('importFrm');"><i class="plus"></i> Archive</a>
                 
                      <div style="padding-top: 10px;" class="dropdown-menu">
                      <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown">
                      Add Attendance </button> 
                      <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#add-attendance">
                  Add Time In
                </button>
                           <button data-toggle="modal" data-target="#modal-add-attendance-out" class="dropdown-item">Add Time Out</button>
                      </div>

             </div>
             <div class="border-bottom my-3"></div>
          <table class="table table-hover">
                  <thead>
                      <tr>

                        <th>EmpID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Time In</th>
                        <th>Time Out</th>
                        <th>Status</th>
                        <th>Total Hours</th>
                      </tr>

                </thead>
                <tbody>
                          <?php while($row=mysqli_fetch_assoc($result)){?>
                      <tr>
                          <td><?php echo $row['emp_id']?></td>
                          <td><?php echo $row['name']?></td>
                          <td><?php echo $row['date']?></td>
                          <td><?php echo $row['time_in']?></td>
                          <td><?php echo $row['time_out']?></td>
                          <td><?php echo $row['status']?></td>
                          <td><?php echo $row['total_hours']?></td>
                      </tr>
                          

                          <?php } ?>
                    
                </thead>
              
              </table>
            
         <?php   require_once('addattendance.php');  ?>
      
  </div>
</div>
<br><br><br><br><br>
<?php require_once('footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready( function () {
		$('.table').DataTable();
  });
  </script>
 <!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
</body>
</html>
