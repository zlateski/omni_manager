SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;

CREATE TABLE `volumes` (
  `id`     bigint(20) NOT NULL,
  `path`   char(255)  character set utf8 NOT NULL,
  `status` bigint(20) NOT NULL,
  PRIMARY KEY  ( `id` )
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `tasks` (
  `id`        bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `volume_id` bigint(20) NOT NULL,
  `seeds`     text NOT NULL,
  `entry`     text NOT NULL,
  `status`    bigint(20) NOT NULL,
  PRIMARY KEY  ( `id` ),
  KEY `parent_id_key` (`parent_id`),
  KEY `volume_id` (`volume_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `validations` (
  `id`        bigint(20) NOT NULL,
  `task_id`   bigint(20) NOT NULL,
  `user_id`   bigint(20) NOT NULL,
  `status`    bigint(20) NOT NULL,
  `segments`  text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `task_id_key` (`task_id`),
  KEY `user_id_key` (`user_id`),
  KEY `status_key`  (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

SET character_set_client = @saved_cs_client;
