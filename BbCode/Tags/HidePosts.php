<?php

namespace XFH\Hide\BbCode\Tags;

use XF;
use XFH\Hide\BbCode\AbstractTag;

class HidePosts extends AbstractTag
{
    /**
     * @param $tagChildren
     * @param $tagOption
     * @param $tag
     * @param array $options
     * @param XF\BbCode\Renderer\AbstractRenderer $renderer
     * @return string
     */
    public static function render($tagChildren, $tagOption, $tag, array $options, XF\BbCode\Renderer\AbstractRenderer $renderer): string
    {
        $messages = intval($tagOption);

        if (XF::visitor()->message_count >= $messages || self::canBypassHide($options))
        {
            return self::renderTemplate($renderer->renderSubTree($tagChildren, $options),
                XF::phrase("xfh_hide_hidden_content_by_number_posts", [
                    "now" => XF::visitor()->message_count,
                    "need" => $messages
                ]), []);
        }

        return self::renderError(
            XF::phrase("xfh_hide_hidden_content_by_number_posts", [
            "now" => XF::visitor()->message_count,
            "need" => $messages
        ]));
    }
}