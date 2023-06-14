<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Html\AppWebPage;

$webPage = new AppWebPage('Films');

$movies = MovieCollection::findAll();
$webPage->appendCssUrl("/css/style_index.css");

$webPage->appendContent("<section class='movies'>");

foreach ($movies as $movie) {
    $webPage->appendContent(
        <<<HTML
        <a href="movie.php?id={$movie->getId()}">
            <div class="movies__card">
                <img class="card__poster" src="poster.php?id={$movie->getPosterId()}" alt="Poster du film {$movie->getTitle()}">
                <h1 class="card__title">{$webPage->escapeString($movie->getTitle())}</h1>
            </div>
        </a>
        HTML
    );
}

$webPage->appendContent("</section>");
$webPage->appendContent(
    <<<HTML
    <a href="/admin/movie-form.php"><span class="add-button">+</span></a>
    HTML

);

echo $webPage->toHTML();
