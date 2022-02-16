<?php 

require_once 'header.php';
require_once 'connect.php';

require_once 'libs/lib_main0.php';
require_once 'models/user.php';


    $id = $_GET['id'] ?? 0;
    if( $id == 0 )
    {
        Error("User id not specified. Usage: <code>chg_password.php?id=&lt;user_id&gt;</code>");
    }
    else
    {
    $user = User::Get_User( $id );
    $id = $user['id'];
    $username = $user['username'];
    $h_password = $user['password'];
?>
    <h2>Change password for user <?= $username ?></h2>
    <form action="save_password.php?id=<?= $id ?>" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" id="h_password" name="h_password" value="<?= $h_password ?>">
        <label for="old_password">Old password:</label>
        <input type="old_password" id="old_password" name="old_password" value="" required><br>
        <label for="password">New password:</label>
        <input type="password" id="password" name="password" value="" required><br>

        <br><label></label><button>Change password</button><br>
    </form>
<?php
    }    

 //include('status.php')
 require_once 'footer.php';