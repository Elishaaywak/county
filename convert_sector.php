<?php
// Set parameters


$apikey = '40be30cf-aa51-4a66-b3ae-6f043902ecbe';
$value = "http://www.prisconet.com/apps/county/spdf2.php?sectorid=$_GET[sectorid]"; // can aso be a url, starting with http..
 
// Convert the HTML string to a PDF using those parameters.  Note if you have a very long HTML string use POST rather than get.  See example #5
$result = file_get_contents("http://api.html2pdfrocket.com/pdf?apikey=" . urlencode($apikey) . "&value=" . urlencode($value));
 
// Output headers so that the file is downloaded rather than displayed
// Remember that header() must be called before any actual output is sent
header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . strlen($result));
 
// Make the file a downloadable attachment - comment this out to show it directly inside the 
// web browser.  Note that you can give the file any name you want, e.g. alias-name.pdf below:
header('Content-Disposition: attachment; filename=' . 'Download.pdf' );
 
// Stream PDF to user
echo $result;
?>