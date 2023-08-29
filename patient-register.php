<?php

include './components/connect.php';

if (isset($_COOKIE['p_id'])) {
  $p_id = $_COOKIE['p_id'];
  header('location:appoinment.php');
} else {
  $p_id = '';
}

if (isset($_POST['submit'])) {

  $id = unique_id();
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);

  $phone = $_POST['phone'];
  $phone = filter_var($phone, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $address = $_POST['address'];
  $address = filter_var($address, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  
  $cpass = sha1($_POST['cpass']);
  $cpass = filter_var($cpass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//   $image = $_FILES['image']['name'];
//   $image = filter_var($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//   $ext = pathinfo($image, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//   $rename = unique_id() . '.' . $ext;
//   $image_size = $_FILES['image']['size'];
//   $image_tmp_name = $_FILES['image']['tmp_name'];
//   $image_folder = 'uploaded_files/' . $rename;

  $select_user = $conn->prepare("SELECT * FROM `patients` WHERE email = ?");
  $select_user->execute([$email]);

  if ($select_user->rowCount() > 0) {
    // $message = 'email already taken!';
    echo '<script> alert("email already taken!"); </script>';
  } else {
    if ($pass != $cpass) {
    //   $message = 'confirm passowrd not matched!';
    echo '<script> alert("confirm passowrd not matched!"); </script>';
    } else {
      $insert_user = $conn->prepare("INSERT INTO `patients`(p_id, name, email, phone, address, pass) VALUES(?,?,?,?,?,?)");
      $insert_user->execute([$id, $name, $email, $phone, $address, $cpass]);
    //   move_uploaded_file($image_tmp_name, $image_folder);

      $verify_user = $conn->prepare("SELECT * FROM `patients` WHERE email = ? AND pass = ? LIMIT 1");
      $verify_user->execute([$email, $pass]);
      $row = $verify_user->fetch(PDO::FETCH_ASSOC);

      if ($verify_user->rowCount() > 0) {
        setcookie('p_id', $row['p_id'], time() + 60 * 60 * 24 * 30, '/');
        header('location:appoinment.php');
      }
    }
  }

}

?>

<?php include 'components/header.php' ?>
</section><!-- End Breadcrumbs Section -->

<section class="inner-page">
    <div class="container">

    </div>
</section>

</main><!-- End #main -->
<!-- ======= Appointment Section ======= -->
<section id="appointment" class="appointment section-bg">
    <div  class="container text-center">

        <div class="section-title">
            <h2>Patient Register Form</h2>
            
        </div>

        <form style="width: 30%; margin: 0 auto;"  method="post" role="form" class="php-email-form">
            <!-- <div class="row">
                <div class="col-md-6  form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
            </div> -->
            <div class="form-group mt-3">
                <input type="text" class="form-control" name="name" id="subject" placeholder="Enter Name" required>
            </div>
            <div class="form-group mt-3">
                <input type="email" class="form-control" name="email" id="subject" placeholder="Enter email" required>
            </div>
            <div class="form-group mt-3">
                <input type="text" class="form-control" name="phone" id="subject" placeholder="Enter phone" required>
            </div>
            <div class="form-group mt-3">
                <input type="text" class="form-control" name="address" id="subject" placeholder="Enter Address" required>
            </div>
            <div class="form-group mt-3">
                <input type="password" class="form-control" name="pass" id="subject" placeholder="Enter password" required>
            </div>
            <div class="form-group mt-3">
                <input type="password" class="form-control" name="cpass" id="subject" placeholder="Confirm password" required>
            </div>
            
            
            <div class="text-center mt-3"><button name="submit" type="submit">Register</button></div>
            <div class="mt-2"><span>Already have an account</span> <a href="patient-login.php">Login</a></div>
        </form>

    </div>
</section><!-- End Appointment Section -->
<?php include 'components/footer.php' ?>