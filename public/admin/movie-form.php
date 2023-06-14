<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Movie;
use Exception\ParameterException;
use Html\AppWebPage;
use Html\Form\MovieForm;

try {
    $id = null;
    $movie = null;

    if (isset($_GET['id'])) {
        if (!is_numeric($_GET['id'])) {
            throw new ParameterException("no valid format id provided");
        }

        $id = (int) $_GET['id'];
        $movie = Movie::findById($id);
    }

    $form = new MovieForm($movie);
    $webPage = new AppWebPage();
    $webPage->setTitle($movie ? "Modification de l'artiste {$webPage->escapeString($movie->getTitle())}" : "Création d'un nouveau film");

    $webPage->appendCssUrl('/css/form.css');

    $webPage->appendContent(
        <<<HTML
        <div class="form">
            {$form->getHtmlForm('movie-save.php')}
        </div>
        HTML
    );

    echo $webPage->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}