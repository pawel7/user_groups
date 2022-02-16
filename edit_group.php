<?php 

require_once 'header.php';
require_once 'connect.php';

require_once 'libs/lib_main0.php';
require_once 'models/group.php';

$is_new = isset( $_GET['new'] );
$action = $is_new ? "add" : "edit";
$title = $is_new ? "Add a group" : "Edit a group";

if( $is_new )
{
    ?>
    <h2><?= $title ?></h2>
    <form action="save_group.php?new" method="POST">
        <input type="hidden" name="action" value="<?= $action ?>">
        <label for="groupname">Group name:</label>
        <input type="text" id="name" name="name" required><br>
      
        <br><label></label><button  id="add" name="add">Add group</button>
         <button id="cancel" name="cancel">Cancel</button>
     
    </form>
<?php 
}
else
{
    $id = $_GET['id'] ?? 0;
    if( $id == 0 )
    {
        Error("Group id not specified. Usage: <code>edit_group.php?id=&lt;group_id&gt;</code> or <code>edit_group.php?new</code>");
    }
    else
    {
    $group = Group::Get_Group( $id );
    if( is_null( $group ))
    {
        Error("There is no group with id = $id");
        
        $previous = "javascript:history.go(-1)";
        if(isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
        }
        echo "<a href=\"$previous\">Back</a>";
    }
    else
    {
    $id = $group['id'];
    $name = $group['name'];
    $group_user_ids = Group::Get_User_Ids($id);
        // disable delete button when the group has users
    $delete_button_disabled = !empty( $group_user_ids) ? 'disabled' : ''; 
    
?>
    <h2><?= $title ?></h2>
    <form action="save_group.php?id=<?= $id ?>" method="POST">
        <input type="hidden" name="action" value="<?= $action ?>">
        <input type="hidden" name="id" value="<?= $id ?>"> 
        <label for="name">Group name:</label>
        <input type="text" id="name" name="name" class="long" value="<?= $name ?>" required><br>
                   
        <br><label></label><button  id="update" name="update">Update group</button>
         <button  id="cancel" name="cancel">Cancel</button>
         <button class="danger" id="delete" name="delete" <?= $delete_button_disabled ?> onclick="return confirm('Are you sure you want to delete this group?')">Delete group</button><br>
    </form>
<?php
    }
    }  
}
 //include('status.php')
 require_once 'footer.php';