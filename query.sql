DELETE FROM `wp_users` WHERE ID != 1; 

DELETE FROM `wp_usermeta` WHERE user_id != 1; 


DELETE FROM `wp_postmeta` WHERE post_id IN (SELECT ID FROM `wp_posts` where post_author != 1); 
DELETE FROM `wp_posts` WHERE post_author != 1; 