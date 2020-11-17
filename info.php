<?php
$con=ocilogon("tracer","p0ln35tcrt","localhost/orcl");
if ($con) echo "sukses";
else echo "gagal";
phpinfo();
?>