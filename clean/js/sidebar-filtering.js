var device = '';
var utm = '';
jQuery("#widget-sidebar-manage-device").on('change',function(){
	if (jQuery(this).val()!="")
		device = '.sidebar-'+jQuery(this).val();
	else
		device = '';
	toggleSidebars();
});

jQuery("#widget-sidebar-manage-utm").on('change',function(){
	if (jQuery(this).val()!="")
		utm = '.'+jQuery(this).val();
	else
		utm = '';
	toggleSidebars();	
});

function toggleSidebars() {
	jQuery("#widgets-right").find(".widgets-holder-wrap").hide();
	if (device == "" && utm == "") {
		jQuery("#widgets-right").find(".widgets-holder-wrap").show();
	}else{
		jQuery(device+utm).show();
	}
}