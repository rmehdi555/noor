/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	 config.language = 'fa';
	// config.uiColor = '#AADC6E';

    config.filebrowserBrowseUrl= '/ckfinder/browser';
        // Use named CKFinder connector route
    config.filebrowserUploadUrl= '/ckfinder/connector?command=QuickUpload&type=Files';
    config.filebrowserWindowWidth= '1000';
    config.filebrowserWindowHeight= '700';
};
