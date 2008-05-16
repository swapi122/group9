<div class="sanphammodule viewlisting">
	<h1>{$listing->name}</h1>
	<div class="sp">
	<table  border=0>
	<tr>
		<td>
			{if $listing->bigimage_file_id}
			<img class="listingimage" src="{$listing->picpath}" alt="{$listing->name}" />
			{/if}
		</td>
		<td>
		<ul>
			<li></b>Nhà sản xuất</b>: {$provider->name}</li>
			<li><b>Loại sản phẩm</b>: {$ptype->name}</li>
			<li><b>Giá bán</b>: {$listing->gia|mynumber_format}</li><br>
			<a href="{link action=add_item module=giohangmodule id=$listing->id}" title="Tôi đặt mua sản phẩm này" alt="Tôi đặt mua sản phẩm này"><img src="{$smarty.const.THEME_RELATIVE}images/order_pro.gif" border=0></a>
			</ul>
		</td>
	</tr>
	</table>		
	<h2 style="font-size: 18px;"><b>Các thông tin khác</b></h2>
	<ul>
		<li><b>Ngày sản xuất</b>:&nbsp;{$listing->ngaysanxuat|format_date:'%d/%m/%Y'}</li>
		<li><b>Kích thước</b>: {$listing->kichthuoc}</li>
		<li><b>Màu sắc</b>: {$listing->mausac}</li>
		<li><b>Thời gian bảo hành</b>: {$listing->baohanh|baohanh_format}</li>
		
		<li><b>Thông tin chi tiết khác</b><br>{$listing->chitiet}</li>
	</ul>
	</div>
</div>
