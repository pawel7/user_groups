<?php

require_once 'models/group.php';

class Groups_View {   

public static function Add_New_Group_Link( $class = "center" )
{
    ?>
    <p class="<?= $class ?>"><a href="edit_group.php?new">Add a group</a></p>
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
    Groups_View::Show_Groups_Link( $class );
    Groups_View::Show_Users_Link( $class );
}

public static function Show_Groups()
{
    $groups = Group::Get_All_Groups();
    if ( empty( $groups ))
    { 
    ?>
        <h2 class="center">There are no groups<h2>
    <?php
		Groups_View::Add_New_Group_Link();
    } 
    else
    {
    ?>
 <h2 class="center">Group list</h2>
 <table class="table table-success table-striped">
 <thead>
     <tr>
        <th>Id</th><th>Group name</th>
        <th>Group users</th>
        <th>Edit group</th>
        <th>Edit group users</th>
      </tr>
 </thead>
 <tbody>
    <?php
    foreach( $groups as $group )
    {
        $id = $group['id'];
        $name = $group['name'];
      
        $user_names = str_replace(',', ', ', $group['user_names'] );
    ?>
      <tr>
        <td><?= $id ?></td>
        <td><?= $name ?></td><td><?= $user_names ?></td>
        <td class="center"><a href="edit_group.php?id=<?= $id ?>"><i class="bi bi-pencil"></i></a></td>
        <td class="center"><a href="edit_group_users.php?group_id=<?= $id ?>"><i class="bi bi-pencil"></i></a></td>
        </tr>
        <?php
    } //  foreach( $groups as $group )
    ?>
     </tbody></table>
    <?php 
    Groups_View::Add_New_Group_Link();
    }   // end of else - not empty($groups)
} // public static function Show_Groups()
}