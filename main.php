<?php
$url = parse_url($_SERVER['REQUEST_URI']);
$path = $url['path'];
if (isset($path) && $path !== '/' && substr($path, -1) === '/') {
    $new_url = substr($path, 0, -1);
    if (isset($url['query']))
        $new_url .= '?' . $url['query'];
    if (isset($url['fragment']))
        $new_url .= '#' . $url['fragment'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $new_url);
    exit();
}

$page;
$head;
$title;

function set_page($path) {
    global $page, $head, $title;
    [$page, $head, $title] = explode('<!----->', file_get_contents($path));
}
function set_404() {
    http_response_code(404);
    set_page('./404.html');
}
if ($path == 'index' || str_ends_with($path, '/index') || preg_match('/\.[A-Za-z0-9-]+$/', $path))
    set_404();
else {
    if ($path === '')
        $path = 'index';
    if (is_dir('./pages/' . $path))
        set_page("./pages/$path/index.html");
    else if (file_exists("./pages/$path.html"))
        set_page("./pages/$path.html");
    else
        set_404();
}
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php echo $title ? "$title — " : ''; ?> Джестер Протокол</title>
        
        <link rel="icon" href="/images/logo.svg" type="image/svg+xml">

        <link rel="stylesheet" href="/styles/styles.css">

        <link rel="stylesheet" href="/styles/fonts.css">

        <link rel="stylesheet" href="/styles/colors.css">

        <link rel="stylesheet" href="/styles/reset.css">

        <?php echo $head; ?>
        <script src="/scripts/menu.js" defer></script>
        <script src="/scripts/redirect.js" defer></script>
    </head>
    <body>   
        <?php echo $page; ?>
    </body>
</html>
