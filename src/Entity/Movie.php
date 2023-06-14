<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use DateTime;
use Entity\Exception\EntityNotFoundException;
use Exception;
use PDO;

class Movie
{
    /**
     * @var int|null L'identifiant du film
     */
    private ?int $id;

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
     * @var int|null L'identifiant du poster associé au film
     */
    private ?int $posterId;

    private function __construct()
    {

    }

    /**
     * Retourne l'identifiant du film
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Modifie l'identifiant du film
     *
     * @param int|null $id
     * @return Movie
     */
    private function setId(?int $id): Movie
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
     * @return int|null
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /**
     * Modifie l'idenfifiant du poster du film
     *
     * @param int|null $posterId
     * @return Movie
     */
    public function setPosterId(?int $posterId): Movie
    {
        $this->posterId = $posterId;
        return $this;
    }

    /**
     * Retourne le film avec l'identifiant renseigné.
     *
     * @param int $id
     * @return Movie
     * @throws EntityNotFoundException Si aucun film ne correspond à l'identifiant passé en paramètre
     */
    public static function findById(int $id): Movie
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM movie
            WHERE id = :movie_id;
            SQL
        );

        $stmt->execute([
            ':movie_id' => $id
        ]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Movie::class);

        $movie = $stmt->fetch();

        if (!$movie) {
            throw new EntityNotFoundException("no movie with this id found");
        }

        return $movie;
    }

    /**
     * Créé un un nouveau film.
     * Si l'identifiant entré n'est pas null, il sera
     *
     * @param string $title Le titre du film
     * @param string $overview Le résumé du film
     * @param $
     * @param int|null $id l'identifiant du film
     * @return Movie Le film créé
     */
    public static function create(string $title, string $overview, int $runtime, DateTime $releaseDate, string $originalLanguage = '', string $tagline = '', string $originalTitle = '', ?int $posterId = null, ?int $id = null): Movie
    {
        $movie = new Movie();

        $movie->setId($id)
              ->setTitle($title)
              ->setOverview($overview)
              ->setTagline($tagline)
              ->setRuntime($runtime)
              ->setReleaseDate(date_format($releaseDate, 'Y-m-d'))
              ->setOriginalTitle($originalTitle)
              ->setOriginalLanguage($originalLanguage)
              ->setPosterId($posterId);

        return $movie;
    }

    /**
     * Supprime l'instance de Movie dans la base de donnée
     *
     * @return Movie
     */
    public function delete(): Movie
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            DELETE FROM movie
            WHERE id = :movie_id;
            SQL
        );

        $stmt->execute([
            ':movie_id' => $this->getId()
        ]);

        $this->setId(null);

        return $this;
    }

    /**
     * Ajoute l'instance dans la base de donnée
     *
     * @return Movie
     * @throws Exception
     */
    protected function insert(): Movie
    {
        $pdo = MyPdo::getInstance();

        $stmt = $pdo->prepare(
            <<<'SQL'
            INSERT INTO movie (posterId, originalLanguage, originalTitle, overview, releaseDate, runtime, tagline, title)
            VALUES (:poster_id, :original_language, :original_title, :overview, :release_date, :runtime, :tagline, :title);
            SQL
        );

        $stmt->execute([
            ':poster_id' => $this->getPosterId(),
            ':original_language' => $this->getOriginalLanguage(),
            ':original_title' => $this->getOriginalTitle(),
            ':overview' => $this->getOverview(),
            ':release_date' => date_format($this->getReleaseDate(), 'Y-m-d'),
            ':runtime' => $this->getRuntime(),
            ':tagline' => $this->getTagline(),
            ':title' => $this->getTitle()
        ]);

        $this->setId((int) $pdo->lastInsertId());

        return $this;
    }

    /**
     * Met à jour le film
     *
     * @throws \Exception
     * @return Movie
     */
    public function update(): Movie
    {
        $pdo = MyPdo::getInstance();

        $stmt = $pdo->prepare(
            <<<'SQL'
            UPDATE movie
            SET title = :title,
                overview = :overview,
                releaseDate = :release_date,
                runtime = :runtime,
                tagline = :tagline
            WHERE id = :movie_id;
            SQL
        );

        $stmt->execute([
            ':movie_id' => $this->getId(),
            ':overview' => $this->getOverview(),
            ':release_date' => $this->getReleaseDate(),
            ':runtime' => $this->getRuntime(),
            ':tagline' => $this->getTagline(),
            ':title' => $this->getTitle()
        ]);

        return $this;
    }

    /**
     * Sauvegarde le film dans la base de donnée
     *
     * @throws \Exception
     * @return Movie
     */
    public function save(): Movie
    {
        if ($this->getId()) {
            $this->update();
        } else {
            $this->insert();
        }

        return $this;
    }

    /**
     * Retourne la liste des castings d'un film
     *
     * @return Casting[]
     */
    public function getCastings(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM cast
            WHERE movieId = :movie_id;
            SQL
        );

        $stmt->execute([
            ':movie_id' => $this->getId()
        ]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Casting::class);
    }
}
