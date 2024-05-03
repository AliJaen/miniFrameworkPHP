<?php

function loadheader($data = "") {
    $view_header = "Views/Templates/header.php";

    require_once ($view_header);
}

function loadfooter($data = "") {
    $view_footer = "Views/Templates/footer.php";

    require_once ($view_footer);
}

function get_favicon() {
    $path = FAVICON;
    $favicon = SITE_FAVICON;
    $type = '';
    $href = '';
    $placeholder = '<link rel="shortcut icon" href="%s" type="%s">';

    switch (pathinfo($path . $favicon, PATHINFO_EXTENSION)) {
        case 'ico':
            $type = 'image/vnd.microsoft.icon';
            $href = $path . $favicon;
        break;
        
        case 'png':
            $type = 'image/png';
            $href = $path . $favicon;
        break;

        case 'gif':
            $type = 'image/gif';
            $href = $path . $favicon;
        break;

        case 'svg':
            $type = 'image/svg+xml';
            $href = $path . $favicon;
        break;

        case 'jpg':
            $type = 'image/jpg';
            $href = $path . $favicon;
        break;

        default:
            return false;
        break;
    }

    return sprintf($placeholder, $href, $type);
}

function get_logo() {
    $default_logo = SITE_LOGO;
    $placeholder = 'Assets/img/logos/dark-logo.svg';

    if (!is_file(IMAGE_PATH . $default_logo)) {
        return $placeholder;
    }

    return IMG . $default_logo;
}

function debug($data) {
    $format = print_r("<pre>");
    $format .= print_r($data);
    $format .= print_r("</pre>");

    return $format;
}