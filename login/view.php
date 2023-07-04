<?php

    include "db.php";
    

    if(isset($_GET['view'])){
        $id = $_GET['view'];

        $sql_user_select = "SELECT * FROM info WHERE id=$id";
        $result= mysqli_query($conn, $sql_user_select);
        $data = mysqli_fetch_array($result);

        if($data){
            $username = $data['username'];
            $contact = $data['contact'];
            $age = $data['age'];
            $email = $data['email'];
            $profile_img = $data['profile_img'];
        } else{
            echo "error in fetching data";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View </title>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="view.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="profile">
                <div class="img">
                <img src="<?php echo '../login/images/'.$profile_img; ?>" alt="<?php echo $profile_img . '`sProfile Image'; ?>">
                </div>
                <br>
                <div class="name"><?php echo $username;?></div>


            </div>
        </div>
        <div class="right">
            <div class="contain">
            <h2 class="text-center mt-2">General Information</h2>

            <div class="info">
            <div>Username : <?php echo $username ;?></div>
            <div>Contact : <?php echo $contact ;?></div>
            <div>Age : <?php echo $age ;?></div>
            <div>Email : <?php echo $email ;?></div>
            <div><a href="view_data.php" class="btn btn-primary">Go Back</a></div>
            </div>
            </div>
        </div>
    </div>
</body>
</html> 