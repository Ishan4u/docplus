<?php
include './components/connect.php';

if (isset($_COOKIE['doc_id'])) {
  $doc_id = $_COOKIE['doc_id'];
  header('location:doctor.php');
} else {
  $doc_id = '';
}


if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $select_user = $conn->prepare("SELECT * FROM `doctors` WHERE email = ? AND pass = ? LIMIT 1");
  $select_user->execute([$email, $pass]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  if ($select_user->rowCount() > 0) {
    setcookie('doc_id', $row['doc_id'], time() + 60 * 60 * 24 * 30, '/');
    header('location:doctor.php');
  } else {
    // $message = 'incorrect email or password!';
    echo '<script> alert("incorrect email or password!!"); </script>';
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
            <h2>Doctor Login Form</h2>
            
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
                <input type="email" class="form-control" name="email" id="subject" placeholder="email" required>
            </div>
            <div class="form-group mt-3">
                <input type="password" class="form-control" name="pass" id="subject" placeholder="password" required>
            </div>
            
            
            <div class="text-center mt-3"><button name="submit" type="submit">Login</button></div>
            <div class="mt-2"><span>Don't have an Account</span> <a href="doctor-register.php">Register</a></div>
        </form>

    </div>
</section><!-- End Appointment Section -->
<?php include 'components/footer.php' ?>