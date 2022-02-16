<?php
require_once 'header.php';
require_once 'connect.php';

require_once 'users_view.php';
	
Users_View::Show_Users();
//Users_View::Add_New_User_Link(); 
//Users_View::Show_Groups_Link();

require_once 'footer.php';

