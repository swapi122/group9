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
				
			</tr>
	
	
	{foreach name=a from=$listings item=listing}
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
		
			<tr>
				<td>{$listing->madh}</td>
				<td>{$listing->makh}</td>
				<td>{$listing->ngaydathang|format_date:"%d/%m/%Y"}</td>
				<td>{$listing->giamgia}</td>
				<td>
				<select name='tt{$listing->id}'>
					<option value=0 {if $listing->tinhtrang == 0 } checked {/if}>Đơn hàng mới</option>
					<option value=1 {if $listing->tinhtrang == 1 } checked {/if}>Đang chờ thực hiện</option>
					<option value=2 {if $listing->tinhtrang == 2 } checked {/if}>Đã giao hàng</option>
					<option value=3 {if $listing->tinhtrang == 3 } checked {/if}>Hết hàng</option>
					<option value=4 {if $listing->tinhtrang == 4 } checked {/if}>Lỗi khác</option>
				</select>
				</td>
				
			</tr>
		
		<div style="clear:both"></div>
	</div>
{foreachelse}
	
	<div><i>Không có đơn hàng nào</i></div>
{/foreach}	
	</table>

</div>
