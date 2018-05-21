<?php require_once $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
?>
<?php
	$id = $_POST['aid'];
	$hoten = $_POST['ahoten'];
	$email = $_POST['aemail'];
	$content = $_POST['acontent'];
    $content = str_replace("<", " < ", $content);
    $date = date('Y').'-'.date('m').'-'.date('d').' '.date('H').':'.date('i').':'.date('s');
    $hour = date('H').':'.date('i').":".date('s');
    $day = date('d').'-'.date('m')."-".date('Y');
    $DB->create('comment', [
        'recruitment_id' => $id,
        'username' => $hoten,
        'email' => $email,
        'content' => $content,
        'created_at' => $date,
    ]);
    
    echo "<li class='li-list-cmt'>";
    echo "<h4>{$hoten}</h4>";
    echo "<div  class='detail-cmt'>";
    echo "<span>{$hour}</span> | <span>{$day}</span> | <span>{$email}</span>";
    echo "</div>";                
    echo "<p>{$content}</p>";
    echo "</li>";
?>
