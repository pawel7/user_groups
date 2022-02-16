<?php 

require_once 'header.php';
require_once 'connect.php';

require_once 'libs/lib_main0.php';
require_once 'models/user.php';

$is_new = isset( $_GET['new'] );
$action = $is_new ? "add" : "edit";
$title = $is_new ? "Add a user" : "Edit a user";
//$action = $is_new ? "add" : ( $is_del ? "delete" : "edit" );
//$title = $is_new ? "Add a user" : ( $is_del ? "Delete a user" : "Edit a user" );
if( $is_new )
{
    ?>
    <h2><?= $title ?></h2>
    <form action="save_user.php?new" method="POST">
        <input type="hidden" name="action" value="<?= $action ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="firstname">First name:</label>
        <input type="text" id="firstname" name="firstname" required><br>
        <label for="lastname">Last name:</label>
        <input type="text" id="lastname" name="lastname" required><br>
        <label for="born_at">Date of birth:</label>
        <input type="date" id="born_at" name="born_at" required><br>
      
        <br><label></label><button  id="add" name="add">Add user</button>
         <button id="cancel" name="cancel">Cancel</button>
     
    </form>
<?php 
}
else
{
    $id = $_GET['id'] ?? 0;
    if( $id == 0 )
    {
        Error("User id not specified. Usage: <code>edit_user.php?id=&lt;user_id&gt;</code> or <code>edit_user.php?new</code>");
    }
    else
    {
    $user = User::Get_User( $id );
    if( is_null( $user ))
    {
        Error("There is no user with id = $id");
        
        $previous = "javascript:history.go(-1)";
        if(isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
        }
        echo "<a href=\"$previous\">Back</a>";
    }
    else
    {
    $id = $user['id'];
    $username = $user['username'];
    $h_password = $user['password'];
    $firstname = $user['firstname'];
    $lastname = $user['lastname'];
    $born_at = $user['born_at'];
    //!! not used here $group_names = str_replace(',', ', ', $user['group_names'] ); 
?>
    <h2><?= $title ?></h2>
    <form action="save_user.php?id=<?= $id ?>" method="POST">
        <input type="hidden" name="action" value="<?= $action ?>">
        <input type="hidden" name="id" value="<?= $id ?>"> 
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= $username ?>" required><br>
        <!--input type="hidden" id="h_password" name="h_password" value="<?= $h_password ?>">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="" required><br-->
        <label for="firstname">First name:</label>
        <input type="text" id="firstname" name="firstname" value="<?= $firstname ?>" required><br>
        <label for="lastname">Last name:</label>
        <input type="text" id="lastname" name="lastname" value="<?= $lastname ?>" required><br>
        <label for="born_at">Date of birth:</label>
        <input type="date" id="born_at" name="born_at" value="<?= $born_at ?>" required><br>
           
        <br><label></label><button  id="update" name="update">Update user</button>
         <button  id="cancel" name="cancel">Cancel</button>
         <button class="danger" id="delete" name="delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete user</button><br>
    </form>
<?php
    }
    }  
}
 //include('status.php')
 require_once 'footer.php';