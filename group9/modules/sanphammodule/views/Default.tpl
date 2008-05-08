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
		{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
		<div class="itemactions">
			{if $permissions.configure == 1 or $permissions.administrate == 1}

			{if $smarty.foreach.a.first == 0}
			<a href="{link action=rank_switch a=$listing->rank b=$prev id=$listing->id}">			
				<img src="{$smarty.const.ICON_RELATIVE}up.png" title="{$_TR.alt_previous}" alt="{$_TR.alt_previous}" />
			</a>
			{/if}

			<a href="{link action=edit_listing id=$listing->id}" title="Edit this entry">
				<img src="{$smarty.const.ICON_RELATIVE}edit.png" title="{$_TR.alt_edit}" alt="{$_TR.alt_edit}" />
			</a>
			<a href="{link action=delete_listing id=$listing->id}" title="Delete this entry">
				<img src="{$smarty.const.ICON_RELATIVE}delete.png" title="{$_TR.alt_delete}" alt="{$_TR.alt_delete}" />
			</a>


			{if $smarty.foreach.a.last == 0}
			<a href="{link action=rank_switch a=$next b=$listing->rank id=$listing->id}">
				<img src="{$smarty.const.ICON_RELATIVE}down.png" title="{$_TR.alt_next}" alt="{$_TR.alt_next}" />
			</a>
			{/if}
			{/if}
		</div>
		{/permissions}
		<div class="text">
			<h2><a href="{$product_type->id}">{$product_type->name}</a></h2>
			{* Liệt kê sản phẩm ở đây*}
			{foreach name=a from=$product_type->sanpham item=sanpham}
			{* Liệt kê các biến trong object sanpham ra tại đây, làm sơ sơ để chứng tỏ mình làm rồi. Còn lại là của Triết*}
			{foreachelse}
				<div><i>Không có sản phẩm nào</i></div>
			{/foreach}	
		</div>
		
	</div>
{foreachelse}
	<div><i>Chưa có loại sản phẩm</i></div>
{/foreach}	

{if $permissions.administrate == 1}
<div class="moduleactions">
    <a href="{link action=edit_listing}">Thêm sản phẩm mới</a>
</div>
{/if}

</div>
