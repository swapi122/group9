﻿<script language=javascript src="{$smarty.const.THEME_RELATIVE}js/tooltip.js"></script>
<div class="listingmodule default">
		{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
		{if $permissions.administrate == 1}
			<a href="{link action=userperms _common=1}"><img src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{$_TR.alt_userperm}" alt="{$_TR.alt_userperm}" /></a>
			<a href="{link action=groupperms _common=1}"><img src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{$_TR.alt_groupperm}" alt="{$_TR.alt_groupperm}" /></a>
		{/if}
		{if $permissions.configure == 1}
		        	<a href="{link action=configure _common=1}"><img src="{$smarty.const.ICON_RELATIVE}configure.png" title="{$_TR.alt_configure}" alt="{$_TR.alt_configure}" /></a>
		{/if}
		{if $permissions.configure == 1 or $permissions.administrate == 1}
			<br />
		{/if}
		{/permissions}

	{if $moduletitle}<h1>{$moduletitle}</h1>{/if}
	{foreach name=a from=$product_types item=product_type}
	<div class="item">
		<div class="text">
			<h2><a href="{link action=view_product_by_type module=sanphammodule id=$product_type->id}">{$product_type->name}</a>
			{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
			{if $permissions.configure == 1 or $permissions.administrate == 1}
				<a href="{link action=edit_listing id=$product_type->id module=loaisanphammodule}" title="Sửa lọai sản phẩm" alt="Sửa lọai sản phẩm">
					<img src="{$smarty.const.ICON_RELATIVE}edit.png" title="{$_TR.alt_edit}" alt="{$_TR.alt_edit}" />
				</a>
				<a href="{link action=delete_listing id=$product_type->id module=loaisanphammodule}" title="Xóa mẩu tin">
					<img src="{$smarty.const.ICON_RELATIVE}delete.png" title="{$_TR.alt_delete}" alt="{$_TR.alt_delete}" />
				</a>
			{/if}
		{/permissions}
		</h2>
			{include file="`$smarty.const.BASE`modules/sanphammodule/views/_sanpham.tpl}
		</div>
		
	</div>
{foreachelse}
	<div class="item"><i>Chưa có loại sản phẩm</i></div>
{/foreach}	

{if $permissions.administrate == 1}
	<div class="moduleactions">
	    <a href="{link action=edit_product}">Thêm sản phẩm mới</a>
	</div>
{/if}

</div>
