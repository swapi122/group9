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

if (!defined('EXPONENT_VERSION_MAJOR')) {
	/* exdoc
	 * If this constant is set to a true value (1 is the prefered value), then
	 * the system will behave slightly differently, to accomodate for developers
	 * and their environment.
	 */
	define('DEVELOPMENT',1); // CHANGE FOR DIST
	/* exdoc
	 * This is the major version number of Exponent; the 0 in 0.96.2-beta3
	 */
	define('EXPONENT_VERSION_MAJOR','0');
	/* exdoc
	 * This is the minor version number of Exponent; the 96 in 0.96.2-beta3
	 */
	define('EXPONENT_VERSION_MINOR','97');
	/* exdoc
	 * This is the revision version number of Exponent; the 2 in 0.96.2-beta3
	 */
	define('EXPONENT_VERSION_REVISION','0');
	/* exdoc
	 * This is the date that this version of Exponent was exported from CVS and built.
	 */
	define('EXPONENT_VERSION_BUILDDATE','1205538169');
	/* exdoc
	 * This specifies the type of release, either 'alpha','beta','rc' or '' (for stable).
	 */
	define('EXPONENT_VERSION_TYPE','Alpha');
	/* exdoc
	 * This number is bumped each time a distribution of a single version is
	 * released.  For instance, the 3rd beta has an version type iteration of 3.
	 */
	define('EXPONENT_VERSION_ITERATION','-20080314'); // only applies to betas/alphas / rcs
}

//return '0.96'; uncomment this when full deprecation of exponent is complete

?>
