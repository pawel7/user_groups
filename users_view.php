<?php

require_once 'models/user.php';

class Users_View {

public static function Add_New_User_Link()
{
	?>
	<p class="center"><a href="edit_user.php?new">Add a user</a></p>
	<?php
}

public static function Show_Groups_Link( $class = "center" )
{
    ?>
    <p class="<?= $class ?>"><a href="show_groups.php">Show groups</a></p>
    <?php
}

public static function Show_Users_Link( $class = "center" )
{
    ?>
    <p class="<?= $class ?>"><a href="show_users.php">Show users</a></p>
    <?php
}
 
public static function Show_Links( $class = "center" )
{
    Users_View::Show_Groups_Link( $class );
    Users_View::Show_Users_Link( $class );
}

// returns number of users
public static function Show_Users()
{
    $users = User::Get_All_Users();
    if ( empty( $users ))
    { 
    ?>
        <h2 class="center">There are no users</h2>
    <?php   
		Users_View::Add_New_User_Link();   
		return; 
    } 
    else
    {
    ?>
 <h2 class="center">Users list</h2>
 <table class="table table-success table-striped">
 <thead>
     <tr>
        <th>Id</th><th>User name</th>
        <th>Password <span id="toggle_pwd">hide</span</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Date of birth</th>
        <th>Groups</th>
        <th>User action</th>
        <th>Group action</th>
      </tr>
 </thead>
 <tbody>
    <?php
    foreach( $users as $user )
    {
        $id = $user['id'];
        $username = $user['username'];
        $password = $user['password'];
        $firstname = $user['firstname'];
        $lastname = $user['lastname'];
        $born_at = $user['born_at'];
        $group_names = str_replace(',', ', ', $user['group_names'] );
        
        //$group_ids = str_replace(',', ', ', $user['group_ids'] );
    ?>
      <tr>
        <td><?= $id ?></td>
        <td><?= $username ?></td><td><span class="passwd"><?= $password ?></span></td><td><?= $firstname ?></td>
        <td><?= $lastname ?></td><td><?= $born_at ?> </td><td><?= $group_names ?></td>
        <td class="center">
        <a href="edit_user.php?id=<?= $id ?>"><i class="bi bi-pencil"></i></a>
    </td>
        <td class="center">
        <a href="edit_user_groups.php?id=<?= $id ?>"><i class="bi bi-pencil"></i></a>
        
         <!--a href="#editUserModal" class="edit" data-toggle="modal">
			<i class="material-icons update" data-toggle="tooltip" 
			data-id="<?= $id ?>"
			data-username="<?= $username ?>"
			data-password="<?= $password ?>"
			data-firstname="<?= $firstname ?>"
			data-lastname="<?= $lastname ?>"
			data-born_at="<?= $born_at ?>"
			title="Edit"></i>
		 </a>
		 <a href="#deleteUserModal" class="delete" data-id="<?= $id ?>" data-toggle="modal">
            <i class="material-icons" data-toggle="tooltip" 
			   title="Delete"></i>
         </a-->
        </td>
        </tr>
        <?php
    } //  foreach( $users as $user )
    ?>
     </tbody></table>
    <?php 
	Users_View::Add_New_User_Link(); 
	Users_View::Show_Groups_Link();

    }   // end of else - not empty($users)
} // public static function Show_Users()
}