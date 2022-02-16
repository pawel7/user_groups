<?php 

require_once 'header.php';
require_once 'connect.php';

require_once 'libs/lib_main0.php';
require_once 'models/user.php';
require_once 'models/group.php';

    $group_id = $_GET['group_id'] ?? 0;
    if( $group_id == 0 )
    {
        Error( "Group id not specified. Usage: <code>edit_group_users.php?group_id=&lt;group_id&gt;</code>");
        require_once 'footer.php';
        die();
    }
    else
    {
        $groupname = Group::Get_Group_Name( $group_id );
        if( is_null( $groupname ))
        {
            Error( "There is no group with id = $group_id");
            require_once 'footer.php';
            die();
        }
    }

    ?>

    <h2>Edit users for group <span class="sel"><?= $groupname ?></span></h2>
    <form action="save_group_users.php?group_id=<?= $group_id ?>" method="POST">
        <input type="hidden" name="group_id" value="<?= $group_id ?>">
    <?php

    $user_infos = User::Get_User_Infos();
    $group_user_ids = Group::Get_User_Ids($group_id);
    //my_dump($group_names, 'group_names');
    //my_dump($user_group_ids, 'user_group_ids');

        // display chechboxes for each user
        // checked when the user belongs to group $group_id
    foreach( $user_infos as $id => $user_info)
    {
        $checked = in_array( $id, $group_user_ids ) ? 'checked' : '';
    ?>
        <input type="checkbox" id="usr_<?= $id ?>" name="<?= $id ?>" <?= $checked ?>>
        <label class="for_checkbox" for="usr_<?= $id ?>"> 
        <span class="uinfo"><?= $user_info['username'] ?></span><span class="uinfo"><?= $user_info['realname'] ?></span></label><br>
    <?php
    }
    ?>
        <br><button class="checkbox_submit">Update users for this group</button><br>
    </form>
 
<?php    

 //include'status.php';
 require_once 'footer.php';