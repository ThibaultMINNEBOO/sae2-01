<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Movie;
use PDO;

class MovieCollection
{
    /**
     * Retourne la liste de tous les films
     *
     * @return Movie[] un tableau composé de Movie
     */
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM movie
            SQL
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, Movie::class);
    }
}
