
<html>
<body>
<?php
echo '<H1>PHP hashing functins</H1>' ;
echo '<TABLE>' ;
echo '<TR>' ;
echo '<TH ALIGN=right>Num</TH><TH ALIGN=left>Algo</TH>' ;
echo '</TR>' ;

$hashes = hash_algos() ;
$num = 0 ;
foreach($hashes as $ahash) {
  $num += 1 ;
  echo '<TR>' ;
  echo '<TD ALIGN=right>' . $num . '</TD>' ;
  echo '<TD ALIGN=left>' . $ahash . '</TD>' ;
  echo '</TR>' ;
  #echo $ahash . '<BR>' ;
}
echo '</TABLE>' ;
?>
</body>
</html>