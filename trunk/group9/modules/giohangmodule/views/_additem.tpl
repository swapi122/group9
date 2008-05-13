
<script type="text/javascript">
{literal}
var message = "{/literal}{$_TR.confirm}";{literal}
YAHOO.namespace("example.container");

function init() {
	
	// Define various event handlers for Dialog
	var handleYes = function() {
		this.hide();
		document.location = {/literal}"{$redirect}";{literal}
	};
	var handleNo = function() {
		this.hide();
		var textlink = {/literal}"{link action=view_basket module=giohangmodule}";{literal}
		document.location = textlink.replace(/&amp;/g,"&");
	};

	// Instantiate the Dialog
	YAHOO.example.container.simpledialog1 = new YAHOO.widget.SimpleDialog("simpledialog1",
									{ 	width: "400px",
										fixedcenter: true,
										visible: false,
										draggable: false,
										close: true,
										text: "Bạn đã chọn mua thành công sản phẩm {/literal}{$sanpham->name}{literal}",
										icon: YAHOO.widget.SimpleDialog.ICON_HELP,
										constraintoviewport: true,
										buttons: [ { text:"Tiếp tục mua hàng", handler:handleYes, isDefault:true },
											{ text:"Xem giỏ hàng",  handler:handleNo } ]
									} );
	YAHOO.example.container.simpledialog1.setHeader("Chọn mua thành công");
	
	// Render the Dialog
	YAHOO.example.container.simpledialog1.render("recycle-dlg");
	YAHOO.example.container.simpledialog1.show();
}

YAHOO.util.Event.addListener(window, "load", init);
{/literal}
</script>
<div id="recycle-dlg"></div>
