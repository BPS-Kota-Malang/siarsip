<!-- resources/views/preview.blade.php -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.min.css" integrity="sha384-uBo1MqRiHwY+pAzqS0qj+ciFoLtiXbTp43X4wv5DE9a02Rv+ZObO69mWT+3I5gxA" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.min.js" integrity="sha384-iFJNlVt5gAqz5up5jefF4P/9jO9Q3c6ikXMTWiYp9HQOGmGSI6xqWi0CKvN5DN1P" crossorigin="anonymous"></script>

<div id="file-preview">
    <img src="{{ url($filePath) }}" alt="Preview">
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var viewer = new Viewer(document.getElementById('file-preview'));
    });
</script>