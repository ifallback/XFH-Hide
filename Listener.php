<?php

namespace XFH\Hide;

use XF;
use XFH\Hide\BbCode\AbstractTag;
use XF\Mvc\Controller;
use XF\Template\Templater;

class Listener
{
    /**
     * @param array $data
     * @param Controller $controller
     *
     * @return void
     */
    public static function editorDialog(array &$data, Controller $controller): void
    {
        if (strpos($data['dialog'], 'xfhHide') === 0)
        {
            $data['template'] = 'xfh_hide_editor_dialog_' . strtolower(
                str_replace('xfhHide', '', $data['dialog'])
                );
        }
    }

    /**
     * @param Templater $templater
     * @param           $type
     * @param           $template
     * @param array $params
     *
     * @return void
     */
    public static function templaterTemplatePreRender(Templater $templater, &$type, &$template, array &$params): void
    {
        $tags = AbstractTag::getHideTags();

        if (!XF::visitor()->hasPermission('xfh_hide_permissions', 'can_use_bb_codes'))
        {
            foreach ($tags as $tag)
            {
                $params['removeButtons'][] = 'xfCustom_' . $tag;
            }

            $params['xfhHideTags'] = [];
        }
        else
        {
            $availableTags = [];

            foreach ($tags as $tag)
            {
                if (!XF::visitor()->hasPermission('xfh_hide_permissions', 'can_use_' . $tag))
                {
                    $params['removeButtons'][] = 'xfCustom_' . $tag;
                }
                else
                {
                    $availableTags[] = $tag;
                }
            }

            $params['xfhHideTags'] = $availableTags;
        }
    }
}