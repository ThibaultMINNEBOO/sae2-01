<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Image;
use Exception\ParameterException;

try {
    if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new ParameterException("parameter id is incorrect");
    }

    $id = (int) $_GET['id'];

    $poster = Image::findById($id);

    header('Content-Type: image/jpeg');

    echo $poster->getJpeg();
} catch (ParameterException $e) {
    http_response_code(400);
} catch (EntityNotFoundException $e) {
    header('Location: /img/default_actor.png');
} catch (Exception $e) {
    http_response_code(500);
}
