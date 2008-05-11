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
	{foreach name=a from=$providers item=provider}
	<div class="item">
		{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
		<div class="itemactions">
			{if $permissions.configure == 1 or $permissions.administrate == 1}
				<a href="{link action=edit_product id=$provider->id}" title="Sửa mẩu tin">
					<img src="{$smarty.const.ICON_RELATIVE}edit.png" title="{$_TR.alt_edit}" alt="{$_TR.alt_edit}" />
				</a>
				<a href="{link action=delete_product id=$provider->id}" title="Xóa mẩu tin">
					<img src="{$smarty.const.ICON_RELATIVE}delete.png" title="{$_TR.alt_delete}" alt="{$_TR.alt_delete}" />
				</a>
			{/if}
		</div>
		{/permissions}
		<div class="text">
			<h2><a href="{$provider->id}">{$provider->name}</a></h2>
			{include file="`$smarty.const.BASE`modules/sanphammodule/views/_sanpham_by_provider.tpl}
		</div>
		
	</div>
{foreachelse}
	<div><i>Chưa có hãng sản xuất nào</i></div>
{/foreach}
{if $permissions.administrate == 1}
	<div class="moduleactions">
	    <a href="{link action=edit_product}">Thêm sản phẩm mới</a>
	</div>
{/if}

</div>
	