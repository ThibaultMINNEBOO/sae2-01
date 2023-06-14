<?php
declare(strict_types=1);

namespace Html\Form;

use Entity\Movie;
use Html\StringEscaper;

class MovieForm
{
    use StringEscaper;

    /**
     * @var Movie|null Le film à modifier. Si null, concerne la création d'un nouveau film
     */
    private ?Movie $movie;

    /**
     * Constructeur de la classe MovieForm
     *
     * @param Movie|null $movie le film à modifier. Si null, concerne la création d'un nouveau film
     */
    public function __construct(?Movie $movie = null)
    {
        $this->movie = $movie;
    }

    /**
     * Retourne le film du formulaire
     *
     * @return Movie|null
     */
    public function getMovie(): ?Movie
    {
        return $this->movie;
    }


}