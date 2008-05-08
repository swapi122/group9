{* Liệt kê sản phẩm ở đây*}
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td width=100%>
{foreach name=a from=$product_type->sanpham item=sanpham}
{* Liệt kê các biến trong object sanpham ra tại đây, làm sơ sơ để chứng tỏ mình làm rồi. Còn lại là của Triết*}
<span align=left>

Tên sp: {$sanpham->name}

</span>
{foreachelse}
<div><i>Không có sản phẩm nào</i></div>
{/foreach}
		
</td></tr>
</table>
