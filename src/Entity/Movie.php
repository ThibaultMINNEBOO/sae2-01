<?php

declare(strict_types=1);

namespace Entity;

use DateTime;
use Exception;

class Movie
{
    /**
     * @var int L'identifiant du film
     */
    private int $id;

    /**
     * @var string Le titre original du film
     */
    private string $originalTitle;

    /**
     * @var string Le langage d'origine du film
     */
    private string $originalLanguage;

    /**
     * @var string Le résumé du film
     */
    private string $overview;

    /**
     * @var DateTime La date de mise en salle du film
     */
    private string $releaseDate;

    /**
     * @var int La durée du film
     */
    private int $runtime;

    /**
     * @var string Le slogan du film
     */
    private string $tagline;

    /**
     * @var string Le titre du film
     */
    private string $title;

    /**
     * @var int L'identifiant du poster associé au film
     */
    private int $posterId;

    /**
     * Retourne l'identifiant du film
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Modifie l'identifiant du film
     *
     * @param int|null $id
     * @return Movie
     */
    public function setId(?int $id): Movie
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Retourne le titre d'origine du film
     *
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /**
     * Modifie le titre original du film
     *
     * @param string $originalTitle
     * @return Movie
     */
    public function setOriginalTitle(string $originalTitle): Movie
    {
        $this->originalTitle = $originalTitle;
        return $this;
    }

    /**
     * Retourne le langague d'origine du film
     *
     * @return string
     */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    /**
     * Modifie le langage d'origine du film
     *
     * @param string $originalLanguage
     * @return Movie
     */
    public function setOriginalLanguage(string $originalLanguage): Movie
    {
        $this->originalLanguage = $originalLanguage;
        return $this;
    }

    /**
     * Retourne le résumé du film
     *
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * Modifie le résumé du film
     *
     * @param string $overview
     * @return Movie
     */
    public function setOverview(string $overview): Movie
    {
        $this->overview = $overview;
        return $this;
    }

    /**
     * Retourne la date de mise en salle du film
     *
     * @return DateTime
     * @throws Exception
     */
    public function getReleaseDate(): DateTime
    {
        return new DateTime($this->releaseDate);
    }

    /**
     * Modifie la date de mise en salle du film
     *
     * @param string $releaseDate
     * @return Movie
     */
    public function setReleaseDate(string $releaseDate): Movie
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * Retourne la durée du film
     *
     * @return int
     */
    public function getRuntime(): int
    {
        return $this->runtime;
    }

    /**
     * Modifie la durée du film
     *
     * @param int $runtime
     * @return Movie
     */
    public function setRuntime(int $runtime): Movie
    {
        $this->runtime = $runtime;
        return $this;
    }

    /**
     * Retourne le slogan du film
     *
     * @return string
     */
    public function getTagline(): string
    {
        return $this->tagline;
    }

    /**
     * Modifie le slogan du film
     *
     * @param string $tagline
     * @return Movie
     */
    public function setTagline(string $tagline): Movie
    {
        $this->tagline = $tagline;
        return $this;
    }

    /**
     * Retourne le titre du film
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Modifie le titre du film
     *
     * @param string $title
     * @return Movie
     */
    public function setTitle(string $title): Movie
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Retourne l'identifiant du poster associé au film
     *
     * @return int
     */
    public function getPosterId(): int
    {
        return $this->posterId;
    }

    /**
     * Modifie l'idenfifiant du poster du film
     *
     * @param int $posterId
     * @return Movie
     */
    public function setPosterId(int $posterId): Movie
    {
        $this->posterId = $posterId;
        return $this;
    }
}
