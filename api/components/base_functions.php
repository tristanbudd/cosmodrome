<?php
function get_setting($setting_name, $fallback) {
    if (file_exists("../../resource/settings.json")) {
        $settings = json_decode(file_get_contents("/settings.json"), true);
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
        if (file_exists("../../resource/lang/" . $_SESSION["user_language"] . ".json")) {
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

    if (file_exists("../../resource/lang/" . $lang_file . ".json")) {
        $lang = json_decode(file_get_contents("/resource/lang/" . $lang_file . ".json"), true);
        if (isset($lang[$lang_key])) {
            return $lang[$lang_key];
        } else {
            return "Language key not found";
        }
    } else {
        return "Language file not found";
    }
}