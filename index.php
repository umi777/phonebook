<?php

include_once(__DIR__ . '/db.php');
$db = new database();
$username = 'umi777';
$tblname = 'phonebook';

if (isset($_POST["delete"])) {
    echo "Был удален ";
    ($db->delContact($tblname, $_POST["delete"]));
    echo " контакт";
}

?>
	
<!DOCTYPE html>
<html dir="ltr" lang="ru" class="smallTop">
<head>

	<title>Телефонная книга</title>
	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css?v=1.020" />
	<script type="text/javascript" src="js/js.js"></script>
	<script type="text/javascript" src="js/js-inputmask.js"></script>
</head>
<body>
	<div class="wrapper">
		<div>
	<div class="" id="form_add">
		<div class="header" id="">
			<h1>Добавить контакт</h1>
		</div>
		<form id="add_phone" name="myform" action="" method="post">
		<fieldset>
				<div class="name" id="name">
					<input placeholder="Имя" type="text" name="name" value="<?=($_POST["name"]?? false)?>" required />
				</div>
				<div class="phone" id="phone">
					<input placeholder="+7-987-654-32-10" type="phone" name="phone" pattern="\+7 \([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}" class="tel" value="<?=($_POST["phone"]?? false)?>" required />
				</div>
				<div class="submit" id="submit">
					<input type="submit" name="add_phone" value="Добавить" />
					
				</div>
		</fieldset>
	</form>
	</div>
	<div class="" id="form_contact">
		<div class="header" id="">
			<h1>Список контактов</h1>
		</div>
		<div class="" id="list_contact">
			<!--<form action="" method="post"> -->
				<script>ajaxRequest("list")</script>

			<!--</form>-->
		</div>
		<div id="list_footer"></div>
	</div>
	</div>
	</div>
</body>
</html>
<?php
if (isset($_POST["add_phone"])) {
    echo($db->addContact($tblname, $_POST));
    //echo ("<script>ajaxRequest('list');</script>");
}
?>