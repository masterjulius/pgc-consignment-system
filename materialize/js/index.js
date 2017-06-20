(function($){
	$(function(e){
		system.initialize();
	});
})(jQuery);

var system = {
	initialize: function () {
		this.init_sidebar( '.button-collapse' );
		this.init_select_tag();
	},
	init_sidebar : function(selector) {
		$( selector ).sideNav();
	},
	init_select_tag: function() {
		$('select').material_select();
	}
};