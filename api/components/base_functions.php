<?php
function get_document_path($path_type="", $component=false) {
    $is_running_locally = !(strpos($_SERVER["HTTP_HOST"], "localhost") === false);

    if ($is_running_locally) {
        $path = "../" . $path_type;
    } else {
        $path = "";

        if ($component) {
            $path = $_SERVER["DOCUMENT_ROOT"] . "/public";
        }
    }

    return $path;
}

function get_setting($setting_name, $fallback="No Fallback") {
    $settings_file = $_SERVER["DOCUMENT_ROOT"] . "/api/settings.json";

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
        $language_file = get_document_path("public", true) . "/lang/" . $_SESSION["user_language"] . ".json";

        if (file_exists($language_file)) {
            return $_SESSION["user_language"];
        } else {
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

    $language_file = get_document_path("public", true) . "/lang/" . $lang_file . ".json";

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

    $theme_file = get_document_path("public", true) . "/themes/" . $theme . "/" . $theme . ".json";

    if (file_exists($theme_file)) {
        return json_decode(file_get_contents($theme_file), true);
    } else {
        return "Theme file not found";
    }
}

function get_theme_setting($setting_name, $fallback="No Fallback") {
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

    $css_folder = get_document_path("public", true) . "/themes/" . $theme . "/css/" . $theme_mode . "/";
    $js_folder = get_document_path("public", true) . "/themes/" . $theme . "/js/" . $theme_mode . "/";
    $css_folder_path = get_document_path("public", true) . "/themes/" . $theme . "/css/" . $theme_mode . "/";
    $js_folder_path = get_document_path("public", true) . "/themes/" . $theme . "/js/" . $theme_mode . "/";

    $css_files = scan_files($css_folder, $css_folder_path);
    $js_files = scan_files($js_folder, $js_folder_path);

    // Remove the /var/task/user/public/ from the file path. (Vercel Support)
    $css_files = array_map(function($file) {
        return str_replace("/var/task/user/public/", "", $file);
    }, $css_files);

    $js_files = array_map(function($file) {
        return str_replace("/var/task/user/public/", "", $file);
    }, $js_files);

    return [
        "css" => $css_files,
        "js" => $js_files
    ];
}