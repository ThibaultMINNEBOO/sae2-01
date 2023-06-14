<?php

declare(strict_types=1);

use Exception\ParameterException;
use Html\Form\MovieForm;

try {
    $form = new MovieForm();
    $form->setEntityFromQueryString();
    var_dump($form->getMovie());
    $form->getMovie()->save();
    header('Location: /index.php');
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}
