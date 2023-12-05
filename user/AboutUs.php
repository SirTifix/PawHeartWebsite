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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../vendor/bootstrap-5.0.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../assets/css/style.css">
        <script src="../assets/js/java.js" defer></script>  
        <link rel="stylesheet" href="../assets/css/style.css">  
        <link rel="stylesheet" href="../assets/css/aboutus.css">    
        <title> ABOUT US  </title>
    
    </head>
<body>
<?php
        require_once('../include/header.php');
    ?>
    <main>
        <section class="first-container">
            <div class="container-fluid">
                <div class="paragraph-one text-center">
                    <h1 class="tag-banner display-1 fw-bold">Why our client trust us?</h1>
                    <p class="fs-4">We ensure the well-being of your pets. We are your pets companion.</p>
                </div>
                <div class="first-sec row justify-content-around m-3">
                    <div class="col-lg-5 col-md-5 align-self-center" >
                            <img src="../assets/img/groupet.png" class="about-pic img-fluid" alt="">
                    </div>
                    <div class="col-lg-5 col-md-5 col align-self-center">
                                <div class="paragrahp-client mt-5 mb-3">
                                <h3>Our Goal</h3>
                                <p>Our mission is to assist clients' pets in living long, happy, and healthy lives. 
                                An excellent connection with the veterinarian is essential for your pet's well-being. 
                                Everyone at PawHeart Veterinary Clinic is dedicated to providing professional, compassionate,
                                and personalized service. PawHeart Veterinary Clinic takes pleasure in adhering to the best 
                                veterinary medicine standards. We have a full-service clinic with cutting-edge veterinary 
                                medical technologies.  </p>                          
                            </div>
                            </div>
                </div>
            </div>
        </section>
        <section >
            <div class="container-fluid">
                <div class="second-sec row justify-content-end"> 
                    <div class="col-lg-8 col-md-7 col-sm-6 align-self-center">
                        <div class="paragrahp-client">
                            <div class="pc-one row justify-content-center">
                                <img src="../assets/img/paw.png" class="paw col-3 mt-2" alt="">
                                <p class="text-one col-9">We care for our patients as if they were our own pets, and we strive to provide customers 
                                    with the treatment they envision and deserve.</p>
                            </div>
                            <div class="pc-one row justify-content-center">
                                <img src="../assets/img/paw.png" class="paw col-3 mt-2" alt="">
                                <p class="text-one col-9"> We adopt an individualized approach to each of our patients' long-term care and are 
                                    committed to giving our clients with enough knowledge to make proper decisions on the health care 
                                    of their animal companions.</p>
                            </div>
                            </div> 
                        </div>
                    <div class="col-lg-4 col-md-5 col-sm-6 ">
                        <img src="../assets/img/dog-cat.png" class="about-pic-sec img-fluid" alt="">
                     </div>
                 </div>
            </div>
        </section>
        <section class="second-container">
            <div class="third-sec" >
                <div class="container-fluid">
                    <div class="FAQ row justify-content-around">                        
                        <div class="question align-self-center col-lg-6">
                            <div class="FAQ mx-5">
                                <h1 class="tag-banner">Frequently asked questions</h1>
                                <button type="button" class="collapsible">When should I take my puppy or kitten to the veterinarian?</button>
                                <div class="content">
                                <p class="p-faq">We recommend that you take your pet to the vet within 2-3 days after bringing it home. Our veterinarian will
                                examine your pet's heart, look for hernias or other disorders, and look for parasites or other health issues 
                                that could compromise the well-being of your new pet or the existing pets in your household. We'll also go 
                                through the correct feeding and training techniques with you. Other new pets, such as rabbits and guinea pigs, 
                                should also get a health check.</p>
                                </div>
                                <button type="button" class="collapsible">Why do I need to test my pet for heartworm? </button>
                                <div class="content">
                                <p class="p-faq">Heartworm is a disease that will always be present in Wisconsin because we have mosquitoes and canines
                                     - both wild and domestic - that can carry the larvae that causes heartworm disease in their blood. When a mosquito 
                                     bites an infected animal, it picks up the larvae from that animal and then bites your pet, transferring the larvae 
                                     into your pet's bloodstream.</p>
                                </div>
                                <button type="button" class="collapsible">Why should I take my pet to a veterinarian?</button>
                                <div class="content">
                                <p class="p-faq">Even healthy pets should go to the vet at least once a year. Remember that each of our dogs and cats 
                                    lives for about 5-7 years. Many things can change throughout that time that you may not notice, which can have an impact 
                                    on your pet's general health and longevity.</p>
                                </div>
                                <button type="button" class="collapsible">Should I bring in a stool sample for parasite testing?</button>
                                <div class="content">
                                <p class="p-faq">Yes! We recommend screening a stool sample for intestinal parasites at least once a year, 
                                    or if your pet has diarrhoea, to check for common parasites like roundworm or hookworm. Both of these parasites can 
                                    create difficulties in humans, particularly children, therefore treating an infected animal as soon as possible is critical.</p>
                                </div>
                                <button type="button" class="collapsible">Should I use a flea and tick preventative on my pets?</button>
                                <div class="content">
                                <p class="p-faq">Yes! Fleas and ticks are venomous insects that can harm your pet's health. Using a flea and tick preventative 
                                    every 30 days starting in March should keep your pet safe from ticks during the early spring emergence. Continue to protect 
                                    your pet from the second tick outbreak and keep fleas at bay during the coldest months of the year.</p>
                                </div>
                            </div>
                        </div>
                        <div class="FAQ-pic col-lg-5 col-md-7">
                            <img src="../assets/img/FAQ-dog.png" class="about-pic img-fluid" alt="">
                        </div>
                    </div>
            </div>
            </div>
        </section>
    </main>
    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;
        
        for (i = 0; i < coll.length; i++) {
          coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
              content.style.display = "none";
            } else {
              content.style.display = "block";
            }
          });
        }
        </script>
  <?php
  require_once ('../include/footer.php')
  ?>
</body>
</html>

