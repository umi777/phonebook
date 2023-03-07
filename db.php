<?php

class database
{
    private $host 		= 'mysql.zzz.com.ua';
    private $dbname 	= 'umi9956';
    private $username 	= 'umi777';
    private $password 	= '000000Az';
    private $charset 	= 'utf8';
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = @new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->password);
    }


    public function Connect($user)
    {
        // Type your code here
        $mysqli = @new mysqli($this->host, $user, $this->password, $this->dbname);
        if ($mysqli->connect_errno) {
            return "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        } else {
            return  $mysqli;
        }
    }

    public function CheckTable($TableName)
    {
        $dbh = $this->mysqli;
        //echo $TableName."<br>";
        $sql = $dbh->prepare('SHOW TABLES LIKE ?');
        $sql->execute(array($TableName));
        $res = $sql->fetchAll();
        //var_dump($res);echo "-res<br>";
        return ($res ?? false);
    }

    public function CreateTable($dbname, $TableName)
    {
        $dbh = $this->mysqli;
        echo $TableName;
        $res = $dbh->query("CREATE TABLE $dbname.$TableName ( `ID` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `phone` VARCHAR(25) NOT NULL , PRIMARY KEY (`ID`), INDEX `name` (`name`)) ENGINE = MyISAM CHARSET=$this->charset COLLATE utf8_general_ci;");
        var_dump($res);
        return ($res);
    }
    public function addContact($tblname, $post)
    {
        $dbh = $this->mysqli;
        //echo $tblname."<br>";
        //print_r ($post);
        if ($this->CheckTable($tblname)) {
            $sql  = $dbh->prepare("INSERT INTO $tblname (name,phone) VALUES (?,?)");

            if ($sql->execute(array(htmlspecialchars($post['name']), htmlspecialchars($post['phone'])))) {
                return ("<script>document.getElementById(\"list_footer\").innerHTML = \"Добавлен контакт ".$post['name']."\";</script>");
            } else {
                return ("Error updating record: " . $dbh->error);
            }
        } else {
            $this->CreateTable($this->dbname, $tblname);
            $this->addContact($tblname, $post);
        }
    }

    public function delContact($tblname, $id)
    {
        $dbh = $this->mysqli;
        $sql = ($dbh->prepare('SELECT `name` FROM '.$tblname.' WHERE '.$tblname.'.`ID` = ?'));
        //echo "<br>";
        //var_dump ($res,$sql,$id);
        //echo "<br>";
        if ($sql->execute(array($id))) {
            $res=$sql->fetchAll(PDO::FETCH_ASSOC);
            $sql = ($dbh->prepare("DELETE FROM $tblname WHERE $tblname.`ID` = ?"));
            $sql->execute(array($id));
            return ($res);
        } else {
            return ($sql->fetchAll());
        }
    }

    public function listContact($tblname)
    {
        if ($this->CheckTable($tblname)) {
            $dbh = $this->mysqli;
            $sql  = $dbh->prepare('SELECT * FROM '.$tblname);
            if ($sql->execute()) {
                while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                    $res[] = ($row);
                    //echo "<br>";
                }
                return($res);
            }/*
            if ($dbh->prepare($sql) === TRUE) {
                return ($dbh->query($sql));
            } else {
                return ("Error updating record: " . $dbh->error);
            }	*/
        } else {
            return ("Таблица ".$tblname." не найдена!");
        }
    }
}
