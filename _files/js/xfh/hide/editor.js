var XFH = window.XFH || {};
XFH.HideBbCodeDialog = window.XFH.HideBbCodeDialog || {};
XFH.HideEditorHelpers = window.XFH.HideEditorHelpers || {};

!function($, window, document, _undefined)
{
    "use strict";

    XFH.HideBbCodeDialog = {
        init: function ()
        {
            let hideTags = {};

            try
            {
                hideTags = $.parseJSON($('.js-xfhHideTags').first().html()) || {};
            }
            catch (e)
            {
                console.error(e);
            }

            for (const tag of hideTags)
            {
                const command = 'xfCustom_' + tag,
                    dialogName = 'xfhHide' + tag[0].toUpperCase() + tag.slice(1);

                if ($.FE.COMMANDS[command])
                {
                    $.FE.COMMANDS[command].callback = function ()
                    {
                        const $editor = XF.getEditorInContainer($('.js-editor'));
                        if ($editor.ed)
                        {
                            const range = $editor.ed.selection.ranges()[0];

                            if (range.startOffset === range.endOffset)
                            {
                                XF.EditorHelpers.loadDialog(this, dialogName);
                            }
                            else
                            {
                                XF.EditorHelpers.wrapSelectionText(
                                    this,
                                    '[' + tag.toUpperCase() + ']',
                                    '[/' + tag.toUpperCase() + ']',
                                    true
                                );
                            }
                        }
                        else
                        {
                            XF.EditorHelpers.loadDialog(this, dialogName);
                        }
                    }
                }

                XFH.HideEditorHelpers.registerDialogs();
            }
        },

        EditorHideDialog: XF.extend(XF.EditorDialog, {
            _init: function()
            {
                $('#xfh_hide_editor_hide_form').submit(XF.proxy(this, 'submit'));
            },

            submit: function(e)
            {
                e.preventDefault();

                const ed = this.ed,
                    overlay = this.overlay,
                    tag = this.dialog.match(/^xfhHide([a-zA-Z0-9_]+)$/)[1]?.toUpperCase(),
                    $text = $('#xfh_hide_editor_hide_text')

                if (!tag)
                {
                    return;
                }

                console.log($text)

                ed.undo.saveStep();
                XFH.HideEditorHelpers.insertTag(ed, tag, null, $.trim($text.val()));
                ed.undo.saveStep();

                $text.val('');

                overlay.hide();
            }
        }),

        EditorLikesDialog: XF.extend(XF.EditorDialog, {
            _init: function()
            {
                $('#xfh_hide_editor_likes_form').submit(XF.proxy(this, 'submit'));
            },

            submit: function(e)
            {
                e.preventDefault();

                const ed = this.ed,
                    overlay = this.overlay,
                    tag = this.dialog.match(/^xfhHide([a-zA-Z0-9_]+)$/)[1]?.toUpperCase(),
                    $text = $('#xfh_hide_editor_likes_text'),
                    $count = $('#xfh_hide_editor_likes_count')

                if (!tag)
                {
                    return;
                }

                ed.undo.saveStep();
                XFH.HideEditorHelpers.insertTag(ed, tag, $count.val(), $.trim($text.val()));
                ed.undo.saveStep();

                $text.val('');
                $count.val(0);

                overlay.hide();
            }
        }),

        EditorStaffDialog: XF.extend(XF.EditorDialog, {
            _init: function()
            {
                $('#xfh_hide_editor_staff_form').submit(XF.proxy(this, 'submit'));
            },

            submit: function(e)
            {
                e.preventDefault();

                const ed = this.ed,
                    overlay = this.overlay,
                    tag = this.dialog.match(/^xfhHide([a-zA-Z0-9_]+)$/)[1]?.toUpperCase(),
                    $text = $('#xfh_hide_editor_staff_text')

                if (!tag)
                {
                    return;
                }

                ed.undo.saveStep();
                XFH.HideEditorHelpers.insertTag(ed, tag, null, $.trim($text.val()));
                ed.undo.saveStep();

                $text.val('');

                overlay.hide();
            }
        }),

        EditorPostsDialog: XF.extend(XF.EditorDialog, {
            _init: function()
            {
                $('#xfh_hide_editor_posts_form').submit(XF.proxy(this, 'submit'));
            },

            submit: function(e)
            {
                e.preventDefault();

                const ed = this.ed,
                    overlay = this.overlay,
                    tag = this.dialog.match(/^xfhHide([a-zA-Z0-9_]+)$/)[1]?.toUpperCase(),
                    $text = $('#xfh_hide_editor_posts_text'),
                    $count = $('#xfh_hide_editor_posts_count')

                if (!tag)
                {
                    return;
                }

                ed.undo.saveStep();
                XFH.HideEditorHelpers.insertTag(ed, tag, $count.val(), $.trim($text.val()));
                ed.undo.saveStep();

                $text.val('');
                $count.val(0);

                overlay.hide();
            }
        }),

        EditorDaysDialog: XF.extend(XF.EditorDialog, {
            _init: function()
            {
                $('#xfh_hide_editor_days_form').submit(XF.proxy(this, 'submit'));
            },

            submit: function(e)
            {
                e.preventDefault();

                const ed = this.ed,
                    overlay = this.overlay,
                    tag = this.dialog.match(/^xfhHide([a-zA-Z0-9_]+)$/)[1]?.toUpperCase(),
                    $text = $('#xfh_hide_editor_days_text'),
                    $count = $('#xfh_hide_editor_days_count')

                if (!tag)
                {
                    return;
                }

                ed.undo.saveStep();
                XFH.HideEditorHelpers.insertTag(ed, tag, $count.val(), $.trim($text.val()));
                ed.undo.saveStep();

                $text.val('');
                $count.val(0);

                overlay.hide();
            }
        }),

        EditorUsersDialog: XF.extend(XF.EditorDialog, {
            _init: function()
            {
                $('#xfh_hide_editor_users_form').submit(XF.proxy(this, 'submit'));
            },

            submit: function(e)
            {
                e.preventDefault();

                const ed = this.ed,
                    overlay = this.overlay,
                    tag = this.dialog.match(/^xfhHide([a-zA-Z0-9_]+)$/)[1]?.toUpperCase(),
                    $text = $('#xfh_hide_editor_users_text'),
                    $users = $('#xfh_hide_editor_users')

                if (!tag)
                {
                    return;
                }

                ed.undo.saveStep();
                XFH.HideEditorHelpers.insertTag(ed, tag, $users.val(), $.trim($text.val()));
                ed.undo.saveStep();

                $text.val('');

                overlay.hide();
            }
        }),

        EditorUsersExcDialog: XF.extend(XF.EditorDialog, {
            _init: function()
            {
                $('#xfh_hide_editor_usersexc_form').submit(XF.proxy(this, 'submit'));
            },

            submit: function(e)
            {
                e.preventDefault();

                const ed = this.ed,
                    overlay = this.overlay,
                    tag = this.dialog.match(/^xfhHide([a-zA-Z0-9_]+)$/)[1]?.toUpperCase(),
                    $text = $('#xfh_hide_editor_usersexc_text'),
                    $users = $('#xfh_hide_editor_usersexc')

                if (!tag)
                {
                    return;
                }

                ed.undo.saveStep();
                XFH.HideEditorHelpers.insertTag(ed, tag, $users.val(), $.trim($text.val()));
                ed.undo.saveStep();

                $text.val('');

                overlay.hide();
            }
        }),
    }

    XFH.HideEditorHelpers = $.extend(XF.EditorHelpers, {
        insertTag: function (ed, tag, option, text)
        {
            let output;

            output = '[' + tag + (option ? '=' + option : '') + ']' + text + '[/' + tag + ']';

            ed.html.insert(output);
        },

        registerDialogs: function ()
        {
            XF.EditorHelpers.dialogs.xfhHideHide = new XFH.HideBbCodeDialog.EditorHideDialog('xfhHideHide');
            XF.EditorHelpers.dialogs.xfhHideLikes = new XFH.HideBbCodeDialog.EditorLikesDialog('xfhHideLikes');
            XF.EditorHelpers.dialogs.xfhHideStaff = new XFH.HideBbCodeDialog.EditorStaffDialog('xfhHideStaff');
            XF.EditorHelpers.dialogs.xfhHidePosts = new XFH.HideBbCodeDialog.EditorPostsDialog('xfhHidePosts');
            XF.EditorHelpers.dialogs.xfhHideDays = new XFH.HideBbCodeDialog.EditorDaysDialog('xfhHideDays');
            XF.EditorHelpers.dialogs.xfhHideUsers = new XFH.HideBbCodeDialog.EditorUsersDialog('xfhHideUsers');
            XF.EditorHelpers.dialogs.xfhHideUsersexc = new XFH.HideBbCodeDialog.EditorUsersExcDialog('xfhHideUsersexc');
        }
    });

    $(document).on('editor:first-start', XFH.HideBbCodeDialog.init);

    XF.editorStart.custom.push('HideBbCodeDialog');
}
(jQuery, window, document)