# Simple user and user group management in bare PHP

## Project requirements:

Back-end: `PHP7` + using the MVC principle but without using additional frameworks.  
Front-end: Use of `jQuery` is welcome.  
Database: `Mysql` or `Mariadb`.  

### Functionalities:
 
#### 1. User management:  
 
a. List of users  
b. Add a user  
c. Remove a user  
d. Edit a user  
 
#### 2. User groups management:  
 
a. List of groups   
b. Add a group  
c. Remove a group  
d. Edit a group  

### Data structure
 
#### User:  

a. Username  
b. Password  
c. First name  
d. Last name  
e. Date of birth  
f. List of all groups the user belongs to  

#### User group

a. Name of group  
b. List of users who belong to the group  
 
The application should allow you to edit all of the above properties, including lists.


## Description of the solution

User list: `show_users.php`.  
group list: `show_groups.php`.  

All editing actions are done in these files.  
The models are in the `models` folder and the views are `users_view.php` and `groups_view.php`.  

You can add or remove users, as well as groups add and remove users to / from a group, and add and remove groups for a given user.  

A group cannot be deleted when it has users.   
The `Delete group` button is then disabled.  

However, you can remove a user, even though he is in some groups.  
The user will be removed from them, thanks to the *cascade* mechanism.  

```sql
ALTER TABLE `user_groups` ADD  FOREIGN KEY (`user_id`) 
REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
```

`JQuery` is only used to remove the `Required` attribute when pressing `Delete` and `Cancel` and to change the display of a group list and to hide the password column.

## To do 

Use bootstrap and modal dialogues to edit and delete groups and users.   
It is also worth changing the functions to handle database - use parametrised prepared statements to protect against SQL injection.  
