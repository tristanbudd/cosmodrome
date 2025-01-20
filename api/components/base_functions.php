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
?>