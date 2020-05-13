/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

   config.filebrowserBrowseUrl = 'http://localhost/call/public/assets/dist/js/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = 'http://localhost/call/public/assets/dist/js/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = 'http://localhost/call/public/assets/dist/js/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = 'http://localhost/call/public/assets/dist/js/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = 'http://localhost/call/public/assets/dist/js/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = 'http://localhost/call/public/assets/dist/js/kcfinder/upload.php?opener=ckeditor&type=flash';

   
   
    config.toolbar = 'Cms';
    config.toolbar_Cms =
    [
        [ 'Source','-','DocProps','Preview','Print','-','Templates' ],
        [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ],
        [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ],
		[ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
        'HiddenField' ],
        '/',
        [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ],
        [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ],
        [ 'Link','Unlink','Anchor' ],
        [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ],
        [ 'Styles','Format','Font','FontSize' ],
        '/',
        [ 'TextColor','BGColor' ],
       [ 'Maximize', 'ShowBlocks','-','About' ]
    ];
   
};

