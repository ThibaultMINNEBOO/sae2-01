<?php
declare(strict_types=1);

namespace Html;

class AppWebPage extends WebPage
{
    use StringEscaper;

    public function __construct(string $title = '')
    {
        parent::__construct($title);
        $this->appendCssUrl("/css/style_webpage.css");
    }

    public function toHTML(): string
    {
        return <<<HTML
        <!doctype html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>{$this->getTitle()}</title>
            {$this->getHead()}
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;900&display=swap" rel="stylesheet">
        </head>
        <body>
            <header class="header">
                <h1>{$this->getTitle()}</h1>
            </header>
            <main class="content">
                {$this->getBody()}
            </main>
        </body>
        </html>
        HTML;
    }
}