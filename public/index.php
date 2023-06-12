<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Html\AppWebPage;

$webPage = new AppWebPage('Films');

$movies = MovieCollection::findAll();

$webPage->appendContent("<section class='movies'>");

foreach ($movies as $movie) {
    $moviePoster = $movie->getPosterId() ? "poster.php?id={$movie->getPosterId()}" : '/img/default_movie.png';
    $webPage->appendContent(
        <<<HTML
        <div class="movies__card">
            <img src="{$moviePoster}" alt="">
            <h1 class="card__title">{$webPage->escapeString($movie->getTitle())}</h1>
        </div>
        HTML
    );
}

echo $webPage->toHTML();
