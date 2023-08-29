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
            <h2>Login Form</h2>
            
        </div>

        <form style="width: 30%; margin: 0 auto;" action="forms/contact.php" method="post" role="form" class="php-email-form">
            <!-- <div class="row">
                <div class="col-md-6  form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
            </div> -->
            <div class="form-group mt-3">
                <input type="email" class="form-control" name="subject" id="subject" placeholder="email" required>
            </div>
            <div class="form-group mt-3">
                <input type="password" class="form-control" name="subject" id="subject" placeholder="password" required>
            </div>
            
            
            <div class="text-center mt-3"><button type="submit">Login</button></div>
            <div class="mt-2"><span>Don't have an Account</span> <a href="">Register</a></div>
        </form>

    </div>
</section><!-- End Appointment Section -->
<?php include 'components/footer.php' ?>