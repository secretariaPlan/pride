if(! ('ace' in window) ) window['ace'] = {}
jQuery(function() {
	//at some places we try to use 'tap' event instead of 'click' if jquery mobile plugin is available
	window['ace'].click_event = $.fn.tap ? "tap" : "click";
});

(function($ , undefined) {
	var multiplible = 'multiple' in document.createElement('INPUT');
	var hasFileList = 'FileList' in window;//file list enabled in modern browsers
	var hasFileReader = 'FileReader' in window;

	var Ace_File_Input = function(element , settings) {
		var self = this;
		this.settings = $.extend({}, $.fn.ace_file_input.defaults, settings);

		this.$element = $(element);
		this.element = element;
		this.disabled = false;
		this.can_reset = true;

		this.$element.on('change.ace_inner_call', function(e , ace_inner_call){
			if(ace_inner_call === true) return;//this change event is called from above drop event
			return handle_on_change.call(self);
		});
		
		this.$element.wrap('<div class="ace-file-input" />');
		
		this.apply_settings();
	}
	Ace_File_Input.error = {
		'FILE_LOAD_FAILED' : 1,
		'IMAGE_LOAD_FAILED' : 2,
		'THUMBNAIL_FAILED' : 3
	};


	Ace_File_Input.prototype.apply_settings = function() {
		var self = this;
		var remove_btn = !!this.settings.icon_remove;

		this.multi = this.$element.attr('multiple') && multiplible;
		this.well_style = this.settings.style == 'well';

		if(this.well_style) this.$element.parent().addClass(