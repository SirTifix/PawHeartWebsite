<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../assets/js/java.js" defer></script>    
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/services.css">
    <title> SERVICES </title>

</head>
<body>
  <?php
  require_once('../include/header.php');
?>
    <main>
        <section class="first-container">
            <div class="container-fluid">
                <div class="tag-banner2 head text-center mt-5 py-3">
                    <h1 class="display-2 fw-bold">Our Services</h1>
                </div>
                <div class="first-row row justify-content-around my-1 mx-3">
                    <div class="boxes col-lg-5 col-md-5">
                        <h2>Pet Health & Wellness</h2>
                        <p class="text">Animal Wellness, Nutrition Assistance, Dental Care, and Internal Medicine</p>
                    </div>
                    <div class="boxes col-lg-5 col-md-5">
                        <h2>Specialty Pet Care</h2>
                        <p class="text">ECG/EKG, Illness Care, Radiology, Senior Care, Ultrasound</p>
                    </div>
                </div>
                <div class="second-row row justify-content-around my-1 mx-3">
                    <div class="boxes col-lg-5 col-md-5">
                        <h2>Critical Pet Care</h2>
                        <p class="text">Emergency Services, Euthanasia, Pain Management, and Surgery</p>
                    </div>
                    <div class="boxes col-lg-5 col-md-5">
                        <h2>Boarding</h2>
                        <p class="text">Ensure that your pets are safe and healthy while you are away.</p>
                    </div>
                </div>
                <div class="third-row row justify-content-around my-1 mx-3">
                    <div class="boxes col-lg-5 col-md-5">
                        <h2>Bathing and Grooming</h2>
                        <p class="text">Routine and therapeutic bathing services.</p>
                    </div>
                    <div class="boxes col-lg-5 col-md-5">
                        <h2>Dietary Counseling</h2>
                        <p class="text">Ensure to provide guidance regarding your pet's nutritional needs.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="second-container">
            <div class="container-fluid">
                <h1 class="tag-banner2 head display-3 fw-medium">Take care of your pets</h1>
                <div class="row my-5 py-3 justify-content-around">
                    <div class="image col-lg-5 col-md-5">
                        <img src="../assets/img/dog-cat-pic.png" class="pic img-fluid" alt="">
                    </div>
                    <div class="sec align-self-center col-lg-7 col-md-7">
                        <div class="row justify-content-center mx-2">
                            <p class="col-lg-8 col-md-8 fw-medium">We ensure the well-being of your pets. Please do not hesitate to contact our 
                                veterinarians with any inquiries. We are always willing to assist you.</p>
                            <button type="button" class="btn-contact fw-light col-md-4"><a href="../appointment_form.php">Contact Us</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php
    require_once('../include/footer.php')
    ?>
</body>
</html>