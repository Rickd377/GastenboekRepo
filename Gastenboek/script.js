document.getElementById('file-upload').addEventListener('change', function () {
    var fileName = this.files[0].name;
    if (fileName.length > 25) {
        fileName = fileName.substring(0, 25) + " ...";
    }
    document.getElementById('file-label').textContent = fileName;
});

window.addEventListener('load', function() {
    var container = document.getElementById('message-container');
    container.scroll = 0;
});