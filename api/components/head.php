<head>
    <title><?php echo(get_setting("website_name", "Cosmodrome") . " | " . $_SESSION["page_title"]) ?></title>

    <meta name="description" content="<?php echo(get_setting("website_description", "A Cosmodrome Website.")) ?>">
    <meta name="keywords" content="<?php echo(get_setting("website_keywords", "cosmodrome, website, web, development, design")) ?>">

    <meta name="abstract" content="<?php echo(get_setting("website_description_short", "Cosmodrome Website")) ?>">
    <meta name="summary" content="<?php echo(get_setting("website_description_short", "Cosmodrome Website")) ?>">
    <meta name="classification" content="<?php echo(get_setting("website_description_short", "Cosmodrome Website")) ?>">

    <meta name="language" content="<?php echo(get_page_language()) ?>">
    <meta name="country" content="<?php echo(get_page_language()) ?>">

    <meta name="owner" content="<?php echo(get_setting("website_author", "Cosmodrome") . ", " . get_setting("website_contact_email", "support@cosmodrome.org")) ?>">
    <meta name="author" content="<?php echo(get_setting("website_author", "Cosmodrome") . ", " . get_setting("website_contact_email", "support@cosmodrome.org")) ?>">
    <meta name="designer" content="<?php echo(get_setting("website_author", "Cosmodrome") . ", " . get_setting("website_contact_email", "support@cosmodrome.org")) ?>">
    <meta name="publisher" content="<?php echo(get_setting("website_author", "Cosmodrome") . ", " . get_setting("website_contact_email", "support@cosmodrome.org")) ?>">
    <meta name="web_author" content="<?php echo(get_setting("website_author", "Cosmodrome") . ", " . get_setting("website_contact_email", "support@cosmodrome.org")) ?>">

    <meta name="reply-to" content="<?php echo(get_setting("website_contact_email", "support@cosmodrome.org")) ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">

    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <meta name="revisit-after" content="7 days">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="general">
    <meta name="target" content="all">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo(get_setting("website_name", "Cosmodrome")) ?>">
    <meta name="twitter:description" content="<?php echo(get_setting("website_description", "A Cosmodrome Website.")) ?>">
    <meta name="twitter:image" content="<?php echo(get_document_path("public") . "/img/logo_cover.jpg") ?>">

    <link rel="icon" type="image/png" href="<?php echo(get_document_path("public") . "/favicon/favicon-96x96.png") ?>" sizes="96x96"/>
    <link rel="icon" type="image/svg+xml" href="<?php echo(get_document_path("public") . "/favicon/favicon.svg") ?>"/>
    <link rel="shortcut icon" href="<?php echo(get_document_path("public") . "/favicon/favicon.ico") ?>"/>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo(get_document_path("public") . "/favicon/apple-touch-icon.png") ?>"/>

    <meta name="copyright" content="Copyright © <?php echo(get_setting("website_name", "Cosmodrome")) ?>">

    <!-- Importing FontAwesome -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- End Importing FontAwesome -->

    <!-- Importing Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo(get_document_path("public") . "/css/override.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo(get_document_path("public") . "/css/global.css") ?>">

    <?php
    $theme_files = get_theme_files();
    foreach ($theme_files["css"] as $css_file) {
        echo("<link rel='stylesheet' type='text/css' href='" . $css_file . "'>");
    }
    ?>
    <!-- End Importing Stylesheets -->
</head>