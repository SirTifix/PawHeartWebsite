<?php
  session_start();
  /*
      if user is not login then redirect to login page,
      this is to prevent users from accessing pages that requires
      authentication such as the dashboard
  */
  if (!isset($_SESSION['user']) || $_SESSION['user'] != 'users'){
      header('#');
  }
?>

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/services.css">
    <script src="./assets/js/java.js" defer></script>    
    <title> PawHeart </title>

</head>
<body>

<?php
        require_once('./include/header.first.php');
    ?>

    <main>
      <section class="sect1 mt-5 pt-3 mb-5 pb-5 text-center">
        <div class="container mt-5 pt-5">
            <div class="row my-5 py-3">
                <div class="image col-lg-7">
                    <img src="./assets/img/HomePic.png" class="pic img-fluid" alt="">
                </div>
                <div class="sec justify-content-center mt-5 pt-5 col-lg-5">
                    <div class="banner-1 row justify-content-center mx-2">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <h2 class="h2" id="cont1"> VETERINARY </h2>
                            <h4 class="h4" id="cont2">We care for your pets </h4>  
                            <h6 class="h6" id="cont3">MEDICAL AND CARE SERVICES</h6>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <button type="button" class="btn btn-book fw-light"><a href="./user/appointment_form.php">Book an Appointment now!</a></button>  
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>

    
    
    
       
    
    <section id="FIRST-CONT" class="mt-5 pt-3 my-3">
      <div class="container-fluid ">
          <div class="text-center mb-4">
              <h1 class=" tag-banner2 display-3 fw-medium">We take care of your pet</h1>
          </div>
          <div class=" Firstbanner row justify-content-center text-center">
              <div class="pet-image-container align-self-center text-center col-12 col-md-6 col-lg-4"> 
                    <img src="./assets/img/pet-surgery.jpg" class=" picture-feat img-fluid"  alt="" srcset="">
                    <p class="image-title text-center my-2"> SURGERIES </p>    
              </div>
              <div class="pet-image-container align-self-center text-center col-12 col-md-6 col-lg-4">
                  <img src="./assets/img/pet-heath.jpg" class="picture-feat img-fluid" alt="" srcset="">
                  <p class="image-title text-center my-2"> HEALTH </p>
              </div>
              <div class="pet-image-container align-self-center text-center col-12 col-md-6 col-lg-4">
                  <img src="./assets/img/pet-grooming.jpg" class="picture-feat img-fluid" alt="" srcset="">
                  <p class="image-title text-center my-2"> PET-GROOMING </p>
              </div>
              <div class="pet-image-container align-self-center text-center col-12 col-md-6 col-lg-4">
                  <img src="./assets/img/pet-vaccines.jpg" class="picture-feat img-fluid" alt="" srcset="">
                  <p class="image-title text-center my-2"> VACCINES </p>  
              </div>
          </div>
      </div>
  </section>
    
    <section id="SECOND-CONT" class="my-3">
        <div class="container-fluid">
            <div class="text-center mb-4">
                <h1 class=" tag-banner2 display-3 fw-medium"> Stay tune for the upcoming events </h1>
            </div>
            <div class="row justify-content-center align-items-center ">
                <div class="pet-image-container col-12 col-md-6 col-lg-4 d-flex flex-column align-items-center">
                     <div class="contint2">
                    <img src="./assets/img/adaption.jpg" class="picture-feat2 img-fluid" alt="" srcset="">
                   
                    <p class="image-title text-center my-2"> Adoption Campaign </p>
                    <p class="pet-desc text-center my-2"> Support your local Shelters by Adopting a pet to recude the number of homeless animals looking for fur-parents to provide them a loving home. Make yourself happy by making them happy.</p>
                </div>
                </div>
                <div class="pet-image-container col-12 col-md-6 col-lg-4 d-flex flex-column align-items-center">
                    <div class="contint2">
                    <img src="./assets/img/anti-rabies.jpg" class="picture-feat2 img-fluid" alt="" srcset="">
                    
                    <p class="image-title text-center my-2"> Anti-rabies Awareness</p>
                    <p class="pet-desc text-center my-2"> Anti-rabies Awareness is important that aims to inform and notify people of rabies, aiming to educate people about the dangers of rabies and the preventive measures to save lives and eradicate the disease.</p>
                  </div>
                  </div>
                <div class="pet-image-container col-12 col-md-6 col-lg-4 d-flex flex-column align-items-center">
                  <div class="contint2">
                  <img src="./assets/img/pet-month.jpg" class="picture-feat2 img-fluid" alt="" srcset="">
                    
                    <p class="image-title text-center my-2"> Pet Month </p>
                    <p class="pet-desc text-center my-2"> Celebrate Pet month with your furry and wild friends showing appreciation for the extraordinary pets that we have having them alongside us everyday also in their care making us happy.</p>
                  </div>
                  </div>
            </div>
        </div>
    </section>
    <section class="THIRD-CONT">
      <div class=" Customer-review container-fluid row justify-content-center align-items-center">
        <div class="text-center col-12">
          <h1 class=" tag-banner2 display-3 fw-medium"> Our Happy Clients </h1>
          </div>
          <div class="row justify-content-around col-12">
            <div class="client-review-container col-12 col-sm-6 col-md-6 col-lg-4 ">
              <div class="contint3 row">
             <p class="pet-desc2 text-center my-2 col"> Support your local Shelters by Adopting. Make yourself happy by making them happy.</p>
            <p class="text-client-img"> <img src="./assets/img/alvan.jpg" class="picture-owner-review col" alt="jake"> Kylo Ren Grey </p>
         </div>
         </div>
         <div class="client-review-container col-12 col-sm-6 col-md-6 col-lg-4 ">
          <div class="contint3 row">
         <p class="pet-desc2 align-self-center col"> Support your local Shelters by Adopting. Make yourself happy by making them happy.</p>
         <p class="text-client-img"> <img src="./assets/img/flouffy.jpg" class="picture-owner-review col" alt="smile"> Jake the Dawg </p>
     </div>
     </div>
      </div>
      </div>
      </div>
    </section>
      <section class="second-container">
        <div class="container-fluid">
            <h1 class="tag-banner2 head display-3 fw-medium">Take care of your pets</h1>
            <div class="row my-5 py-3 justify-content-center">
                <div class="image col-lg-5 col-md-5">
                    <img src="./assets/img/pet-doctor.png" class="pic img-fluid" alt="">
                </div>
                <div class="sec align-self-center col-lg-7 col-md-7">
                    <div class="row justify-content-center mx-2">
                        <p class="col-lg-8 col-md-8 fw-medium">Do you know that it is advisable to examine your pet every six months?
                           Book an appointment now!</p>
                        <button type="button" class="btn-contact fw-light col-md-4"><a href="./user/appointment_form.php">Book Now!</a></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
   
<?php
require_once('./include/footer.php')
?>
</body>
</html>

