CREATE TABLE `gpg_keys` (
  `tenant` int(11) NOT NULL DEFAULT '1',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privkey` text NOT NULL,
  `pubkey` text NOT NULL,
  `passphrase` text NOT NULL,
  `active` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `last_editor` int(11) NOT NULL,
  `create_time` bigint(20) NOT NULL,
  `modify_time` bigint(20) NOT NULL,
  PRIMARY KEY (`tenant`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8