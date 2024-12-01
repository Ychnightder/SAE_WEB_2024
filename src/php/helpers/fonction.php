<?php

function debug($data) : void
{
echo '<pre>';
print_r($data);
echo '</pre>';
}


function handleRequest (array $chemin) : void  {

        $action = filter_var($_GET["action"] ?? $_POST["action"] ?? null  );

        if ($action && isset($chemin[$action])) {
            require $chemin[$action];
            exit();
        }else{
            http_response_code(404);
//            echo json_encode(["error" => "Action '$action' non trouvée."]);
//            echo "Erreur aucune page trouver";
//            debug($action);
//            debug($chemin);
        }
}