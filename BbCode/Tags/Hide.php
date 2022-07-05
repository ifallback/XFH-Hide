<?php

namespace XFH\Hide\BbCode\Tags;

use XF;
use XFH\Hide\BbCode\AbstractTag;

class Hide extends AbstractTag
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
        if (XF::visitor()->user_id)
        {
            return self::renderTemplate($renderer->renderSubTree($tagChildren, $options),
                XF::phrase('xfh_hide_hidden_content_for_registred_users'), []);
        }

        return XF::app()->templater()
            ->renderTemplate("public:xfh_hide_auth_or_register", [
                "error" => XF::phrase('xfh_hide_to_view_content_need_register_or_signup', [
                    "register" => XF::app()->router('public')->buildLink('register'),
                    "login" => XF::app()->router('public')->buildLink('login')
                ])
            ]);
    }
}