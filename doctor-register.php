<?php

include './components/connect.php';

if (isset($_COOKIE['doc_id'])) {
  $doc_id = $_COOKIE['doc_id'];
  header('location:doctor.php');
} else {
  $doc_id = '';
}

if (isset($_POST['submit'])) {

  $id = unique_id();
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);

  $phone = $_POST['phone'];
  $phone = filter_var($phone, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $department = $_POST['department'];
  $department = filter_var($department, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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

  $select_user = $conn->prepare("SELECT * FROM `doctors` WHERE email = ?");
  $select_user->execute([$email]);

  if ($select_user->rowCount() > 0) {
    // $message = 'email already taken!';
    echo '<script> alert("email already taken!"); </script>';
  } else {
    if ($pass != $cpass) {
    //   $message = 'confirm passowrd not matched!';
    echo '<script> alert("confirm passowrd not matched!"); </script>';
    } else {
      $insert_user = $conn->prepare("INSERT INTO `doctors`(doc_id, name, email, phone, department, pass) VALUES(?,?,?,?,?,?)");
      $insert_user->execute([$id, $name, $email, $phone, $department, $cpass]);
    //   move_uploaded_file($image_tmp_name, $image_folder);

      $verify_user = $conn->prepare("SELECT * FROM `doctors` WHERE email = ? AND pass = ? LIMIT 1");
      $verify_user->execute([$email, $pass]);
      $row = $verify_user->fetch(PDO::FETCH_ASSOC);

      if ($verify_user->rowCount() > 0) {
        setcookie('doc_id', $row['doc_id'], time() + 60 * 60 * 24 * 30, '/');
        header('location:index.php');
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
            <h2>Doctor Register Form</h2>
            
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
                <input type="email" class="form-control" name="email" id="subject" placeholder="Enter Email" required>
            </div>
            <div class="form-group mt-3">
                <input type="text" class="form-control" name="phone" id="subject" placeholder="Enter Phone No" required>
            </div>
            
            
            <div class="form-group mt-3">
                <input type="password" class="form-control" name="pass" id="subject" placeholder="Enter password" required>
            </div>
            <div class="form-group mt-3">
                <input type="password" class="form-control" name="cpass" id="subject" placeholder="Confirm password" required>
            </div>
            
            <div style="margin: 0 auto" class="col-md-12 form-group mt-3">
                <!-- <input type="text" class="form-control" name="department" id="subject" placeholder="Enter Department" required> -->
                <select name="department" id="" class="form-select">
                    <option value="">Select Department</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Neurology">Neurology</option>
                    <option value="Hepatology">Hepatology</option>
                    <option value="Pediatrics">Pediatrics</option>
                    <option value="Eye Care">Eye Care</option>
                </select>
            </div>
            
            <div class="text-center mt-3"><button name="submit" type="submit">Register</button></div>
            <div class="mt-2"><span>Already have an account</span> <a href="doctor-login.php">Login</a></div>
        </form>

    </div>
</section><!-- End Appointment Section -->
<?php include 'components/footer.php' ?>