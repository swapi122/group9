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
	{if (isset($sanpham))}
		<div class="item">
			<div class="text">
				<script language=javascript src="{$smarty.const.THEME_RELATIVE}js/contentslider.js"></script>
				<div id="slider1" class="sliderwrapper">
				{foreach name=a from=$sanpham item=sp}	
					<div class="contentdiv" align=center>
						<table  border=0 valign=top>
						    <tr>
						        <td>
						        	<img src="{$sp->pic_path}" border=0 width=100 height=100>
						        </td>
						        <td>
						        <h2>{$sp->name}</h2>
						        <div><b>Giá cũ</b>: <strike>{$sp->gia|mynumber_format}</strike></div>
						        <div><b>Giá khuyến mãi</b>: <font style="font-size: 14px; font-weight: bold; color: red;">{$sp->gia_khuyenmai|mynumber_format}</font></div>
						        <div>{$sp->chitiet_khuyenmai}</div>
						        </td>
						    </tr>
						</table>
					</div>

				{/foreach}
				</div>
	<div id="paginate-slider1" class="pagination">
	</div>	
	<script type="text/javascript">
featuredcontentslider.init({literal}{{/literal}
	id: "slider1",  
	contentsource: ["inline", ""],  
	toc: "markup",
	nextprev: ["", ""],  
	enablefade: [true, 0.3],  
	autorotate: [true, 3000], onChange: function(previndex, curindex){literal}{{/literal}{literal}}{/literal}
{literal}}{/literal})

</script>
	
			</div>		
		</div>
	{else}
		<div class="item"><i>Không có sản phẩm nào khuyến mãi</i></div>
	{/if}
</div>
