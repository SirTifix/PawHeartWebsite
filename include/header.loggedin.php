<header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-logo1" href="#"><img src="../assets/img/no-bg-bg.png" alt="" class="navbar-logo" srcset=""></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../user/AboutUs.php">About us</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../user/Services.php">Services</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../user/appointment_form.php">Booking</a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link" href="../user/login.php">Log in</a>
                  </li> -->
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     Account
                    </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #F78CA2; border: 2px solid #fff;">
                      <!-- Add the links/options inside the dropdown -->
                      <li><a class="dropdown-item" href="../user/appointment_list.php">Appointments</a></li>
                      <li><a class="dropdown-item" href="../user/user_profile.php">Profile</a></li>
                      <form method="post" action="logout.php">
                      <li><a class="dropdown-item" href="../user/logout.php">Logout</a></li>
                      </form>
                </ul>
                </li>
              </div>
            </div>
          </nav>
    </header>

    <style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        display: none;
        float: left;
        min-width: 10rem;
        padding: .5rem 0;
        margin: .125rem 0 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .text-pink {
    color: #F78CA2 !important;
}

.dropdown-item:hover {
    background-color: #fff;
    color: #F78CA2;
}
</style>