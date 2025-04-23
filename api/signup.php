<?php
session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/api/components/base_functions.php");

$page_language = get_page_language();

$_SESSION["page_name"] = "signup";
$_SESSION["page_title"] = get_lang("signup", $page_language);
?>

<!DOCTYPE html>
<html lang="<?php echo($page_language) ?>">
    <!-- Importing Page Header & SEO -->
    <?php include("components/head.php"); ?>
    <!-- End Importing Page Header & SEO -->

    <body>
        <!-- Importing Page Header -->
        <?php
        include("components/header.php");

        $header_data = array(
            "is_sticky" => true,
            "show_profile" => false,
            "show_return_home" => true,
            "header_links" => array(),
        );
        create_header($header_data);
        ?>
        <!-- End Importing Page Header -->

        <!-- Main Content -->
        <div class="main-content">
            <form action="" method="POST">
                <div class="signup-login-page">
                    <div class="signup-form">
                        <div class="signup-form-container" id="signup-form-image">
                            <img src="<?php echo(get_document_path("public") . "/img/logo.svg") ?>" alt="Display Image">
                        </div>
                            <div class="signup-form-container" id="signup_page_1" style="display: flex;">
                                <h1>Sign Up</h1>
                                <h2>Information</h2>
                                <p>Welcome to <b>Cosmodrome</b>, On our platform all data is stored locally and you are responsible for the safekeeping of your own data.</p>
                                <p>You can find out more about this on the <a href="about.php">About Page</a>.</p>
                                <br>
                                <h2>Agreements</h2>
                                    <div class="inline-input">
                                        <input type="checkbox" name="terms_agreed" id="terms_agreed" required>
                                        <label for="terms_agreed">I agree to the <a href="tos.php">Terms of Service</a><span class="required-asterisk">*</span></label>
                                    </div>
                                    <br>
                                    <button onclick="signup_page(1, 2)" class="form-button-b">Get Started</button>
                                <br>
                                <span class="error_message" id="error_message"></span>
                                <p>Already have an account? <a href="login.php">Login Here</a></p>
                            </div>
                            <div class="signup-form-container" id="signup_page_2" style="display: none;">
                                <h1>Sign Up</h1>
                                <div class="progress-bar">
                                    <div class="progress-bar-fill" id="progress_bar_fill" style="width: 33.33%;"></div>
                                </div>
                                <h2>Your Profile</h2>
                                <div class="profile-picture-container">
                                    <div class="signup-double-input" style="justify-content: normal;">
                                        <img src="https://picsum.photos/200" alt="ACCOUNT NAME profile" class="signup-profile-img">
                                        <div class="signup-double-input" style="flex-direction: column;">
                                            <button onclick="upload_profile_picture()" class="form-button-a" id="upload_profile_picture"><i class="fa-solid fa-upload"></i>Upload Profile Picture</button>
                                            <button onclick="generate_profile_picture()" class="form-button-a" id="generate_profile_picture"><i class="fa-solid fa-rotate"></i>Generate Profile Picture</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="signup-double-input">
                                    <label for="first_name" class="signup-input-label">First Name<span class="required-asterisk">*</span>
                                        <input type="text" name="first_name" id="first_name" placeholder="First Name" class="signup-input" required>
                                    </label>
                                    <label for="last_name" class="signup-input-label">Last Name<span class="required-asterisk">*</span>
                                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="signup-input" required>
                                    </label>
                                </div>
                                <div class="signup-double-button">
                                    <button onclick="signup_page(2, 1)" class="form-button-a">Previous Page</button>
                                    <button onclick="signup_page(2, 3)" class="form-button-b">Next Page</button>
                                    <span class="error_message" id="error_message"></span>
                                </div>
                            </div>
                            <div class="signup-form-container" id="signup_page_3" style="display: none;">
                                <h1>Sign Up</h1>
                                <div class="progress-bar">
                                    <div class="progress-bar-fill" id="progress_bar_fill" style="width: 66.66%;"></div>
                                </div>
                                <h2>Page 3</h2>
                                <div class="signup-double-button">
                                    <button onclick="signup_page(3, 2)" class="form-button-a">Previous Page</button>
                                    <button onclick="signup_page(3, 4)" class="form-button-b">Next Page</button>
                                    <span class="error_message" id="error_message"></span>
                                </div>
                            </div>
                            <div class="signup-form-container" id="signup_page_4" style="display: none;">
                                <h1>Sign Up</h1>
                                <div class="progress-bar">
                                    <div class="progress-bar-fill" id="progress_bar_fill" style="width: 100%;"></div>
                                </div>
                                <h2>Page 4</h2>
                                <div class="signup-double-button">
                                    <button onclick="signup_page(4, 3)" class="form-button-a">Previous Page</button>
                                    <input type="submit" value="Create Account" id="get_started" class="form-button-b">
                                    <span class="error_message" id="error_message"></span>
                                </div>
                            </div>

                        <!--
                        <input type="submit" value="Get Started" id="get_started" class="form-button-b">
                        -->
                    </div>
                </div>
            </form>
        </div>
        <!-- End Main Content -->

        <!-- Importing JavaScript -->
        <script type="text/javascript" rel="javascript" src="<?php echo(get_document_path("public") . "/js/global.js") ?>"></script>
        <script type="text/javascript" rel="javascript" src="<?php echo(get_document_path("public") . "/js/signup.js") ?>"></script>

        <?php
        $theme_files = get_theme_files();

        foreach ($theme_files["js"] as $js_file) {
            echo("<script type='text/javascript' rel='javascript' src='" . get_document_path("public") . $js_file . "'></script>");
        }
        ?>
        <!-- End Importing JavaScript -->
    </body>
</html>
