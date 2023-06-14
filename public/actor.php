<?php

declare(strict_types=1);

use Entity\Actor;
use Entity\Exception\EntityNotFoundException;
use Exception\ParameterException;
use Html\AppWebPage;

try {
    if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
        throw new ParameterException("parameter id is incorrect");
    }

    $actorId = (int) $_GET['id'];

    $actor = Actor::findById($actorId);

    $castings = $actor->getCastings();

    $webPage = new AppWebPage();

    $webPage->setTitle($webPage->escapeString("Films - {$actor->getName()}"));
    $webPage->appendCssUrl('/css/style_actor.css');

    $birthdate = $actor->getBirthday() ? date_format($actor->getBirthday(), 'd/m/Y') : '---';
    $deathdate = $actor->getDeathday() ? date_format($actor->getDeathday(), 'd/m/Y') : '---';
    $webPage->appendContent(
        <<<HTML
        <div class="actor">
            <img src="avatar.php?id={$actor->getAvatarId()}" alt="Photographie de {$actor->getName()}" />
            <div class="actor__details">
                <h1>{$webPage->escapeString($actor->getName())}</h1>
                <h2>{$webPage->escapeString($actor->getPlaceOfBirth())}</h2>
                <div class="actor__life">
                    <span class="actor__date">{$birthdate}</span>
                    <span class="actor__date">$deathdate</span>
                </div>
                <p>{$webPage->escapeString($actor->getBiography())}</p>
            </div>
        </div>
        <div class="movies">
        HTML
    );

    foreach ($castings as $casting) {
        $movieReleaseDate = date_format($casting->getMovie()->getReleaseDate(), 'd/m/Y');
        $webPage->appendContent(
            <<<HTML
            <a href="movie.php?id={$casting->getMovie()->getId()}">
                <div class="movie">
                    <img src="poster.php?id={$casting->getMovie()->getPosterId()}" alt="Poster du film {$casting->getMovie()->getTitle()}" />
                    <div class="movie__details">
                        <div class="movie__info">
                            <h1>{$webPage->escapeString($casting->getMovie()->getTitle())}</h1>
                            <span class="movie__date">{$movieReleaseDate}</span>
                        </div>
                        <h3>{$webPage->escapeString($casting->getRole())}</h3>
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
    http_response_code(500);
}
