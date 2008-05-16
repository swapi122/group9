{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.configure == 1 or $permissions.administrate == 1}
<form method=POST action=index.php name=donhang_form>
<input type=hidden name=action value="update_donhang">
<input type=hidden name=module value="quanlydonhangmodule">
<div class="quanlydonhangmodule default">
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
	
	<table border="1"  width="100%"  style="font-size:14px; font-family:Tahoma; color:gray; text-align:center; border-color: #B7B7B7;" align="center">
			<tr >
				<th >Mã ĐH</th>
				<th >Mã KH</th>
				<th >Ngày ĐH</th>
				<th >Giảm Giá</th>
				<th >Tình Trạng</th>
				<th>Xóa</th>
			</tr>
	
	
	{foreach name=a from=$listings item=listing}
	<div class="item">
		
			<tr>
				<td>{$listing->madh}</td>
				<td>{$listing->makh}</td>
				<td>{$listing->ngaydathang|format_date:"%d/%m/%Y %H:%M:%S"}</td>
				<td>{$listing->giamgia|mynumber_format}</td>
				<td>
				<select name='tt{$listing->madh}'>
					<option value=0 {if $listing->tinhtrang == 0 } selected {/if}>Đơn hàng mới</option>
					<option value=1 {if $listing->tinhtrang == 1 } selected {/if}>Đang chờ thực hiện</option>
					<option value=2 {if $listing->tinhtrang == 2 } selected {/if}>Đã giao hàng</option>
					<option value=3 {if $listing->tinhtrang == 3 } selected {/if}>Hết hàng</option>
					<option value=4 {if $listing->tinhtrang == 4 } selected {/if}>Lỗi khác</option>
				</select>
				</td>
				<td>
				{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
		<div class="itemactions">
			{if $permissions.configure == 1 or $permissions.administrate == 1}
			<a href="{link action=remove_donhang id=$listing->madh}" title="Delete this entry">
				<img src="{$smarty.const.ICON_RELATIVE}delete.png" title="{$_TR.alt_delete}" alt="{$_TR.alt_delete}" />
			</a>
			{/if}
		</div>
		{/permissions}
				</td>
			</tr>
		
		<div style="clear:both"></div>
	</div>
{foreachelse}
	<div><i>Không có đơn hàng nào</i></div>
{/foreach}	
</table>
{if $count_listings	> 0 }
<br><br>
<div align=center>
<table  border="0" cellspacing="10" cellpadding="0" style="font-size:14px; text-align:center;" >
<tr>
<th width="80" height="20" align="center" ><a class="butchitiet" href="javascript: document.forms['donhang_form'].submit();">Cập nhật</a></th>
</tr>
</table>
</div>
{/if}
</div>
</form>
{else}
<h1>Quản lý đơn hàng</h1>
<h2>Bạn không được xem module này</h2>
{/if}
{/permissions}
