<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    use StringEscaper;

    /**
     * @var string L'en-tête de la page
     */
    private string $head = '';
    /**
     * @var string le titre de la page
     */
    private string $title = '';
    /**
     * @var string le corps de la page
     */
    private string $body = '';

    /**
     * Instancie une page web
     *
     * @param string $title le titre de la page
     */
    public function __construct(string $title = '')
    {
        $this->setTitle($title);
    }

    /**
     * Met à jour le titre de la page
     *
     * @param string $title le nouveau titre de la page
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Retourne l'en-tête de la page
     *
     * @return string l'en-tête de la page
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * Retourne le titre de la page
     *
     * @return string le titre de la page
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Retourne le corps de la page
     *
     * @return string le corps de la page
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Ajoute du contenu à l'en-tête de la page
     *
     * @param string $content contenu à ajouter à l'en-tête de la page
     * @return void
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * Incorpore un code CSS donné à la page web
     *
     * @param string $css code css à incorporer à la page
     * @return void
     */
    public function appendCss(string $css): void
    {
        $this->appendToHead(
            <<<HTML
            <style>
                {$css}
            </style>
            HTML
        );
    }

    /**
     * Lie une ressource CSS à la page grâce à son URL
     *
     * @param string $url l'url de la ressource CSS à lié à la page
     * @return void
     */
    public function appendCssUrl(string $url): void
    {
        $this->appendToHead(
            <<<HTML
            <link rel="stylesheet" href="{$url}">
            HTML
        );
    }

    /**
     * Ajoute du code JavaScript à la page
     *
     * @param string $js code JavaScript à ajouter à la page
     * @return void
     */
    public function appendJs(string $js): void
    {
        $this->appendContent(
            <<<HTML
            <script>
                {$js}
            </script>
            HTML
        );
    }

    /**
     * Lie une ressource JavaScript à la page grâce à son URL
     *
     * @param string $url l'url de la ressource JavaScript à lier à la page
     * @return void
     */
    public function appendJsUrl(string $url): void
    {
        $this->appendContent(
            <<<HTML
            <script src="{$url}"></script>
            HTML
        );
    }

    /**
     * Ajoute du contenu au corps de la page
     *
     * @param string $content contenu à ajouter au corps de la page
     * @return void
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * Convertit l'instance en code HTML
     *
     * @return string code HTML de la page
     */
    public function toHTML(): string
    {
        $lastModifications = self::getLastModification();

        return <<<HTML
            <!doctype html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>{$this->getTitle()}</title>
                {$this->getHead()}
            </head>
            <body>
                {$this->getBody()}
                <span style="float: right; font-style: italic">Dernières modifications le {$lastModifications}</span>
            </body>
            </html>
        HTML;
    }

    /**
     * @return string la date de la dernière modification sous format d/M/Y - H:i:s
     */
    public static function getLastModification(): string
    {
        return date('d/m/Y - H:i:s', getlastmod());
    }
}
