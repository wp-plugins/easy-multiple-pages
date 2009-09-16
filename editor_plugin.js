// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	//tinymce.PluginManager.requireLangPack('easy_multi_pages');
	 
	tinymce.create('tinymce.plugins.easy_multi_pages', {
		
		init : function(ed, url) {
		// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('easy_multi_pages', function() {
				//alert('invoked!');
				ed.execCommand('mceInsertRawHTML', false, '<!--nextpage-->');

			});

			// Register example button
			ed.addButton('easy_multi_pages', {
				title : 'Break page',
				cmd : 'easy_multi_pages',
				image : url + '/empages_img.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('easy_multi_pages', n.nodeName == 'IMG');
			}			);
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
					longname  : 'easy_multi_pages',
					author 	  : 'Nick Remaslinnikov',
					authorurl : 'http://www.homolibere.info',
					infourl   : 'http://www.homolibere.info',
					version   : "0.1 beta"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('easy_multi_pages', tinymce.plugins.easy_multi_pages);
})();


