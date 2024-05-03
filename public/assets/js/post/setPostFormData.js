let formData = new FormData(this);
if (document.getElementById('sample').value) {
    formData.append('content', document.getElementById('sample').value);
}