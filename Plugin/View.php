<?php

namespace Amasty\Fbreview\Plugin;

class View
{
    const DESCRIPTION_MAX_ALLOWED_CHARS = '300';

    /**
     * @param $object
     * @param string $text
     * @return string
     */
    public function afterEscapeHtml($object, $text)
    {
        return $this->validationText($text);
    }

    /**
     * @param $text
     * @return string
     */
    private function validationText($text)
    {
        /**
         * @param $text
         * @return mixed
         */
        $strip_tags_content = function ($text) {
            return htmlspecialchars(
                preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text),
                ENT_QUOTES,
                'UTF-8',
                false
            );
        };

        return $strip_tags_content(
            mb_strimwidth(
                strip_tags(
                    htmlspecialchars_decode($text)
                ),
                0,
                self::DESCRIPTION_MAX_ALLOWED_CHARS
            )
        );
    }
}
