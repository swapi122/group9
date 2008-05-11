{* Liệt kê sản phẩm ở đây*}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td width=100%>
{foreach name=a from=$provider->sanpham item=sanpham}
{* Liệt kê các biến trong object sanpham ra tại đây, làm sơ sơ để chứng tỏ mình làm rồi. Còn lại là của Triết*}
<span align=left>

Tên sp: {$sanpham->name}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<a href="{link action=edit_product id=$sanpham->id}" title="Sửa mẩu tin">
		<img src="{$smarty.const.ICON_RELATIVE}edit.png" title="{$_TR.alt_edit}" alt="{$_TR.alt_edit}" />
	</a>
	<a href="{link action=delete_product id=$sanpham->id}" title="Xóa mẩu tin">
		<img src="{$smarty.const.ICON_RELATIVE}delete.png" title="{$_TR.alt_delete}" alt="{$_TR.alt_delete}" />
	</a>
{/if}
</span>
{foreachelse}
<div><i>Không có sản phẩm nào</i></div>
{/foreach}
