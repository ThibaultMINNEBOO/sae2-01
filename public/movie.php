<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Movie;
use Entity\Casting;
use Exception\ParameterException;
use Html\AppWebPage;

try {
    if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new ParameterException("parameter id is incorrect");
    }

    $movieId = (int) $_GET['id'];

    $movie = Movie::findById($movieId);

    $castings = $movie->getCastings();

    $webPage = new AppWebPage();

    $webPage->setTitle("Films - {$webPage->escapeString($movie->getTitle())}");
    $webPage->appendCssUrl('/css/style_movie.css');

    $date = date_format($movie->getReleaseDate(), 'd/m/Y');

    $webPage->appendContent(
        <<<HTML
        <div class="movie">
            <img src="poster.php?id={$movie->getPosterId()}" alt="Poster de l'article {$movie->getTitle()}" />
            <div class="movie__details">
                <div class="movie__header">
                    <h1>{$webPage->escapeString($movie->getTitle())}</h1>
                    <h4>{$date}</h4>
                </div>
                <div class="movie__body">
                    <h2>{$webPage->escapeString($movie->getOriginalTitle())}</h2>
                    <h5>{$webPage->escapeString($movie->getTagline())}</h5>
                    <p>{$webPage->escapeString($movie->getOverview())}</p>
                </div>
            </div>
        </div>
        <div class="actors">
        HTML
    );

    $webPage->pushMenu("/admin/movie-form.php?id={$movie->getId()}", "Modifier")
            ->pushMenu("/admin/movie-delete.php?id={$movie->getId()}", "Supprimer");

    foreach ($castings as $casting) {
        $webPage->appendContent(
            <<<HTML
            <a href="actor.php?id={$casting->getActor()->getId()}">
                <div class="actor">
                    <img src="avatar.php?id={$casting->getActor()->getAvatarId()}" alt="Image de {$casting->getActor()->getName()}">
                    <div class="actor__details">
                        <h2>{$webPage->escapeString($casting->getRole())}</h2>
                        <h1>{$webPage->escapeString($casting->getActor()->getName())}</h1>
                    </div>
                </div>
            </a>
            HTML
        );
    }

    $webPage->appendContent("</div>");

    echo $webPage->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception $e) {
    var_dump($e);
}