<?php

namespace XFH\Hide\BbCode\Tags;

use XF;
use XFH\Hide\BbCode\AbstractTag;

class HideLikes extends AbstractTag
{
    /**
     * @param $tagChildren
     * @param $tagOption
     * @param $tag
     * @param array $options
     * @param XF\BbCode\Renderer\AbstractRenderer $renderer
     * @return string
     */
    public static function render($tagChildren, $tagOption, $tag, array $options, \XF\BbCode\Renderer\AbstractRenderer $renderer): string
    {
        $likes = intval($tagOption);

        if (XF::visitor()->reaction_score >= $likes || self::canBypassHide($options) )
        {
            return self::renderTemplate($renderer->renderSubTree($tagChildren, $options),
                XF::phrase("xfh_hide_hidden_content_by_reaction_score", [
                    "now" => XF::visitor()->reaction_score,
                    "need" => $likes
                ]), []);
        }

        return self::renderError(
            XF::phrase("xfh_hide_hidden_content_by_reaction_score", [
                "now" => XF::visitor()->reaction_score,
                "need" => $likes
        ]));
    }
}