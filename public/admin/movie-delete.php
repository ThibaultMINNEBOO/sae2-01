<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Movie;
use Exception\ParameterException;

try {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new ParameterException('id parameter is not valid');
    }

    $id = (int) $_GET['id'];

    $artist = Movie::findById($id);

    $artist->delete();

    header('Location: /index.php');
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
