<?php
session_start();

include("resource/base_functions.php");

$page_language = get_page_language();

$_SESSION["page_name"] = "home";
$_SESSION["page_title"] = get_lang("home", $page_language);
?>

<!DOCTYPE html>
<html lang="<?php echo($page_language) ?>">

<!-- Importing Page Header & SEO -->
<?php include("resource/head.php"); ?>
<!-- End Importing Page Header & SEO -->

<body>
<!-- Main Content -->
<p>Shouldn't Be Here</p>
<!-- End Main Content -->

<!-- Importing JavaScript -->
<script type="text/javascript" rel="javascript" src="resource/js/global.js"></script>
<!-- End Importing JavaScript -->
</body>
</html>
