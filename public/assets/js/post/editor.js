const editor = SUNEDITOR.create((document.getElementById('sample') || 'sample'), {
    lang: SUNEDITOR_LANG['ru'],
    buttonList: [
        ['fontSize', 'formatBlock'],
        ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
        ['fontColor', 'hiliteColor'],
        ['removeFormat'],
        ['fullScreen'],
    ],
    height: "300px",
    width: "100%",
});