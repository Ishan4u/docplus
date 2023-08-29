<?php

include './components/connect.php';

if (isset($_COOKIE['doc_id'])) {
    $doc_id = $_COOKIE['doc_id'];

} else {
    $doc_id = '';
    // header('location:pateint-login.php');
}

if(isset($_POST['delete'])){
    $a_id = $_POST['delete'];
    $delete = $conn->prepare("DELETE FROM appointment WHERE a_id = ?");
    if($delete->execute([$a_id])){
        echo '<script>alert("deleted")</script>';
        // echo 'deleted';
    }
    
}

$select_doc = $conn->prepare("SELECT * FROM doctors where doc_id=?");
$select_doc->execute([$doc_id]);
$fetch_doc = $select_doc->fetch(PDO::FETCH_ASSOC);
$doc_name = $fetch_doc['name'];


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
                <th scope="col">patients Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">phone</th>
                <th scope="col">Date</th>
                <th scope="col">Message</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $select_app = $conn->prepare("SELECT a.*, p.*, p.name as p_name FROM appointment a INNER JOIN patients p ON a.p_id = p.p_id   WHERE doctor =?");
                $select_app->execute([$doc_name]);
                while ($fetch_app = $select_app->fetch(PDO::FETCH_ASSOC)) { ?>
                    <th scope="row">1</th>
                    <td><?php echo $fetch_app['p_name'] ?></td>
                    <td><?php echo $fetch_app['email'] ?></td>
                    <td><?php echo $fetch_app['address'] ?></td>
                    <td><?php echo $fetch_app['phone'] ?></td>
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