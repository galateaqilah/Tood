<?php 
include 'db.php';

//select data yang akan diedit
$q_select = "SELECT * FROM task WHERE task_id = '".$_GET['id']."'";
$run_q_select = mysqli_query($conn, $q_select);
$d = mysqli_fetch_object($run_q_select);

//update data
if(isset($_POST['edit'])) {
    $q_update = "UPDATE task SET task_label ='".$_POST['task']."' WHERE task_id = '".$_GET['id']."'";
    $run_q_update = mysqli_query($conn, $q_update);

    header('Refresh:0; url=index.php');
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="stylez.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <!-- HTML TAMBAHAN -->
    <div class="title-Header">
        <h1 class="first-line"> Write it down, </h1>
        <h1 class="second-line"> Make your <span> Second brain. </span> </h1>

    </div>

        <h3 class="motto">a simple one for more simple to-dos list</h3>

        <div id="cursor"></div>
        <div id="cursor-border"></div>
    
    <div class="container">

        <!-- content -->
        <div class="content">
            <div class="card">
                <form class="theForm" action="" method="post">
                    <input name="task" type="text" class="input-control" placeholder="Edit Task" value="<?=$d->task_label?>">
                    <div class="text-right">
                        <button class="plus-btn" type="submit" name="edit"><i class='bx bx-edit'></i></button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</body>
<script src="script.js"></script>

</html>