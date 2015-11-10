DROP TABLE IF EXISTS `wp_usermeta`;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
LOCK TABLES `wp_usermeta` WRITE;
INSERT INTO `wp_usermeta` VALUES ('1','1','nickname','012_admin'), ('2','1','first_name',''), ('3','1','last_name',''), ('4','1','description',''), ('5','1','rich_editing','true'), ('6','1','comment_shortcuts','false'), ('7','1','admin_color','fresh'), ('8','1','use_ssl','0'), ('9','1','show_admin_bar_front','true'), ('10','1','wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'), ('11','1','wp_user_level','10'), ('12','1','dismissed_wp_pointers',''), ('13','1','show_welcome_panel','1'), ('14','1','session_tokens','a:1:{s:64:\"f6eb36c554c94f7b9cf0bfbd3f9a84d557fcf2efd827145453b499d215341827\";a:4:{s:10:\"expiration\";i:1446290837;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:109:\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.71 Safari/537.36\";s:5:\"login\";i:1445081237;}}'), ('15','1','wp_dashboard_quick_press_last_post_id','3'), ('16','1','managenav-menuscolumnshidden','a:4:{i:0;s:15:\"title-attribute\";i:1;s:11:\"css-classes\";i:2;s:3:\"xfn\";i:3;s:11:\"description\";}'), ('17','1','metaboxhidden_nav-menus','a:4:{i:0;s:9:\"add-space\";i:1;s:9:\"add-event\";i:2;s:12:\"add-post_tag\";i:3;s:15:\"add-post_format\";}'), ('18','1','nav_menu_recently_edited','2'), ('19','1','wp_user-settings','libraryContent=browse&hidetb=1'), ('20','1','wp_user-settings-time','1445112546');
UNLOCK TABLES;
