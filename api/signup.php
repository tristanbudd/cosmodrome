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
                                        <label for="terms_agreed">I agree to the <a href="tos.php">Terms of Service</a></label>
                                    </div>
                                    <br>
                                    <button onclick="signup_page(1, 2)" class="form-button-b">Get Started</button>
                                <br>
                                <span class="error_message" id="error_message"></span>
                                <p>Already have an account? <a href="login.php">Login Here</a></p>
                            </div>
                            <div class="signup-form-container" id="signup_page_2" style="display: none;">
                                <h1>Sign Up</h1>
                                <h2>Your Profile</h2>
                                <div class="signup-double-button">
                                    <button onclick="signup_page(2, 1)" class="form-button-a">Previous Page</button>
                                    <button onclick="signup_page(2, 3)" class="form-button-b">Next Page</button>
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
