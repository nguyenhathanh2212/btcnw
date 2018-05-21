<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
  <!--content-->
  <div class="content">
        <a class="add" href="add.php"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
        <?php
      if(!empty($_GET['msg'])){
        $msg=$_GET['msg'];
        echo $msg;
      }
    ?>
        <table class="tb-admin" width="100%">
          <tr>
            <th width="10%">ID</th>
            <th width="25%">Username</th>
            <th width="20%">Email</th>
            <th width="20%">Avatar</th>
            <?php if($_SESSION['arUser']['id_user']==1){ ?>
            <th width="5%">QTV</th>
            <?php }?>
            <th width="20%">Chức năng</th>
          </tr>
          <?php
        $queryUser= "SELECT * FROM users ";
        $resultUser=$mySQLI->query($queryUser);
        while ($arUser=mysqli_fetch_assoc($resultUser)) {
          $idUser=$arUser['id_user'];
          $username=$arUser['username'];
          $email=$arUser['email'];
          $avatar=$arUser['avatar'];
          $active=$arUser['active'];
        ?>
          <tr>
            <td><?php echo $idUser;?></td>
            <td><?php echo $username;?></td>
            <td><?php echo $email;?></td>
            <td><?php 
        if($avatar==''){ ?>
        <img style="height: 50px;" src="/files/avatarmacdinh.png" class="hoa" />
        <?php }else{ ?>
        <img style="height: 50px;" src="/files/<?php echo $avatar?>" class="hoa" />
        <?php }?>
      </td>
      <?php if($_SESSION['arUser']['id_user']==1){ ?>
            <td><?php 
              $check="";
              if($active==1 ){
                $check="checked";
              }

              if($idUser==1){
                echo "<img src='/templates/public/images/tick.png'>";
              }else{
                echo "<input type='checkbox'{$check} name='active' class='active' value='{$idUser}'/>";
              }
            ?></td>
            <?php }?>
            <td>
                
        |<a href="del.php?idUser=<?php echo $idUser?>" onclick="return confirm('Bạn có chắc chắn muốn xóa user ?');" class="fa fa-trash">Xóa</a>
        <?php }?>
            </td>
          </tr>
          <?php }?>
        </table>
      </div>
  <!--end content-->
  <?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>