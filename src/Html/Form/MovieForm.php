<?php
declare(strict_types=1);

namespace Html\Form;

use Entity\Movie;
use Exception;
use Exception\ParameterException;
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

    /**
     * @throws Exception
     */
    public function getHtmlForm(string $action): string
    {
        $id = $this->movie ? $this->getMovie()->getId() : '';
        $title = $this->movie ? $this->getMovie()->getTitle() : '';
        $runtime = $this->movie ? $this->getMovie()->getRuntime() : '';
        $tagline = $this->movie ? $this->getMovie()->getTagline() : '';
        $releaseDate = $this->movie ? date_format($this->getMovie()->getReleaseDate(), 'Y-m-d') : '';
        $overview = $this->movie ? $this->getMovie()->getOverview() : '';

        return <<<HTML
        <form action="{$action}" method="post" class="form__movie">
            <input type="hidden" name="id" value="{$id}" class="form__input">
            <label for="title" class="form__label">Titre</label>
            <input type="text" name="title" value="{$title}" class="form__input">
            <label for="tagline" class="form__label">Slogan</label>
            <input type="text" name="tagline" value="{$tagline}" class="form__input">
            <label for="runtime" class="form__label">Durée</label>
            <input type="number" name="runtime" value="{$runtime}" class="form__input">
            <label for="releaseDate" class="form__label">Date de mise en salle</label>
            <input type="date" name="releaseDate" value="{$releaseDate}" class="form__input">
            <label for="overview" class="form__label">Résumé</label>
            <textarea name="overview" cols="30" rows="10" class="form__input">{$overview}</textarea>
            <button type="submit">Enregistrer</button>
        </form>
        HTML;
    }

    /**
     * Définit le film selon ce qui a été envoyé en POST
     *
     * @throws ParameterException
     */
    public function setEntityFromQueries(): void
    {
        if (isset($_POST['name']) && isset($_POST['id']) && isset($_POST['runtime']) && isset($_POST['tagline']) && isset($_POST['releaseDate']) && isset($_POST['overview'])) {
            $id = (!empty($_POST['id']) && is_numeric($_POST['id'])) ? (int) $_POST['id'] : null;

            if (empty($_POST['name']) || empty($_POST['runtime']) || empty($_POST['releaseDate'])) {
                throw new ParameterException("no correct data mentioned in query string");
            }

            $title = $this->stripTagsAndTrim($_POST['title']);
            $tagline = $this->stripTagsAndTrim($_POST['tagline']);
            $runtime = (int) $_POST['runtime'];
            $releaseDate = $_POST['releaseDate'];
            $overview = $this->stripTagsAndTrim($_POST['overview']);
            $this->movie = Movie::create($title, $overview, $runtime, $releaseDate, '', $tagline, '', null, $id);
        }
    }
}