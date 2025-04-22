<?php
session_start();

require_once($_SERVER["DOCUMENT_ROOT"] . "/api/components/base_functions.php");

$page_language = get_page_language();

$_SESSION["page_name"] = "home";
$_SESSION["page_title"] = get_lang("home", $page_language);
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
            "show_profile" => true,
            "header_links" => array(
                array(
                    "id" => "tools",
                    "type" => "a",
                    "text" => "Tools",
                    "link" => "",
                    "target" => "_self",
                    "dropdown" => true,
                    "dropdown_links" => array(
                        array(
                            "header" => "Time Management",
                            "links" => array(
                                array(
                                    "icon" => "fa-solid fa-address-card",
                                    "text" => "Cards",
                                    "description" => "Plan and manage your day",
                                    "link" => "tools/cards.php",
                                    "target" => "_self"
                                ),
                                array(
                                    "icon" => "fa-solid fa-clock",
                                    "text" => "Deadlines",
                                    "description" => "Oversee upcoming deadlines",
                                    "link" => "tools/deadlines.php",
                                    "target" => "_self"
                                ),
                                array(
                                    "icon" => "fa-solid fa-arrows-to-circle",
                                    "text" => "Focus Sessions",
                                    "description" => "Focus on specific tasks",
                                    "link" => "tools/focus-sessions.php",
                                    "target" => "_self"
                                )
                            )
                        ),
                        array(
                            "header" => "Coming Soon",
                            "links" => array(
                                array(
                                    "icon" => "fa-solid fa-xmark",
                                    "text" => "Coming Soon",
                                    "description" => "More Coming Soon",
                                    "link" => "#",
                                    "target" => "_self"
                                )
                            )
                        )
                    )
                ),
                array(
                    "id" => "about",
                    "type" => "a",
                    "text" => "About",
                    "link" => "about.php",
                    "target" => "_self"
                ),
                array(
                    "id" => "support",
                    "type" => "a",
                    "text" => "Support",
                    "link" => "support.php",
                    "target" => "_self"
                )
            ),
        );
        create_header($header_data);
        ?>
        <!-- End Importing Page Header -->

        <!-- Main Content -->
        <div class="main-content">
            <h1>Heading 1</h1>
            <h2>Heading 2</h2>
            <h3>Heading 3</h3>
            <h4>Heading 4</h4>
            <h5>Heading 5</h5>
            <h6>Heading 6</h6>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <p class="text-italic">Hello World</p>
            <a href="#">Home</a>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        <!-- End Main Content -->

        <!-- Importing JavaScript -->
        <script type="text/javascript" rel="javascript" src="<?php echo(get_document_path("public") . "/js/global.js") ?>"></script>

        <?php
        $theme_files = get_theme_files();

        foreach ($theme_files["js"] as $js_file) {
            echo("<script type='text/javascript' rel='javascript' src='" . get_document_path("public") . $js_file . "'></script>");
        }
        ?>
        <!-- End Importing JavaScript -->
    </body>
</html>
