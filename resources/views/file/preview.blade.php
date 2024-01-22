<!-- resources/views/preview.blade.php -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.min.css" integrity="sha384-uBo1MqRiHwY+pAzqS0qj+ciFoLtiXbTp43X4wv5DE9a02Rv+ZObO69mWT+3I5gxA" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.min.js" integrity="sha384-iFJNlVt5gAqz5up5jefF4P/9jO9Q3c6ikXMTWiYp9HQOGmGSI6xqWi0CKvN5DN1P" crossorigin="anonymous"></script>

 @if($mimeType == 'image/png' || $mimeType == 'image/jpeg' || $mimeType == 'image/jpg')
     {{-- <iframe src="https://view.officeapps.live.com/op/view.aspx?src={{preview_link($preview_link)}}" frameborder="0" style="width:100%;min-height:640px;"></iframe> --}}
   <img src="{{$preview_link}}"/>
 @elseif($mimeType == 'application/pdf')
   {{-- <iframe src="{{'https://docs.google.com/viewer?url=**'.$preview_link}}" frameborder="0" style="width:100%;min-height:640px;"></iframe> --}}
   <embed src= {{ $preview_link }} width= "500" height= "375" type="application/pdf">
 @elseif(true)
   <iframe src="https://view.officeapps.live.com/op/view.aspx?src={{preview_linkendoe($preview_link)}}" frameborder="0" style="width:100%;min-height:640px;"></iframe>
 @endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var viewer = new Viewer(document.getElementById('file-preview'));
    });
</script>
