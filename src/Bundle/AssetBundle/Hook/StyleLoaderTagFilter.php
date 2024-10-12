<?php

namespace Swoop\Bundle\AssetBundle\Hook;

use Swoop\Bundle\AssetBundle\Formatter\HtmlAttributesFormatter;
use Swoop\Bundle\HookBundle\Model\AbstractFilter;
class StyleLoaderTagFilter extends AbstractFilter
{
    /**
     * @inheritDoc
     */
    public function getFunction(...$args)
    {
        $tag = $args[0];
        $handle = $args[1];
        if ($htmlAttributes = wp_styles()->get_data($handle, 'htmlAttributes')) {
            if (is_array($htmlAttributes) && !empty($htmlAttributes)) {
                $formattedAttributes = [];
                foreach ($htmlAttributes as $key => $value) {
                    if (in_array($key, ['type', 'id'])) {
                        $formattedAttributes[] = HtmlAttributesFormatter::format($key, $value);
                    }
                }
                if (!empty($formattedAttributes)) {
                    $formattedAttributes = implode(' ', $formattedAttributes);
                    $tag = preg_replace(':(?=>):', " {$formattedAttributes}", $tag, 1);
                }
                if (isset($htmlAttributes['type'])) {
                    $formattedType = HtmlAttributesFormatter::format('type', $htmlAttributes['type']);
                    $tag = preg_replace('/ type=\'text/css\'/', " {$formattedType}", $tag, 1);
                }
                if (isset($htmlAttributes['id'])) {
                    $formattedId = HtmlAttributesFormatter::format('id', $htmlAttributes['type']);
                    $tag = preg_replace('/ id=\'[A-Za-z]+[\w\-:.]*\'/', " {$formattedId}", $tag, 1);
                }
            }
        }
        return $tag;
    }
}
