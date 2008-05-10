{$moduletitle}
<form method=POST action=index.php name=basket_form>
<input type=hidden name=action value="update_basket">
<input type=hidden name=module value="giohangmodule">
<table width=100% border=0>
    <tr>
        <td width=40% colspan=2><b>Chủng loại</b></td>
        <td><b>Đơn giá</b></td>
        <td><b>Số lượng</b></td>
        <td><b>Thành tiền</b></td>
        <td>&nbsp;</td>
    </tr>

{* Liệt kê danh sách sản phẩm trong giỏ hàng *}
{foreach name=a from=$products item=product}
    <tr>
        <td width=15%>
        {* Hình sản phẩm*}
        
        </td>
        <td width=21%>
        {$product->product_detail->name}<br>
        {$product->product_detail->provider_name}
        </td>
        <td>
        {* đơn giá *}
        {$product->product_detail->gia}
        </td>
        <td>
        {* Số lượng *}
        <input type=textbox name="sl{$product->id}" value="{$product->quality}" size=3>
        </td>
        <td>
        {$product->product_detail->gia*$product->quality}
        </td>
        <td>
        <a href="{link action=remove_item id=$product-id}" title="Không mua sản phẩm này" alt="Không mua sản phẩm này">
        <img src="{$smarty.const.ICON_RELATIVE}deletemodule.png" border=0>
        </a>
        </td>
    </tr>
{foreachelse}
<tr><td>
<div><i>Tạm thời chưa có sản phẩm nào trong giỏ hàng</i></div>
</td></tr>
{/foreach}
</table>
<br><br>
<table  border="0" cellspacing="0" cellpadding="0">
<tr>
<td>&nbsp;</td>
<td width="80" align="center" background="{$smarty.const.THEME_RELATIVE}images/butchitiet.gif" class="butchitiet"><a class="butchitiet" href="#">Quay lại</a></td>
<td width="30">&nbsp;</td>
<td width="80" height="22" align="center" background="{$smarty.const.THEME_RELATIVE}images/butchitiet.gif"><a class="butchitiet" href="javascript: document.forms['basket_form'].submit();">Cập nhật</a></td>
<td width="30" align="center">&nbsp;</td>
<td width="80" align="center" background="{$smarty.const.THEME_RELATIVE}images/butchitiet.gif" class="butchitiet"><a class="butchitiet" href="{link action=clear_basket module=giohangmodule}">Rổng giỏ hàng</a></td>
<td width="30" align="center">&nbsp;</td>
<td width="80" align="center" background="{$smarty.const.THEME_RELATIVE}images/butchitiet.gif" class="butchitiet"><a class="butchitiet" href="{link action=checkout}">Đặt hàng</a></td>
<td>&nbsp;</td>
</tr>
</table>
 </form>
