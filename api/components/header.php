<?php
function create_header($data = array()) {
    $is_sticky = isset($data["is_sticky"]) ? $data["is_sticky"] : false;
    $is_transparent = isset($data["is_transparent"]) ? $data["is_transparent"] : false;
    $hide_logo = isset($data["hide_logo"]) ? $data["hide_logo"] : false;
    $hide_dashboard = isset($data["hide_dashboard"]) ? $data["hide_dashboard"] : false;
    $show_profile = isset($data["show_profile"]) && $data["show_profile"];

    $header_links = isset($data["header_links"]) ? $data["header_links"] : array();

    $header_class_types = array(
        "a" => "header-link-a",
        "b" => "header-link-b"
    );

    $header_classes = $is_sticky ? 'header-sticky' : '';
    $header_classes .= $is_transparent ? 'header-transparent' : '';
    ?>
    <nav>
        <?php
        if ($is_sticky) {
            echo("<div class='header-fill'></div>");
        }
        ?>
        <header id="header" class="<?php echo($header_classes); ?>">
            <div class="header-group header-left">
                <?php
                if (!$hide_logo) {
                    ?>
                    <a href="#">
                        <h2 class="header-logo-text"><?php echo(strtoupper(get_setting("website_name", "Cosmodrome"))); ?></h2>
                    </a>
                    <?php
                }

                for ($i = 0; $i < count($header_links); $i++) {
                    $header_item = $header_links[$i];
                    $type = $header_item["type"];
                    $text = $header_item["text"];
                    $link = isset($header_item["link"]) ? $header_item["link"] : '';
                    $target = $header_item["target"];
                    $dropdown = isset($header_item["dropdown"]) ? $header_item["dropdown"] : false;

                    $class = isset($header_class_types[$type]) ? $header_class_types[$type] : '';
                    ?>
                    <div class="header-link-container">
                        <a <?php echo($link ? 'href="' . $link . '"' : ''); ?> class="<?php echo($class); ?> <?php echo($dropdown ? 'dropdown' : ''); ?>" target="<?php echo($target); ?>">
                            <p><?php echo($text); ?></p>
                        </a>
                        <?php
                        if ($dropdown && isset($header_item["dropdown_links"]) && isset($header_item["dropdown_id"])) {
                            ?>
                            <div class="dropdown-content" id="<?php echo($header_item["dropdown_id"]); ?>">
                                <?php
                                foreach ($header_item["dropdown_links"] as $dropdown_section) {
                                    ?>
                                    <div class="dropdown-section">
                                        <h4><?php echo($dropdown_section["header"]); ?></h4>
                                        <?php
                                        foreach ($dropdown_section["links"] as $dropdown_link) {
                                            ?>
                                            <a href="<?php echo($dropdown_link["link"]); ?>" target="<?php echo($dropdown_link["target"]); ?>" class="dropdown-link">
                                                <i class="<?php echo($dropdown_link["icon"]); ?>"></i>
                                                <div class="dropdown-text">
                                                    <span class="dropdown-title"><?php echo($dropdown_link["text"]); ?></span>
                                                    <span class="dropdown-description"><?php echo($dropdown_link["description"]); ?></span>
                                                </div>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="header-group header-right">
                <?php
                if (!$hide_dashboard) {
                    if (isset($_SESSION["user_id"])) {
                        ?>
                        <a href="https://example.com" class="header-link-b" target="_self">
                            <p>Dashboard</p>
                        </a>
                        <?php
                    }
                }
                ?>

                <?php
                if ($show_profile) {
                    if (isset($_SESSION["user_id"])) {
                        ?>
                        <a href="https://example.com" class="dropdown">
                            <img src="https://picsum.photos/200" alt="ACCOUNT NAME profile" class="header-profile-img">
                        </a>
                        <?php
                    } else {
                        ?>
                        <a href="https://example.com" class="header-link-b" target="_self">
                            <p>Sign Up</p>
                        </a>
                        <a href="https://example.com" class="header-link-c" target="_self">
                            <p>Login</p>
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </header>
    </nav>
    <?php
}
?>