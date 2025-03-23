<?php

namespace Swoop\Bundle\AssetBundle\Formatter;

class HtmlAttributesFormatter
{
    public static function format(string $key, string $value = null): string
    {
        if ($value !== null) {
            return sprintf("%s=\"%s\"", $key, self::escape($value));
        } else {
            return $key;
        }
    }

    private static function escape(string $value): string
    {
        return esc_html(
            str_replace(
                '"',
                '&quot;',
                str_replace(
                    "'",
                    '&#39;',
                    $value
                )
            )
        );
    }
}