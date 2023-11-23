<?php
include 'db.php';
// adding data
if (isset($_POST['add'])) {
    $q_insert = "INSERT INTO task (task_label, task_status) VALUE (
        '" . $_POST['task'] . "',
        'open'
    )";
    $run_q_insert = mysqli_query($conn, $q_insert);
    if ($run_q_insert) {
        header('Refresh:0; url=index.php');
    }
}

// show data
$q_select = "SELECT * FROM task ORDER BY task_id DESC";
$run_q_select = mysqli_query($conn, $q_select);

// delete data

if (isset($_GET['delete'])) {
    $q_delete = "DELETE FROM task WHERE task_id = '" . $_GET['delete'] . "' ";
    $run_q_delete = mysqli_query($conn, $q_delete);
    header('Refresh:0; url=index.php');
}

// update
if (isset($_GET['done'])) {
    $status = 'close';
    if ($_GET['status'] == 'open') {
        $status = 'close';
    } else {
        $status = 'open';
    }

    $q_update = "UPDATE task SET task_status = '" . $status . "'WHERE task_id = '" . $_GET['done'] . "' ";
    $run_update = mysqli_query($conn, $q_update);
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
        <h1 class="first-line"> Write it down </h1>
        <h1 class="second-line"> Make your <span> Second brain. </span> </h1>
    </div>

    <h3 class="motto">a simple one for more simple to-dos list</h3>

    <div id="cursor"></div>
    <div id="cursor-border"></div>
    <!--  -->

    <div class="container">
        <!-- header -->
        <div class="header">
            <div class="title">
                <i class='bx bxs-sun'></i>
                <span>
                    To Do List
                </span>
            </div>
            <div class="decription">
                <?= date("l, d M Y") ?>
            </div>
        </div>
        <!-- content -->
        <div class="content">
            <div class="card">
                <form class="theForm" action="" method="post">
                    <input name="task" type="text" class="input-control" placeholder="Write it down here...">
                    <div class="text-right">
                        <button class="plus-btn" type="submit" name="add"> <i class='bx bx-plus'></i> </button>
                    </div>
                </form>
            </div>
            <!-- tugas -->
            <?php
            if (mysqli_num_rows($run_q_select) > 0) {
                while ($r = mysqli_fetch_array($run_q_select)) {

                    ?>
                    <div class="card">
                        <div class="task-item <?= $r['task_status'] == 'close' ? 'done' : '' ?>">
                            <div>
                                <input type="checkbox"
                                    onclick="window.location.href='?done=<?= $r['task_id'] ?>&status=<?= $r['task_status'] ?>'"
                                    <?= $r['task_status'] == 'close' ? 'checked' : '' ?>>
                                <span class="task-input">
                                    <?= $r['task_label'] ?>
                                </span>
                            </div>

                            <div class="edit-delete">
                                <a href="edit.php?id=<?= $r['task_id'] ?>" class='edit-task' title="Edit"><i
                                        class='bx bx-edit'></i></a>
                                <a href="?delete=<?= $r['task_id'] ?>" class="delete-task" title="Remove"
                                    onclick="return confirm ('Are u sure?')"><i class='bx bx-trash'></i></a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="no-data"> there's no list here ❌</div>

            <?php } ?>

        </div>
    </div>
    </div>
</body>
<script src="script.js"></script>

</html>