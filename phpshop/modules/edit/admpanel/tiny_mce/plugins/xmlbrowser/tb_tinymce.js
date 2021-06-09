
 function xmlBrowser (field_name, url, type, win) {



   cmsURL = "jscripts/tiny_mce/plugins/xmlbrowser/index.html";



    tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'XML Browser',
        width : 500,
        height : 500,
        resizable : "yes",
		scrollbars : "yes",
        inline : "yes",  // This parameter only has an effect if you use the inlinepopups plugin!
        close_previous : "no"
    }, {
        window : win,
        input : field_name
    });
		


    return false;
  }