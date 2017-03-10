<?php
/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 3/10/2017
 * Time: 9:28 AM
 */


function conn()
{
    $pdo = null;

    try{
        $pdo = new PDO('mysql:host=localhost; dbname=dohdtr','root','');
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch (PDOException $err) {
        $err->getMessage() . "<br/>";
        die();
    }
    return $pdo;
}

function userlist($date_from,$date_to)
{
    $pdo = conn();
    try {
        $st = $pdo->prepare("SELECT DISTINCT u.userid,u.fname,u.lname,u.mname FROM dtr_file d INNER JOIN users u ON u.userid = d.userid  WHERE u.usertype != '1' AND d.datein BETWEEN '".$date_from ."' AND '".$date_to ."' ORDER BY u.userid ASC");
        $st->execute();
        $row = $st->fetchAll(PDO::FETCH_ASSOC);
        if(isset($row) and count($row) > 0)
        {
            $pdo = null;
            return $row;
        }
    }catch(PDOException $ex)
    {
        echo $ex->getMessage();
        exit();
    }
}

function get_logs($userid, $date_from,$date_to)
{

}
