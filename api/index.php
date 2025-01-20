<?php
session_start();

include("components/base_functions.php");

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
        <!-- Main Content -->
        <h1>Heading 1</h1>
        <h2>Heading 2</h2>
        <h3>Heading 3</h3>
        <h4>Heading 4</h4>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
        <p class="text-italic">Hello World</p>
        <a href="#">Home</a>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <!-- End Main Content -->

        <!-- Importing JavaScript -->
        <script type="text/javascript" rel="javascript" src="../public/js/global.js"></script>
        <!-- End Importing JavaScript -->
    </body>
</html>
