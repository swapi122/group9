<div class="sanphammodule viewlisting">
	<h1>{$listing->name}</h1>
	<div class="bodycopy">
	<table  border=0>
	<tr>
		<td>
			{if $listing->file_id}
			<img class="listingimage" src="{$smarty.const.PATH_RELATIVE}thumb.php?id={$listing->file_id}&constraint=1&width=225&height=275" alt="{$listing->name}" />
			{/if}
		</td>
		<td>
			<b>Nhà sản xuất</b>: {$provider->name}<br>
			<b>Loại sản phẩm</b>: {$ptype->name}<br>
			<b>Giá bán</b>: {$listing->gia}<br><br>
			<a href="{link action=add_item module=giohangmodule id=$listing->id}" title="Tôi đặt mua sản phẩm này" alt="Tôi đặt mua sản phẩm này"><img src="{$smarty.const.THEME_RELATIVE}images/order_pro.gif" border=0></a>
		</td>
	</tr>
	</table>		
	<h2 style="font-size: 18px;"><b>Các thông tin khác</b></h2>
		<p><b>Ngày sản xuất</b>:{$listing->ngaysanxuat}</p>
		<p><b>Kích thước</b>:{$listing->kichthuoc}</p>
		<p><b>Màu sắc</b>:{$listing->mausac}</p>
		<p><b>Thời gian bảo hành</b>:{$listing->baohanh}</p>
		<p><b>Thông tin chi tiết khác</b><br>{$listing->chitiet}</p>
	</div>
</div>
