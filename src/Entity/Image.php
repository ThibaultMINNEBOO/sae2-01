<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

class Image
{
    /**
     * @var int l'identifiant de l'image
     */
    private int $id;

    /**
     * @var string Le contenu de l'image
     */
    private string $jpeg;

    /**
     * Retourne l'identifiant de l'image
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Retourne le contenu de l'image
     *
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * Retourne l'image concerné par l'identifiant passé en paramètre
     *
     * @param int $id l'identifiant de l'image
     * @throws EntityNotFoundException Si aucune image ne correspond à l'identifiant passé en paramètre
     * @return Image
     */
    public static function findById(int $id): self
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, jpeg
            FROM image
            WHERE id = :image_id
            SQL
        );

        $stmt->execute([
            ':image_id' => $id
        ]);

        $stmt->setFetchMode(\PDO::FETCH_CLASS, Image::class);
        $result = $stmt->fetch();

        if (!$result) {
            throw new EntityNotFoundException("No image with this id");
        }

        return $result;
    }
}