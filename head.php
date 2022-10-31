<?php
$WEBSITE_AUTHOR = "Tudor Coman";

function generate_head($page_title, $description) {
    $head = "<head>";
    $head .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
    $head .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">";
    $head .= "<meta name=\"description\" content=\"$description\">";
    $head .= "<meta name=\"author\" content=\"$WEBSITE_AUTHOR\">";
    $head .= "<title>$page_title</title>";
    $head .= "<link href=\"assets/css/bootstrap.min.css\" rel=\"stylesheet\">";
    $head .= "<link href=\"assets/css/sticky-footer-navbar.css\" rel=\"stylesheet\">";
    $head .= "</head>";
    return $head;
}
?>

