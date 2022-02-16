<?php 

require_once 'header.php';
require_once 'connect.php';

require_once 'libs/lib_main0.php';
require_once 'models/user.php';
require_once 'models/group.php';

    $id = $_GET['id'] ?? 0; // user id
    if( $id == 0 )
    {
        Error( "User id not specified. Usage: <code>edit_user_groups.php?id=&lt;user_id&gt;</code>");
    }
    else
    {
        $username = User::Get_Username( $id );
        if( is_null( $username ))
        {
            Error( "There is no user with id = $id");
        }
        else
        {
    ?>

    <h2>Edit groups for user <span class="sel"><?= $username ?></span></h2>
    <form action="save_user_groups.php?id=<?= $id ?>" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
    <?php

    $group_names= Group::Get_Group_Names();
    $user_group_ids = Group::Get_User_Group_Ids($id);
    //my_dump($group_names, 'group_names');
    //my_dump($user_group_ids, 'user_group_ids');

        // display chechboxes for each group
        // checked when user with id = $id belongs to this group
    foreach( $group_names as $group_id => $group_name)
    {
        $checked = in_array( $group_id, $user_group_ids ) ? 'checked' : '';
    ?>
        <input type="checkbox" id="gr_<?= $group_id ?>" name="<?= $group_id ?>" <?= $checked ?>>
        <label class="for_checkbox" for="gr_<?= $group_id ?>"><?= $group_name ?></label><br>
    <?php
    }
    ?>
        <br><button class="checkbox_submit">Update groups for user <?= $username ?></button><br>
    </form>
 
<?php    
    }
}
 //include'status.php';
 require_once 'footer.php';