<?php
function create_header($is_sticky = false, $is_transparent = false) {
    $header_classes = $is_sticky ? 'header-sticky' : '';
    $header_classes .= $is_transparent ? 'header-transparent' : '';
    ?>
    <nav>
        <?php
        if ($is_sticky) {
            echo("<div class='header-fill'></div>");
        }
        ?>
        <header id="header" class="<?php echo $header_classes; ?>">
            <div class="header-group header-left">
                <h2 class="header-logo-text"><?php echo(strtoupper(get_setting("website_name", "Cosmodrome"))) ?></h2>
            </div>
            <?php
            // Header Classes Here

            // Theme selector, language selector, and light/dark mode selector
            ?>
            <div class="header-group header-right">

            </div>
        </header>
    </nav>
    <?php
}
?>