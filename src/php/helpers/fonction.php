<?php
function handleRequest (array $chemin) : void  {

    $action = filter_var($_GET["action"] ?? $_POST["action"] ?? null  );

    if ($action && isset($chemin[$action])) {
        require $chemin[$action];
        exit();
    }else{
        http_response_code(404);
    }
}