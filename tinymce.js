function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function insertCCTBcode() {

	var tagtext;
	var langname_ddb = document.getElementById('cctb_lang');
	var langname = langname_ddb.value;
	var linenumbers = document.getElementById('cctb_linenumbers').checked;
	var inst = tinyMCE.getInstanceById('content');
	var html = inst.selection.getContent();
	
	if (linenumbers)
		tagtext = "[cc lang='" + langname + "' ";
	else
		tagtext = "[cc lang='" + langname + "' line_numbers='false'";
	
	window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext+']'+html+'[/cc]');
	tinyMCEPopup.editor.execCommand('mceRepaint');
	tinyMCEPopup.close();
	return;
}
