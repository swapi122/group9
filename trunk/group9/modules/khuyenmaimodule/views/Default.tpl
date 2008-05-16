<script language=javascript src="{$smarty.const.THEME_RELATIVE}js/tooltip.js"></script>
<div class="khuyenmaimodule default">
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
	{foreach name=a from=$sanpham item=sp}
	<div class="item">
		<div class="text">
			{$sp->id;}
			{$echo "sdfjkahsd";}
			{include file="`$smarty.const.BASE`modules/khuyenmaimodule/views/_sanpham.tpl}
		</div>
		
	</div>
{foreachelse}
	<div class="item"><i>Không có sản phẩm nào khuyến mãi</i></div>
{/foreach}	

</div>
