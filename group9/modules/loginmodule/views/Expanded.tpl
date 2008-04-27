{*
 * Copyright (c) 2004-2006 OIC Group, Inc.
 * Written and Designed by Phillip Ball
 *
 * This file is part of Exponent
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * GPL: http://www.gnu.org/licenses/gpl.txt
 *
 *}

<div class="loginmodule expanded">
{if $smarty.const.PREVIEW_READONLY == 1}
<i>{$logged_in_users}:</i><br />
{/if}
{if $loggedin == true || $smarty.const.PREVIEW_READONLY == 1}
{$_TR.welcome|sprintf:$displayname}<br />
<a href="{link action=editprofile}">Sửa thông tin</a>&nbsp;|&nbsp;
{if $is_group_admin}
<a href="{link action=mygroups}">Nhóm</a>&nbsp;|&nbsp;
{/if}
<a href="{link action=changepass}">Đổi mật khẩu</a>&nbsp;|&nbsp;
<a href="{link action=logout}">Thoát</a><br />
{/if}
{if $smarty.const.PREVIEW_READONLY == 1}
<hr size="1" />
<i>{$_TR.anon_users}:</i><br />
{/if}
{if $loggedin == false || $smarty.const.PREVIEW_READONLY == 1}
<form method="post" action="">
<input type="hidden" name="action" value="login" />
<input type="hidden" name="module" value="loginmodule" />
<input type="text" class="text" name="username" id="login_username" size="15" />
<input type="password" class="text" name="password" id="login_password" size="15" />
<input type="submit" class="button" value="Đăng nhập" /><br />
{if $smarty.const.SITE_ALLOW_REGISTRATION == 1}
<a href="{link action=createuser}">Tạo tài khoản</a>&nbsp;|&nbsp;
<a href="{link action=resetpass}">Mất mật khẩu</a>
{/if}
</form>
{/if}
</div>