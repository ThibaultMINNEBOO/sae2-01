<?php

declare(strict_types=1);

namespace Html;

trait StringEscaper
{
    /**
     * Protège une chaine de caractère
     *
     * @param string|null $text la chaîne à protéger
     * @return string la chaîne protégée
     */
    public function escapeString(?string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
    }

    /**
     * Nettoie une chaîne de caractère
     *
     * @param string|null $text
     * @return string
     */
    public function stripTagsAndTrim(?string $text): string
    {
        if (!$text) {
            return "";
        }

        return trim(strip_tags($text));
    }
}
