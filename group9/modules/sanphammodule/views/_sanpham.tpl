﻿{* Liệt kê sản phẩm ở đây*}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td width=100%>
{foreach name=a from=$product_type->sanpham item=sanpham}
{* Liệt kê các biến trong object sanpham ra tại đây, làm sơ sơ để chứng tỏ mình làm rồi. Còn lại là của Triết*}
<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="173">
<tbody><tr><td bgcolor="#a7a7a7" height="1"></td></tr>
<tr><td class="body_center" align="center" bgcolor="#f4f4f4" height="30" style="font-size: 13px;"><a href="{link action=view_detail module=sanphammodule id=$sanpham->id}" alt="Xem chi tiết sản phẩm này" title="Xem chi tiết sản phẩm này">{$sanpham->name}</a>
<br>
<div align=center>
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<a href="{link action=edit_product id=$sanpham->id}" title="Sửa sản phẩm" alt="Sửa sản phẩm">
		<img src="{$smarty.const.ICON_RELATIVE}edit.png" title="{$_TR.alt_edit}" alt="{$_TR.alt_edit}" />
	</a>
	<a href="{link action=delete_product id=$sanpham->id}" title="Xóa sản phẩm" alt="Xóa sản phẩm">
		<img src="{$smarty.const.ICON_RELATIVE}delete.png" title="{$_TR.alt_delete}" alt="{$_TR.alt_delete}" />
	</a>
{/if}
{/permissions}
</div>
</td></tr>
<tr><td bgcolor="#a7a7a7" height="1"></td></tr>
<tr><td>

<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr><td width="19%">
<table style="border-collapse: collapse;" border="1" bordercolor="#a7a7a7" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr><td colspan="2" align="center">

<table style="border-collapse: collapse;" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td colspan="3" class="body_center" align="center" height="130" width="115">
<a href="{link action=view_detail module=sanphammodule id=$sanpham->id}"  onmouseover="Tip('{$sanpham->chitiet|escape:'quotes':'UTF-8'}',TITLE, '<div align=center>{$sanpham->name|escape:'quotes':'UTF-8'}</div>' , WIDTH, 200, BGCOLOR, '#4a4542', FONTCOLOR, '#FFFFFF', BORDERCOLOR, '#f79226', FADEIN, 50, FADEOUT, 0)" onmouseout="UnTip()">
<img class=imageBorder  height=120 
					  src="http://gogovanphongpham.com.vn/csdl/images/CHI_PELIGRAPH.gif" width=120 border=0> </a>
					  </td>
</tr>
</tbody>
</table>
</td></tr>

<tr bordercolor="#A7A7A7" bgcolor="#e7e6e6">
<td class="body_center" bgcolor="#e7e6e6" width="76%"><div align="center">{$sanpham->gia}</div></td>
<td class="body_center" width="24%"><div align="center"><a href="{link action=add_product module=giohangmodule id=$sanpham->id}" alt="  Mua sản phẩm này  "  title="  Mua sản phẩm này  "><img src="{$smarty.const.THEME_RELATIVE}images/giohang.gif" border="0" height="13" width="11"></a></div></td>

</tr>
</tbody></table>
</td></tr>
</tbody></table>
</td></tr>		  
</tbody></table>

{foreachelse}
<div><i>Không có sản phẩm nào</i></div>
{/foreach}


	
</td></tr>
</table>
