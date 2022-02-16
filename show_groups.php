<?php
require_once 'header.php';
require_once 'connect.php';

require_once 'groups_view.php';
	
Groups_View::Show_Groups();
Groups_View::Show_Users_Link();
//Groups_View::Add_New_Group_Link(); 

require_once 'footer.php';
