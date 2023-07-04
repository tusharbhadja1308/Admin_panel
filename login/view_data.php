<?php 
    include "db.php";


    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query="DELETE FROM info WHERE id=$id";
        mysqli_query($conn, $query);
        $success = "Data deleted successfully.";
        header('location:view_data.php');
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
    table,th,td{
        border-collapse: collapse;
        padding: 5px;
    }
</style>

</head>
<body>

    <br>
    <a href="welcome.php" class="btn btn-primary">go Back</a>
    <br><br>

    <?php
        $sqlSelect = "SELECT * from info";

        $result = mysqli_query($conn, $sqlSelect);

        if(mysqli_num_rows($result) > 0){
            ?>
                <table border="1" >
                    <thead >
                        <tr>
                            <th>Username</th>
                            <th>Contact</th>
                            <th>Age</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <?php

                        while($row = mysqli_fetch_array($result)){
                            ?>
                            <tr>    
                            <td><?php echo $row['username']?></td>
                            <td><?php echo $row['contact']?></td>
                            <td><?php echo $row['age']?></td>
                            <td><?php echo $row['email']?></td>
                            <td><a href="edit.php?edit=<?php echo $row["id"]; ?>" class="edit_btn btn btn-primary">Edit</a>
                            <a href="view.php?view=<?php echo $row["id"];?>" class="edit_btn btn btn-primary">view</a>
                            <a href="view_data.php?delete=<?php echo $row["id"]; ?>" class="del_btn btn btn-danger">Delete</a> 
                            </td>
                            
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            <?php
        }
        else{
            echo "data not found";
        }

    ?>
</body>
</html>