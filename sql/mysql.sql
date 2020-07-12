CREATE TABLE works_items (
  iid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  title varchar(250) NOT NULL default '',
  description text NOT NULL,
  dateb int(13) NOT NULL default '0',
  datee int(13) NOT NULL default '0',
  client varchar(250) NOT NULL default '',
  url varchar(250) default '',
  image varchar(250) default '',
  featured tinyint(1) NOT NULL default '0',
  uid int(11) default '0',
  PRIMARY KEY  (iid)
) TYPE=MyISAM;

CREATE TABLE works_categories (
  cid int(11) NOT NULL auto_increment,
  title varchar(250) NOT NULL default '',
  description text,
  sort int(11) default '0',
  PRIMARY KEY  (cid)
) TYPE=MyISAM;