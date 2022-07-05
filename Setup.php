<?php

namespace XFH\Hide;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    public function installStep1(): void
    {
        $dropdown = $this->app->em()->create('XF:EditorDropdown');

        $dropdown->bulkSet([
            'cmd' => 'xfh_hide_dropdown',
            'icon' => 'fa-eye-slash',
            'buttons' => [
                'xfCustom_hide', 'xfCustom_likes', 'xfCustom_staff', 'xfCustom_posts',
                'xfCustom_days', 'xfCustom_users', 'xfCustom_usersexc'
            ],
            'display_order' => 10000
        ]);

        $dropdown->save();
    }

    public function uninstallStep1(): void
    {
        $this->app->finder('XF:EditorDropdown')
            ->where('cmd', 'xfh_hide_dropdown')
            ->fetchOne()
            ->delete();
    }
}