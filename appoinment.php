<?php

include './components/connect.php';

if (isset($_COOKIE['p_id'])) {
    $p_id = $_COOKIE['p_id'];

} else {
    $p_id = '';
    header('location:pateint-login.php');
}


if (isset($_POST['submit'])) {

    
    $date = $_POST['date'];
    $department = $_POST['department'];
    $doctor = $_POST['doctor'];
    $message = $_POST['message'];

    $insert = $conn->prepare("INSERT INTO appointment(p_id,doctor,date, department, message) VALUES(?,?,?,?,?)");
    if($insert->execute([$p_id, $doctor, $date, $department, $message])){
        echo '<script> alert("Success"); </script>';
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
    <div class="container">

        <div class="section-title">
            <h2>Make an Appointment</h2>
            <!-- <p>.</p> -->
        </div>
        <?php

        ?>
        <form method="post" role="form" class="php-email-form">
            <div class="row">
                <!-- <div class="col-md-4 form-group">
                    <input type="hidden" name="name" class="form-control" id="name"
                        value="" data-rule="minlen:4"
                        data-msg="Please enter at least 4 chars">
                    <div class="validate"></div>
                </div> -->
                <!-- <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="hidden" class="form-control" name="email" id="email" placeholder="Your Email"
                        data-rule="email" data-msg="Please enter a valid email">
                    <div class="validate"></div>
                </div> -->
                <!-- <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="hidden" class="form-control" name="phone" id="phone" placeholder="Your Phone"
                        data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                    <div class="validate"></div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-md-4 form-group mt-3">
                    <input type="datetime" name="date" class="form-control datepicker" id="date"
                        placeholder="Appointment Date" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                    <div class="validate"></div>
                </div>
                <div class="col-md-4 form-group mt-3">
                    <select name="department" id="department" onchange="getDepartment()" class="form-select">
                        <option value="">Select Department</option>
                        <option value="Cardiology">Cardiology</option>
                        <option value="Neurology">Neurology</option>
                        <option value="Hepatology">Hepatology</option>
                        <option value="Pediatrics">Pediatrics</option>
                        <option value="Eye Care">Eye Care</option>
                    </select>
                    <div class="validate"></div>
                </div>
                <div class="col-md-4 form-group mt-3">

                    <select name="doctor" id="doctor" class="form-select">
                        <option value="">Select Doctor</option>
                        <option value="Doctor 1">Doctor 1</option>
                        <option value="Doctor 2">Doctor 2</option>
                        <option value="Doctor 3">Doctor 3</option>
                    </select>
                    <div class="validate"></div>
                </div>
            </div>

            <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
                <div class="validate"></div>
            </div>
            <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
            </div>
            <div class="text-center"><button name="submit" type="submit">Make an Appointment</button></div>
        </form>

    </div>
</section><!-- End Appointment Section -->

<!-- js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#department').change(function () {
            var department = $(this).val();

            $.ajax({
                url: 'getDoctors.php',
                type: 'post',
                data: { department: department },
                dataType: 'json',
                success: function (response) {
                    var len = response.length;

                    $("#doctor").empty();
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['doc_id'];
                        var name = response[i]['name'];

                        $("#doctor").append("<option value='" + name + "'>" + name + "</option>");
                    }
                }
            });
        });
    });
</script>


<?php include 'components/footer.php' ?>