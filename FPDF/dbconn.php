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

function get_logs($datein,$id)
{

    $pdo = conn();
    $query = "SELECT * FROM work_sched WHERE id = '1'";
    $st = $pdo->prepare($query);
    $st->execute();
    $sched = $st->fetchAll(PDO::FETCH_ASSOC);

    $am_in = explode(':',$sched[0]['am_in']);
    $am_out =  explode(':',$sched[0]['am_out']);
    $pm_in =  explode(':',$sched[0]['pm_in']);
    $pm_out = explode(':',$sched[0]['pm_out']);


    $query = "SELECT DISTINCT t.userid,
                      (SELECT MIN(t1.time) FROM dtr_file t1 WHERE t1.userid = '". $id ."' and t1.datein = '". $datein ."' and t1.time_h < ". $am_out[0] .") as am_in,
                      (SELECT MAX(t2.time) FROM dtr_file t2 WHERE t2.userid = '". $id ."' and t2.datein = '". $datein ."' and t2.time_h < ". $pm_in[0]." AND t2.event = 'OUT') as am_out,
                      (SELECT MIN(t3.time) FROM dtr_file t3 WHERE t3.userid = '". $id ."' AND t3.datein = '". $datein ."' and t3.time_h >= ". $am_out[0]." and t3.time_h < ". $pm_out[0]." AND t3.event = 'IN' ) as pm_in,
                      (SELECT MAX(t4.time) FROM dtr_file t4 WHERE t4.userid = '". $id ."' AND t4.datein = '". $datein ."' and t4.time_h > ". $pm_in[0] ." and t4. time_h < 24) as pm_out
                FROM dtr_file t
                WHERE t.userid = '".$id."'";

    $st = $pdo->prepare($query);
    $st->execute();
    $row = $st->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
