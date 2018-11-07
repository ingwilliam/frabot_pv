<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=".$_POST['name'].".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo "
    <html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">
    <html>
        <head><meta http-equiv=\"Content-type\" content=\"text/html;charset=utf-8\" /></head>
        <body>
";
echo $_POST['table'];
echo "</body></html>";
?>