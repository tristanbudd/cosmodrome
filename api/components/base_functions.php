<?php
function get_setting($setting_name, $fallback) {
    $settings_file = $_SERVER["DOCUMENT_ROOT"] . "/settings.json";

    if (file_exists($settings_file)) {
        $settings = json_decode(file_get_contents($settings_file), true);

        if (isset($settings[$setting_name])) {
            return $settings[$setting_name];
        } else {
            return $fallback;
        }
    } else {
        return $fallback;
    }
}

function get_page_language() {
    if (isset($_SESSION["user_language"])) {
        $language_file = $_SERVER["DOCUMENT_ROOT"] . "/public/lang/" . $_SESSION["user_language"] . ".json";

        if (file_exists($language_file)) {
            return $_SESSION["user_language"];
        } else {
            // Send error message due to client incorrect language.
            return get_setting("default_language", "en");
        }
    } else {
        return get_setting("default_language", "en");
    }
}

function get_lang($lang_key, $lang_file) {
    if ($lang_file == "" || $lang_file == null) {
        $lang_file = get_page_language();
    }

    $language_file = $_SERVER["DOCUMENT_ROOT"] . "/public/lang/" . $lang_file . ".json";

    if (file_exists($language_file)) {
        $lang = json_decode(file_get_contents($language_file), true);

        if (isset($lang[$lang_key])) {
            return $lang[$lang_key];
        } else {
            return "Language key not found";
        }
    } else {
        return "Language file not found";
    }
}

function get_theme_choice() {
    if (isset($_COOKIE["user_system_theme"])) {
        $theme = $_COOKIE["user_system_theme"];

        if ($theme == "light" || $theme == "dark") {
            return $theme;
        } else {
            return get_setting("theme_default_colour", "light");
        }
    } else {
        return get_setting("theme_default_colour", "light");
    }
}

function get_theme_data() {
    $theme = get_setting("theme", "default");

    $theme_file = $_SERVER["DOCUMENT_ROOT"] . "/public/themes/" . $theme . "/" . $theme . ".json";

    if (file_exists($theme_file)) {
        return json_decode(file_get_contents($theme_file), true);
    } else {
        return "Theme file not found";
    }
}

function get_theme_setting($setting_name, $fallback) {
    $theme_data = get_theme_data();

    if (isset($theme_data[$setting_name])) {
        return $theme_data[$setting_name];
    } else {
        return $fallback;
    }
}

function scan_files($folder, $folder_path) {
    $files = [];

    if (file_exists($folder)) {
        foreach (scandir($folder) as $file) {
            if ($file !== '.' && $file !== '..' && is_file($folder . $file)) {
                $files[] = $folder_path . $file;
            }
        }
    }

    return $files;
}

function get_theme_files() {
    $theme = get_setting("theme", "default");
    $user_theme = get_theme_choice();
    $has_light_dark_mode = get_theme_setting("theme_has_light_dark_theme", false);

    if ($has_light_dark_mode) {
        $theme_mode = $user_theme == "light" ? "light" : "dark";
    } else {
        $theme_mode = "";
    }

    $css_folder = $_SERVER["DOCUMENT_ROOT"] . "/public/themes/" . $theme . "/css/" . $theme_mode . "/";
    $js_folder = $_SERVER["DOCUMENT_ROOT"] . "/public/themes/" . $theme . "/js/" . $theme_mode . "/";
    $css_folder_path = "/themes/" . $theme . "/css/" . $theme_mode . "/";
    $js_folder_path = "/themes/" . $theme . "/js/" . $theme_mode . "/";

    $css_files = scan_files($css_folder, $css_folder_path);
    $js_files = scan_files($js_folder, $js_folder_path);

    return [
        "css" => $css_files,
        "js" => $js_files
    ];
}