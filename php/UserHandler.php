<?php
require 'Database.php';

class UserHandler
{

    public function addUser($fn,$ln)
    {
        $db = new Database();
        $db->executeSql('USE '. getenv('DATABASE_NAME'));
        $db->executeSql("INSERT INTO `user` (`name`, `lastname`) VALUES ('$fn','$ln');");

    }
    public function addArticle($id,$label,$text)
    {
        $db = new Database();
        $db->executeSql('USE '. getenv('DATABASE_NAME'));
        $db->executeSql("INSERT INTO `article` (`userId`, `label`, `text`) VALUES ('$id', '$label', '$text');");

    }

    public function returnUsers()
    {
        $db = new Database();
        $db->executeSql('USE '. getenv('DATABASE_NAME'));
        $users = $db->executeSql("SELECT * FROM `user`");

        $rows = array();
        while($result = mysqli_fetch_assoc($users)) {
            $rows[] = $result;
        }

        print_r(json_encode($rows));

        return json_encode($rows);
    }

    public function returnArticlesById($id)
    {
        $db = new Database();
        $db->executeSql('USE '. getenv('DATABASE_NAME'));
        $articles = $db->executeSql("SELECT id,label,text FROM `article` WHERE `userId`='$id'");

        $rows = array();
        while($result = mysqli_fetch_assoc($articles)) {
            $rows[] = $result;
        }

        print_r(json_encode($rows));

        return json_encode($rows);
    }

}