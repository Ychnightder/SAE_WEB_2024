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
        }
}

function convertirEnJS($nomjs,$data) : void {
    echo 'const '. $nomjs . '= ' . json_encode($data) . ';'.PHP_EOL;
}