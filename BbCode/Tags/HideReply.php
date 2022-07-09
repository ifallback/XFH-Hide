<?php

namespace XFH\Hide\BbCode\Tags;

use XF;
use XFH\Hide\BbCode\AbstractTag;
use XFH\Hide\Traits\HasReplyTrait;

class HideReply extends AbstractTag
{
    use HasReplyTrait;

    public static function render($tagChildren, $tagOption, $tag, array $options, XF\BbCode\Renderer\AbstractRenderer $renderer): string
    {
        if (self::hasReply($options) || self::canBypassHide($options))
        {
            return self::renderTemplate($renderer->renderSubTree($tagChildren, $options),
                XF::phrase('xfh_hide_hidden_content_has_reply'), []);
        }

        return self::renderError(
            XF::phrase('xfh_hide_hidden_content_has_reply')
        );
    }
}