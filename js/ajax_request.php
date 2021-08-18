<?php
include_once('../db.php');
if (isset($_GET['q']) ) {
$db = new database();
$username 	= 'umi777';
$tblname = 'phonebook';

					$list = $db->listContact($tblname);
					foreach ($list as $arr) {
						//echo("$arr[name] $arr[phone] \n");
						echo '<div class="contact">';
						echo '<span class="name">'.($arr[name]).'</span>';
						echo '<span class="del" onclick="ajaxRequest('.$arr[ID].')">x</span>';
						echo '<br>';
						echo '<span class="phone">'.$arr[phone].'</span>';
						echo '</div>';
						}
}
if (isset($_GET['id'])) {
include_once('../db.php');
$db = new database();
$username 	= 'umi777';
$tblname = 'phonebook';
echo '</div><div class="footer">Контакт ';
$foot = $db->delContact($tblname ,$_GET['id']);
//echo ($db->delContact($tblname ,$_GET['id']));
echo ($foot[0]['name']);
echo " был удален.</div></div>";
}

?>