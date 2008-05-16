{* Liệt kê sản phẩm ở đây*}
<table  border="0" cellspacing="0" cellpadding="0">
<tr>
{assign var='mycount' value=0}

{foreach name=a from=$sanpham item=sp}
{* Liệt kê các biến trong object sanpham ra tại đây, làm sơ sơ để chứng tỏ mình làm rồi. Còn lại là của Triết*}
{math equation='x+1' x=$mycount assign='mycount'}
<td width=33.3%>
<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" >
<tbody><tr><td bgcolor="#a7a7a7" height="1" width=100%></td></tr>
<tr><td class="body_center" align="center" bgcolor="#f4f4f4" height="30"><a href="{link action=view_detail module=sanphammodule id=$sp->id}" alt="Xem chi tiết sản phẩm này" title="Xem chi tiết sản phẩm này">{$sp->name}</a>
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.configure == 1 or $permissions.administrate == 1}
<br>
<div align=center>
	<a href="{link action=edit_product id=$sp->id}" title="Sửa sản phẩm" alt="Sửa sản phẩm">
		<img src="{$smarty.const.ICON_RELATIVE}edit.png" title="{$_TR.alt_edit}" alt="{$_TR.alt_edit}" />
	</a>
	<a href="{link action=delete_product id=$sp->id}" title="Xóa sản phẩm" alt="Xóa sản phẩm">
		<img src="{$smarty.const.ICON_RELATIVE}delete.png" title="{$_TR.alt_delete}" alt="{$_TR.alt_delete}" />
	</a>
</div>
{/if}
{/permissions}
</td></tr>
<tr><td bgcolor="#a7a7a7" height="1"></td></tr>
<tr height="5"><td></td></tr>
<tr><td width=100%>

<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr><td width="19%">
<table style="border-collapse: collapse;" border="1" bordercolor="#a7a7a7" cellpadding="0" cellspacing="0" width="100%">

<tbody><tr><td colspan="2" align="center">

<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="3" class="body_center" align="center" height="130" width="115">
<a href="{link action=view_detail module=sanphammodule id=$sp->id}"  onmouseover="Tip('{$sp->chitiet|escape:'quotes':'UTF-8'}',TITLE, '<div align=center>{$sp->name|escape:'quotes':'UTF-8'}</div>' , BGCOLOR, '#4a4542', FONTCOLOR, '#FFFFFF', BORDERCOLOR, '#f79226', FADEIN, 150, FADEOUT, 100)" onmouseout="UnTip()">
<img src="{$sp->pic_path}" border=0 width=100 height=100>
</a>
					  </td>
</tr>
</tbody>
</table>
</td></tr>

<tr bordercolor="#A7A7A7" bgcolor="#e7e6e6">
<td class="body_center" bgcolor="#e7e6e6" width="76%"><div align="center">{$sp->gia|mynumber_format}</div></td>
<td class="body_center" width="24%"><div align="center"><a href="{link action=add_item module=giohangmodule id=$sp->id}" alt="  Mua sản phẩm này  "  title="  Mua sản phẩm này  "><img src="{$smarty.const.THEME_RELATIVE}images/giohang.gif" border="0" height="13" width="11"></a></div></td>

</tr>
</tbody></table>
</td></tr>
</tbody></table>
</td></tr>		  
</tbody></table>

</td>
{* Xuong dong*}
{if $mycount%3 eq 0}
</tr><tr height="25"><td colspan=3></td></tr><tr>{/if}
{foreachelse}
<td width=100%><div><i>Không có sản phẩm nào</i></div></td>
{/foreach}


	
</tr>
</table>
