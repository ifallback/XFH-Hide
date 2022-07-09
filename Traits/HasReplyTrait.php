<?php

namespace XFH\Hide\Traits;

use XF;

trait HasReplyTrait
{
    public static function hasReply($options): bool
    {
        $threadId = 0;

        if ($options['entity']['thread_id'])
        {
            $threadId = $options['entity']['thread_id'];
        }

        if (!$threadId)
        {
            return false;
        }

        $finder = XF::app()->finder('XF:Post');

        $posts = $finder->where([
            ['thread_id', $threadId],
            ["user_id", XF::visitor()->user_id],
            ['message_state', 'visible']
        ])
        ->limit(1)
        ->fetch();

        return $posts->count();
    }
}