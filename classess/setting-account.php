<?php

    require_once '../classess/user.class.php';
    require_once  '../tools/functions.php';

    $user = new User();
    //resume session here to fetch session values
    session_start();
    // Check if the user is logged in
    if (!isset($_SESSION['id'])) {
      // Redirect to the login page or another page as needed
      header("Location: index.php");
      exit();
    } 
    
    //if the above code is false then html below will be displayed

    // Fetch information for the logged-in user
    $id = $_SESSION['id'];
    $user = new User();
    $record = $user->fetch($id);
  
    if ($record) {
        $user->id = $record['id'];
        $user->name = $record['name'];
        $user->email = $record['email'];
        $user->contact = $record['contact'];
        $user->password = $record['password'];
        $old_email = $user->email;
        $user->petName = $record['petName'];
        $user->petType = $record['petType'];
        $user->petAge = $record['petAge'];

    } else {
        // Handle the case where user information couldn't be retrieved
        // You might want to redirect to an error page or handle it in another way
        header("Location: #");
        
    }

    if(isset($_POST['save'])){
        $user = new User();
        //sanitize
        $user->id = $id;
        $user->last_name = htmlentities($_POST['name']);
        $user->first_name = htmlentities($_POST['email']);
        $user->email = htmlentities($_POST['contact']);
        $user->year_level = htmlentities($_POST['password']);
        $user->section = htmlentities($_POST['petName']);
        $user->section = htmlentities($_POST['petType']);
        $user->section = htmlentities($_POST['petAge']);

        //validate
        if (validate_field($user->name) &&
        validate_field($user->contact) &&
        validate_field($user->password) &&
        validate_field($user->petName) &&
        validate_field($user->petType) &&
        validate_email($user->petAge)){
            if($old_email != $user->email){
                if(!$user->is_email_exist()){
                    if($user->edit()){
                        header('location: setting-account.php');
                    }else{
                        echo 'An error occured while adding in the database.';
                    } 
                }
            }else{
                if($user->edit()){
                    header('location: setting-account.php');
                }else{
                    echo 'An error occured while adding in the database.';
                } 
            }
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
  <?php
    $title = 'Account';
    $settings = 'active';
    require_once('../include/head.php');
  ?>
    <body>
      <?php
        require_once('../include/header.user.php');
      ?>

        <main id="courselist">
          <div class="container mt-5">
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <!-- Settings navigation tabs -->
                    <ul class="nav flex-column nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" id="accounts-tab" data-bs-toggle="pill" href="#accounts">Accounts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="notifications-tab" data-bs-toggle="pill" href="#notifications">Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="privacy-tab" data-bs-toggle="pill" href="#privacy">Privacy and Security</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="help-tab" data-bs-toggle="pill" href="#help">Help and Support</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger mt-4" href="../tools/logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-12 col-md-9 pt-3">
                    <!-- Settings content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="accounts">
                            <h3>Accounts Settings</h3>
                            <!-- Include account settings content here -->
                            <div class="row">
                              <div class="col-sm-12 col-md-4 text-center pb-4">
                              <?php
                                $imageData = base64_encode($user->profile_pic);
                                $imageSrc = "data:image/jpeg;base64," . $imageData;
                              ?>
                                <div class="image2"><img src="<?php echo $imageSrc; ?>"></div>
                              </div>
                              <div class="col-sm-12 col-md-8">
                              <form method="post" action="" enctype="multipart/form-data">
                                <div class="row">
                                <div class="mb-3">
                                          <label for="profile_pic" class="form-label">Upload New Profile Picture</label>
                                          <input type="file" class="form-control" id="profile_pic" name="profile_pic" accept="image/*" value="<?php if(isset($_POST['profile_pic'])) { echo $_POST['profile_pic']; }?>">
                                        </div>
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="last_name" class="form-label">Last Name</label>
                                      <input type="text" class="form-control" id="last_name" name="last_name" required value="<?php if(isset($_POST['last_name'])) { echo $_POST['last_name']; }else if(isset($user->last_name)) { echo $user->last_name; } ?>">
                                      <?php
                                          if(isset($_POST['last_name']) && !validate_field($_POST['last_name'])){
                                      ?>
                                              <p class="text-danger my-1">Last Name is required</p>
                                      <?php
                                          }
                                      ?>
                                    </div>
                                  </div>
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="first_name" class="form-label">First Name</label>
                                      <input type="text" class="form-control" id="first_name" name="first_name" required value="<?php if(isset($_POST['first_name'])) { echo $_POST['first_name']; }else if(isset($user->first_name)) { echo $user->first_name; } ?>">
                                      <?php
                                          if(isset($_POST['first_name']) && !validate_field($_POST['first_name'])){
                                      ?>
                                              <p class="text-danger my-1">First Name is required</p>
                                      <?php
                                          }
                                      ?>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="year_level" class="form-label">Year</label>
                                      <select name="year_level" id="year_level" class="form-select">
                                          <option value="">Select Year Level</option>
                                          <option value="BS Computer Science 1" <?php if(isset($_POST['year_level']) && $_POST['year_level'] == 'BS Computer Science 1') { echo 'selected'; }else if(isset($user->year_level) && $user->year_level == 'BS Computer Science 1') { echo 'selected'; } ?>>BS Computer Science 1</option>
                                          <option value="BS Computer Science 2" <?php if(isset($_POST['year_level']) && $_POST['year_level'] == 'BS Computer Science 2') { echo 'selected'; }else if(isset($user->year_level) && $user->year_level == 'BS Computer Science 2') { echo 'selected'; } ?>>BS Computer Science 2</option>
                                          <option value="BS Computer Science 3" <?php if(isset($_POST['year_level']) && $_POST['year_level'] == 'BS Computer Science 3') { echo 'selected'; }else if(isset($user->year_level) && $user->year_level == 'BS Computer Science 3') { echo 'selected'; } ?>>BS Computer Science 3</option>
                                          <option value="BS Computer Science 4" <?php if(isset($_POST['year_level']) && $_POST['year_level'] == 'BS Computer Science 4') { echo 'selected'; }else if(isset($user->year_level) && $user->year_level == 'BS Computer Science 4') { echo 'selected'; } ?>>BS Computer Science 4</option>
                                      </select>
                                      <?php
                                          if(isset($_POST['year_level']) && !validate_field($_POST['year_level'])){
                                      ?>
                                              <p class="text-danger my-1">Select Year Level</p>
                                      <?php
                                          }
                                      ?>
                                    </div>
                                  </div>
                                  <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                      <label for="section" class="form-label">Section</label>
                                      <select name="section" id="section" class="form-select">
                                          <option value="">Select Year Level</option>
                                          <option value="A" <?php if(isset($_POST['section']) && $_POST['section'] == 'A') { echo 'selected'; }else if(isset($user->section) && $user->section == 'A') { echo 'selected'; } ?>>A</option>
                                          <option value="B" <?php if(isset($_POST['section']) && $_POST['section'] == 'B') { echo 'selected'; }else if(isset($user->section) && $user->section == 'B') { echo 'selected'; } ?>>B</option>
                                          <option value="C" <?php if(isset($_POST['section']) && $_POST['section'] == 'C') { echo 'selected'; }else if(isset($user->section) && $user->section == 'C') { echo 'selected'; } ?>>C</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-12"> 
                                    <div class="mb-3">
                                      <label for="email" class="form-label">Email</label>
                                      <input type="email" class="form-control" id="email" name="email" required value="<?php if(isset($_POST['email'])) { echo $_POST['email']; }else if(isset($user->email)) { echo $user->email; } ?>">
                                      <?php
                                          $new_user = new User();
                                          if(isset($_POST['email'])){
                                              $new_user->email = htmlentities($_POST['email']);
                                          }else{
                                              $new_user->email = '';
                                          }

                                          if(isset($_POST['email']) && strcmp(validate_email($_POST['email']), 'success') != 0){
                                      ?>
                                              <p class="text-danger my-1"><?php echo validate_email($_POST['email']) ?></p>
                                      <?php
                                          }else if ($new_user->is_email_exist() && $_POST['email'] && $old_email != $user->email){
                                      ?>
                                              <p class="text-danger my-1">Email already exist</p>
                                      <?php      
                                          }
                                      ?>
                                    </div>
                                  </div>
                                  <div class="row" id="sc-btn">
                                  <button type="submit" name="save" class="btn" id="login-btn">Save</button>
                                </div>
                                </form>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="notifications">
                            <h3>Notifications Settings</h3>
                            <!-- Include notifications settings content here -->
                            <div class="row">
                              <div class="col">
                                <div class="row pb-5">
                                  <div class="col-sm-9">
                                    <h4><span>EMAIL NOTIFICATIONS</span>
                                      Get emails to find out what’s going on when you’re 
                                      not online. You can turn these off.</h4>
                                  </div>
                                  <div class="col-sm-3">
                                    <label class="switch">
                                      <input type="checkbox">
                                      <span class="slider"></span>
                                    </label>
                                  </div>
                                </div>
                                <div class="row pb-5">
                                  <div class="col-sm-9">
                                    <h4><span>PUSH NOTIFICATIONS</span>
                                      Enable or disable push notifications on your mobile device for
                                      real-time alerts about course activities and announcements.</h4>
                                  </div>
                                  <div class="col-sm-3">
                                    <label class="switch">
                                      <input type="checkbox">
                                      <span class="slider"></span>
                                    </label>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="privacy">
                            <h3>Privacy and Security Settings</h3>
                            <!-- Include privacy and security settings content here -->
                            <div class="row">
                              <div class="col">
                                <div class="row pb-5">
                                  <div class="col-sm-9">
                                    <h4><span>Two-Factor Authentication</span>
                                      KEEP YOUR ACCOUNT SECURE BY ENABLING 2FA VIA SMS OR 
                                      USING A TEMPORARY ONE-TIME PASSCODE (TOTP).</h4>
                                  </div>
                                  <div class="col-sm-3">
                                    <label class="switch">
                                      <input type="checkbox">
                                      <span class="slider"></span>
                                    </label>
                                  </div>
                                </div>
                                <div class="row pb-5">
                                  <div class="col-sm-9">
                                    <h4><span>Login History: [View History]</span>
                                      View a record of your recent login sessions, including dates, 
                                      times, and the devices used to access your account.</h4>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col">
                                <h4 class="text-center">LOGIN HISTORY</h4>
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Time</th>
                                      <th scope="col">Device</th>
                                      <th scope="col">Location</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row">2023-10-05 01:24</th>
                                      <td>Iphone 7 Plus</td>
                                      <td>Zamboanga City</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">2023-10-04 08:43</th>
                                      <td>Dell Desktop</td>
                                      <td>Tetuan, Zamboanga City</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">2023-10-01 18:32</th>
                                      <td>Iphone 7 Plus</td>
                                      <td>Putik, Zamboanga City</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="help">
                            <h3>Help and Support</h3>
                            <!-- Include help and support content here -->
                            <h1>COMING SOON</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>



      <?php
        require_once('../include/footer.php');
      ?>
        
        <script src="../vendor/bootstrap-5.0.2/js/bootstrap.min.js"></script>
    </body>
</html>