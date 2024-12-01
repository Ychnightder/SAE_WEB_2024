<?php

function debug($data) : void
{
echo '<pre>';
print_r($data);
echo '</pre>';
}


function handleRequest (array $chemin) : void  {

        $action = $_GET["action"] ?? $_POST["action"] ?? null;

        if ($action && isset($chemin[$action])) {
            require $chemin[$action];
        }else{
            http_response_code(404);
//            echo "Erreur aucune page trouver";
//            debug($action);
//            debug($chemin);
        }
}