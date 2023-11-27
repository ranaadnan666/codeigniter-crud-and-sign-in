<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

  <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>


</head>
<body>

<h2>List data demo</h2>
<p>Resize the browser window to see the effect. When the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other.</p>

<div class="container">
 <div style="text-align:right;padding:10px"> <a href="<?= base_url('index.php/create/index') ?>"><button>Add Record</button></a></div>
<table>
<tr>
  <th>ID</th>
  <th>Name</th>
  <th>Email</th>
  <th>City</th>
  <th>Action</th>
</tr>  
<?php foreach ($user as $row) : ?>
  <!-- <?=form_open_multipart('Delete/delete_ajax/')?> -->
  <form method="post" action="<?=base_url('index.php/edit/index/' . $row->Id)?>">
  <input type="hidden" id="userId" value="<?= $row->Id ?>">

               <tr>
                <td><?php echo $row->Id; ?></td>
                <td><?php echo $row->name; ?></td>
                <td><?php echo $row->email; ?></td>
                <td><?php echo $row->city; ?></td>
                <td><button type="submit">Edit</button> 
                <a href="<?= base_url('index.php/Delete/delete_user/' . $row->Id) ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
               <!-- delete with ajax -->
                <!-- <button onclick=" deleteRecord(<?= $row->Id ?>)">Delete Data</button> -->
                <!-- (<?php echo $row->Id; ?>) -->
              </td>
               </tr>
               <!-- <?=form_close()?> -->
  </form>
               <?php endforeach; ?>
   
</table>
</div>
<script>
 function deleteRecord(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        // AJAX call to delete record
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    // Reload the page or update the UI as needed
                    location.reload();
                } else {
                    alert('Failed to delete data. Please try again.');
                }
            }
        };

        var params = "id=" + userId; // Corrected the parameter name
        xmlhttp.open("POST", '<?= base_url("index.php/Delete/delete_ajax/") ?>', true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(params);
    }
}

</script>
  
    
</script>
</body>
</html>
