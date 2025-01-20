<head>
    <!-- Do site verification shenanigans here -->

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
    <meta name="twitter:image" content="/resource/img/logo_cover.jpg">

    <link rel="icon" type="image/png" href="/api/resource/favicon/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/svg+xml" href="/api/resource/favicon/favicon.svg"/>
    <link rel="shortcut icon" href="/api/resource/favicon/favicon.ico"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/api/resource/favicon/apple-touch-icon.png"/>

    <meta name="copyright" content="Copyright © <?php echo(get_setting("website_name", "Cosmodrome")) ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/api/resource/css/global.css">
</head>