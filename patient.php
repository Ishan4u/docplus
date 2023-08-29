<?php

include './components/connect.php';

if (isset($_COOKIE['p_id'])) {
    $p_id = $_COOKIE['p_id'];

} else {
    $p_id = '';
    header('location:pateint-login.php');
}

if(isset($_POST['delete'])){
    $a_id = $_POST['delete'];
    $delete = $conn->prepare("DELETE FROM appointment WHERE a_id = ?");
    if($delete->execute([$a_id])){
        echo '<script>alert("deleted")</script>';
        // echo 'deleted';
    }
    
}
?>

<?php include 'components/header.php' ?>
<section class="inner-page">
    <div class="container">

    </div>
</section>
<div class="container">
    <div class="section-title">
        <h2>Applied Appointments</h2>
        <!-- <p>.</p> -->
    </div>



    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Doctor Name</th>
                <th scope="col">Department</th>
                <th scope="col">Date</th>
                <th scope="col">Message</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $select_app = $conn->prepare("SELECT * FROM appointment WHERE p_id =?");
                $select_app->execute([$p_id]);
                while ($fetch_app = $select_app->fetch(PDO::FETCH_ASSOC)) { ?>
                    <th scope="row">1</th>
                    <td><?php echo $fetch_app['doctor'] ?></td>
                    <td><?php echo $fetch_app['department'] ?></td>
                    <td><?php echo $fetch_app['date'] ?></td>
                    <td><?php echo $fetch_app['message'] ?></td>
                    <td>
                        <form method="post">
                        <button name="delete" value="<?php echo $fetch_app['a_id'] ?>" type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php include 'components/footer.php' ?>