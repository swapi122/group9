<h1>{$moduletitle}</h1>
<form method=POST action=index.php name=basket_form>
<input type=hidden name=action value="update_basket">
<input type=hidden name=module value="giohangmodule">
<table width="100%" border=1 style="font-size:14px; font-family:Tahoma; color:gray; text-align:center; border-color: #61788F;"  align="center">
    <tr >
        <th width="40%" colspan=2 class="mytable_header">Chủng loại</td>
        <th width="20%" class="mytable_header">Đơn giá</td>
        <th width="15%" class="mytable_header">Số lượng</td>
        <th width="20%" class="mytable_header">Thành tiền</td>
        <th width="5%" class="mytable_header">Xóa</td>
    </tr>

{* Liệt kê danh sách sản phẩm trong giỏ hàng *}
{foreach name=a from=$products item=product}
    <tr >
        <td width=20%>
        {* Hình sản phẩm*}
        <a href="{link action=view_detail module=sanphammodule id=$product->product_detail->id}" target=_blank><img src="{$product->pic_path}" border=0 width=100 height=100 style="padding=top: 10px;"></a>
        </td>
        <td width=20%>
        {$product->product_detail->name}<br>
        {$product->product_detail->provider_name}
        </td>
        <td >
        {* đơn giá *}
        {$product->product_detail->gia|mynumber_format}
        </td>
        <td width="15%">
        {* Số lượng *}
        <input type=textbox name="sl{$product->id}" value="{$product->quality}" size=3>
        </td>
        <td width="20%">
        {$product->product_detail->gia*$product->quality|mynumber_format}
        </td>
        <td width="5%">
        <a href="{link action=remove_item id=$product-id}" title="Không mua sản phẩm này" alt="Không mua sản phẩm này">
        <img src="{$smarty.const.ICON_RELATIVE}deletemodule.png" border=0>
        </a>
        </td>
    </tr>
{foreachelse}
<tr><td colspan="6" width="10%">
<div><i>Tạm thời chưa có sản phẩm nào trong giỏ hàng</i></div>
</td></tr>
{/foreach}
</table>
<br><br>
<table  width="100%" border="0" cellspacing="10" cellpadding="0" style="font-size:14px; text-align:center;" >
<tr>
<td width=3% border=0>&nbsp;</td>
<th width="20%" align="center" border=1><a class="butchitiet" href="#">Quay lại</a></th>
<td width=3% border=0>&nbsp;</td>
<th width="20%" height="22" align="center" ><a class="butchitiet" href="javascript: document.forms['basket_form'].submit();">Cập nhật</a></th>
<td width=3% border=0>&nbsp;</td>

<th width="20%" align="center"><a class="butchitiet" href="{link action=clear_basket module=giohangmodule}">Rổng giỏ hàng</a></th>
<td width=3% border=0>&nbsp;</td>
<th width="20%" align="center" ><a class="butchitiet" href="{link action=checkout}">Đặt hàng</a></th>
<td width=3% border=0>&nbsp;</td>
</tr>
</table>
 </form>
