<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use DateTime;
use Entity\Exception\EntityNotFoundException;
use Exception;
use PDO;

class Actor
{
    /**
     * @var int l'identifiant de l'acteur
     */
    private int $id;

    /**
     * @var int|null l'identifiant de l'avatar de l'acteur
     */
    private ?int $avatarId;

    /**
     * @var string le nom de l'acteur
     */
    private string $name;

    /**
     * @var string|null la date de naissance de l'acteur
     */
    private ?string $birthday;

    /**
     * @var string|null la date de décès de l'acteur
     */
    private ?string $deathday;

    /**
     * @var string la biographie de l'acteur
     */
    private string $biography;

    /**
     * @var string La ville de naissance de l'acteur
     */
    private string $placeOfBirth;

    /**
     * Retourne l'acteur correspondant à l'identifiant passé en paramètre
     *
     * @param int $id l'identifiant de l'acteur
     * @return Actor
     * @throws EntityNotFoundException Si l'acteur n'est pas trouvé
     */
    public static function findById(int $id): Actor
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM people
            WHERE id = :actor_id;
            SQL
        );

        $stmt->execute([
            ':actor_id' => $id
        ]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, Actor::class);

        $actor = $stmt->fetch();
        if (!$actor) {
            throw new EntityNotFoundException("no actor found with this id");
        }

        return $actor;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getAvatarId(): ?int
    {
        return $this->avatarId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DateTime|null
     * @throws Exception
     */
    public function getBirthday(): ?DateTime
    {
        if (!$this->birthday) {
            return null;
        }
        return new DateTime($this->birthday);
    }

    /**
     * @return DateTime|null
     * @throws Exception
     */
    public function getDeathday(): ?DateTime
    {
        if (!$this->deathday) {
            return null;
        }
        return new DateTime($this->deathday);
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @return string
     */
    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    /**
     * Retourne la liste des castings auquel a participé l'acteur
     *
     * @return Casting[]
     */
    public function getCastings(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM cast
            WHERE peopleId = :actor_id;
            SQL
        );

        $stmt->execute([
            ':actor_id' => $this->getId()
        ]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Casting::class);
    }
}
