<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Written and Designed by James Hunt
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################

if (!defined('EXPONENT')) exit('');

return array(
	'id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID,
		DB_PRIMARY=>true,
		DB_INCREMENT=>true),
	'location_data'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>200,
        	DB_INDEX=>10),
	'allow_comments'=>array(
		DB_FIELD_TYPE=>DB_DEF_BOOLEAN),
	'comments_notify'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>200),
	'items_per_page'=>array(
		DB_FIELD_TYPE=>DB_DEF_INTEGER),
    	'enable_rss'=>array(
        	DB_FIELD_TYPE=>DB_DEF_BOOLEAN),
	'feed_title'=>array(
        	DB_FIELD_TYPE=>DB_DEF_STRING,
	        DB_FIELD_LEN=>75),
	'feed_desc'=>array(
		DB_FIELD_TYPE=>DB_DEF_INTEGER,
	        DB_FIELD_LEN=>200),
	'aggregate'=>array(
                DB_FIELD_TYPE=>DB_DEF_STRING,
                DB_FIELD_LEN=>1000),
);

?>
