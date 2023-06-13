<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use PDO;

class Casting
{
    /**
     * @var int l'identifiant du casting
     */
    private int $id;

    /**
     * @var int l'identifiant du film
     */
    private int $movieId;

    /**
     * @var int l'identifiant de l'acteur
     */
    private int $peopleId;

    /**
     * @var string le rôle de l'acteur
     */
    private string $role;

    /**
     * @var int L'importance du rôle
     */
    private int $orderIndex;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return int
     */
    public function getOrderIndex(): int
    {
        return $this->orderIndex;
    }

    /**
     * Retourne l'acteur participant au casting
     *
     * @return Actor
     */
    public function getActor(): Actor
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM people
            WHERE id = (
                SELECT peopleId
                FROM cast
                WHERE peopleId = :actor_id
            );
            SQL
        );

        $stmt->execute([
            ':actor_id' => $this->peopleId
        ]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Actor::class);

        return $stmt->fetch();
    }

    /**
     * Retourne le film du casting
     *
     * @return Movie
     */
    public function getMovie(): Movie
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM movie
            WHERE id = (
                SELECT movieId
                FROM cast
                WHERE movieId = :movie_id
            );
            SQL
        );

        $stmt->execute([
            ':movie_id' => $this->movieId
        ]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Movie::class);

        return $stmt->fetch();
    }
}