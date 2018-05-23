<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/header.php" ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']."/functions/checkuser.php" ?>
	<?php if ($session->has('msgSuccess')) { ?>
        <div class="alert-message success">
            <?php echo $session->get('msgSuccess'); ?>
            <?php $session->remove('msgSuccess'); ?>
        </div>
    <?php } ?>
    <?php if ($session->has('msgError')) { ?>
        <div class="alert-message error">
            <?php echo $session->get('msgError'); ?>
            <?php $session->remove('msgError'); ?>
        </div>
    <?php } ?>
    <!--content-->
	<div class="content">
        <div class="header-content">
            <a class="add" href="add.php"><i class="fa fa-plus" aria-hidden="true"></i> Thêm</a>
            <a class="delete-all" href="" id="delete-all-users"><i class="fa fa-trash" aria-hidden="true"></i> Xóa tất cả</a>
            <input type="text" name="search" class="search-box" id="search-users" placeholder="Nhập nội dung tìm kiếm...">
        </div>
        <table class="tb-admin" width="100%">
            <tr>
                <th width="5%">
                    <input type="checkbox" class="checkbox-delete-all">
                </th>
                <th width="10%">STT</th>
                <th width="25%">Username</th>
                <th width="20%">Email</th>
                <th width="20%">Avatar</th>
                <th width="20%">Chức năng</th>
            </tr>
            <tbody id="show-users">
                <?php
                    $resultUser = $DB->select("SELECT * FROM users");

                    foreach ($resultUser as $key => $user) {
                        if (empty($user['avatar'])) {
                            $user['avatar'] = 'avatarmacdinh.png';
                        }
                ?>
                    <tr>
                        <td>
                            <?php if ($user['active'] == 0) { ?>
                                <input type="checkbox" class="checkbox-delete"  val="<?php echo $user['id'] ?>" >
                            <?php } ?>
                        </td>
                        <td><?php echo '#' + ($key + 1); ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><img style="height: 50px;" src="/files/<?php echo $user['avatar'] ?>" class="hoa" /></td>
                        <td>
                            <?php if ($user['active'] == 0) { ?>
                				<a href="del.php?idUser=<?php echo $user['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng ?');" class="fa fa-trash">Xóa</a>
                            <?php } else { ?>
                                <span class="label-role">Admin</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!--end content-->
<?php require_once $_SERVER['DOCUMENT_ROOT']."/templates/admin/inc/footer.php"?>