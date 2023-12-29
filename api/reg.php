<!-- 因為這次用Ajax所以到後台不用header到其他頁面，因為直接在前端做，echo 值給前端就好 -->
<?php
include_once "db.php";
unset($_POST['pw2']);
$User->save($_POST);

?>