<?php
session_start();

include("components/base_functions.php");

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
        <!-- Main Content -->
        <p>Test Content</p>
        <!-- End Main Content -->

        <!-- Importing JavaScript -->
        <script type="text/javascript" rel="javascript" src="../public/js/global.js"></script>
        <!-- End Importing JavaScript -->
    </body>
</html>
