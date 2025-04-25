<?php
session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/api/components/base_functions.php");

$page_language = get_page_language();

$_SESSION["page_name"] = "signup";
$_SESSION["page_title"] = get_lang("signup", $page_language);

// echo($_POST["terms_agreed"]);
//echo('<img src="data:image/png;base64,' . base64_encode(file_get_contents($_FILES["profile_picture"]["tmp_name"])) . '" />');
// ^ Perhaps consider scaling resolution, closer to 512 x 512.
// echo($_POST["first_name"]);
// echo($_POST["last_name"]);
//echo($_POST["encryption_enabled"]);
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
            <form action="" method="POST" enctype="multipart/form-data">
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
                            <div style="margin: 10px 0 10px 0;"></div> <!-- Basically a <br /> but for firefox support. -->
                            <h2>Agreements</h2>
                                <div class="inline-input">
                                    <input type="checkbox" name="terms_agreed" id="terms_agreed" required>
                                    <label for="terms_agreed">I agree to the <a href="tos.php">Terms of Service</a><span class="required-asterisk">*</span></label>
                                </div>
                                <div style="margin: 10px 0 10px 0;"></div>
                                <button onclick="signup_page(1, 2)" class="form-button-b">Get Started</button>
                            <div style="margin: 10px 0 10px 0;"></div>
                            <span class="error-message" id="error_message"></span>
                            <p>Already have an account? <a href="login.php">Login Here</a></p>
                        </div>
                        <div class="signup-form-container" id="signup_page_2" style="display: none;">
                            <input type="file" id="upload_profile_picture_img" name="profile_picture" accept="image/png, image/gif, image/jpeg" style="display: none;">
                            <h1>Sign Up</h1>
                            <div class="progress-bar">
                                <div class="progress-bar-fill" id="progress_bar_fill" style="width: 33.33%;"></div>
                            </div>
                            <h2>Your Profile</h2>
                            <div class="profile-picture-container">
                                <div class="signup-double-input" style="justify-content: normal;">
                                    <img src="<?php echo(get_document_path("public", true) . "/img/profile_blank.png") ?>" id="profile_picture_img" class="signup-profile-img">
                                    <div class="signup-double-input" style="flex-direction: column;">
                                        <button class="form-button-a" id="upload_profile_picture"><i class="fa-solid fa-upload"></i>Upload Profile Picture</button>
                                        <button class="form-button-a" id="generate_profile_picture"><i class="fa-solid fa-rotate"></i>Generate Profile Picture</button>
                                    </div>
                                </div>
                            </div>
                            <div style="margin: 10px 0 10px 0;"></div>
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
                            </div>
                            <div style="margin: 10px 0 10px 0;"></div>
                            <span class="error-message" id="error_message"></span>
                        </div>
                        <div class="signup-form-container" id="signup_page_3" style="display: none;">
                            <h1>Sign Up</h1>
                            <div class="progress-bar">
                                <div class="progress-bar-fill" id="progress_bar_fill" style="width: 66.66%;"></div>
                            </div>
                            <input type="hidden" name="encryption_enabled" id="encryption_enabled">
                            <h2>Data Encryption</h2>
                            <h3>Option 1: Encrypted Data</h3>
                            <p>This option provides an additional layer of security to your saved data by encrypting it with a password.</p>
                            <div class="warning-text"><i class="fa-solid fa-triangle-exclamation"></i>There is no "Forgotten Password" functionality, if you forget or lose your password the account can not be recovered.</div>
                            <div class="signup-double-input-vertical">
                                <label for="password" class="signup-input-label">Password
                                    <input type="password" name="password" id="password" placeholder="Password" class="signup-input">
                                </label>
                                <div class="password_strength" id="password_strength" style="display: none;">
                                    <ul>
                                        <li id="password_8characters" style="color: var(--colour-error);"><i class="fa-solid fa-xmark"></i> At Least 8 Characters</li>
                                        <li id="password_1uppercase" style="color: var(--colour-error);"><i class="fa-solid fa-xmark"></i> At Least 1 Uppercase Letter</li>
                                        <li id="password_1lowercase" style="color: var(--colour-error);"><i class="fa-solid fa-xmark"></i> At Least 1 Lowercase Letter</li>
                                        <li id="password_1number" style="color: var(--colour-error);"><i class="fa-solid fa-xmark"></i> At Least 1 Number</li>
                                        <li id="password_1special" style="color: var(--colour-error);"><i class="fa-solid fa-xmark"></i> At Least 1 Special Character</li>
                                    </ul>
                                </div>
                                <label for="confirm_password" class="signup-input-label">Confirm Password
                                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="signup-input">
                                </label>
                                <div class="password_strength" id="confirm_password_strength" style="display: none;">
                                    <ul>
                                        <li id="password_matching" style="color: var(--colour-error);"><i class="fa-solid fa-xmark"></i> Password Field Cannot Be Empty</li>
                                    </ul>
                                </div>
                            </div>
                            <button class="form-button-a" id="encrypt_data"><i class="fa-solid fa-lock"></i>Encrypt Data</button>
                            <div class="signup-spacer"></div>
                            <h3>Option 2: No Encryption</h3>
                            <p>This option allows you to directly access and modify your data outside of the Cosmodrome Platform and gives you full control over your data.</p>
                            <div class="warning-text"><i class="fa-solid fa-triangle-exclamation"></i>We strongly recommend against this option if you are using a shared device.</div>
                            <button class="form-button-c" id="dont_encrypt_data"><i class="fa-solid fa-triangle-exclamation"></i>Do Not Encrypt Data</button>
                            <div style="margin: 10px 0 10px 0;"></div>
                            <button onclick="signup_page(3, 2)" class="form-button-a">Previous Page</button>
                            <div style="margin: 10px 0 10px 0;"></div>
                            <span class="error-message" id="error_message"></span>
                        </div>
                        <div class="signup-form-container" id="signup_page_4" style="display: none;">
                            <h1>Sign Up</h1>
                            <div class="progress-bar">
                                <div class="progress-bar-fill" id="progress_bar_fill" style="width: 100%;"></div>
                            </div>
                            <input type="file" id="test_file_access_input" name="local_file" accept=".cosmo" style="display: none;">
                            <h2>File Saving</h2>
                            <h3>Remote Saving</h3>
                            <p>Save a copy of your save file and automatically update it via third party platforms such as GitHub, Google Drive & DropBox.</p>
                            <button class="form-button-a" disabled><i class="fa-solid fa-xmark"></i>Feature Coming Soon</button>
                            <div class="signup-spacer"></div>
                            <h3>Local Saving<span class="required-asterisk">*</span></h3>
                            <p>Save a local copy of your data for easy access via a portable file. We recommend you place the file in a safe place you can find easily, such as your documents' folder.</p>
                            <div class="signup-double-button">
                                <button class="form-button-a" id="download_local_file"><i class="fa-solid fa-download"></i>Download Local File</button>
                                <button class="form-button-a" id="test_file_access" style="margin-right: 0 !important;"><i class="fa-solid fa-folder-open"></i>Test File Access</button>
                            </div>
                            <span class="info-message" id="info_message" style="display: none;"><i class="fa-solid fa-circle-info"></i> Now that you have the file downloaded, move it to a safe and rememberable place then attempt to open the file with the "Test File Access" button.</span>
                            <div style="margin: 10px 0 10px 0;"></div>
                            <div class="signup-double-button">
                                <button onclick="signup_page(4, 3)" class="form-button-a">Previous Page</button>
                                <input type="submit" value="Create Account" id="get_started" class="form-button-b">
                            </div>
                            <div style="margin: 10px 0 10px 0;"></div>
                            <span class="error-message" id="error_message"></span>
                        </div>
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
