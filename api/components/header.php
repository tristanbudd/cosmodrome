<?php
function create_header($data = array()) {
    $is_sticky = isset($data["is_sticky"]) ? $data["is_sticky"] : false;
    $is_transparent = isset($data["is_transparent"]) ? $data["is_transparent"] : false;
    $hide_logo = isset($data["hide_logo"]) ? $data["hide_logo"] : false;

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
                <?php
                if (!$hide_logo) {
                    ?>
                    <a href="#">
                        <h2 class="header-logo-text"><?php echo(strtoupper(get_setting("website_name", "Cosmodrome"))) ?></h2>
                    </a>
                    <?php
                }
                ?>
                <a href="https://example.com" class="header-link-a" target="_self">
                    <p>Regular</p>
                </a>
                <a href="https://example.com" class="header-link-a dropdown" target="_self">
                    <p>Dropdown</p>
                    <i class="fa-solid fa-chevron-down"></i>
                </a>
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