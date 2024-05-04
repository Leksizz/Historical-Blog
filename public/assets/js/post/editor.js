const editor = SUNEDITOR.create((document.getElementById('sample') || 'sample'), {
    lang: SUNEDITOR_LANG['ru'],
    buttonList: [
        ['fontSize', 'formatBlock'],
        ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
        ['fontColor', 'hiliteColor'],
        ['removeFormat'],
        ['fullScreen'],
        /** ['dir', 'dir_ltr', 'dir_rtl'] */ // "dir": Toggle text direction, "dir_ltr": Right to Left, "dir_rtl": Left to Right
    ],
    height: "300px",
    width: "100%",
});