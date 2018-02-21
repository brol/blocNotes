<?php 
# ***** BEGIN LICENSE BLOCK *****
#
# This file is part of Bloc-Notes.
# Copyright 2008,2009,2010,2011 Moe (http://gniark.net/)
#
# Bloc-Notes is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 3 of the License, or
# (at your option) any later version.
#
# Bloc-Notes is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
# Icons (*.png) are from Tango Icon theme :
#	http://tango.freedesktop.org/Tango_Icon_Gallery
#
# ***** END LICENSE BLOCK *****

if (!defined('DC_RC_PATH')) {return;}

$this->registerModule(
	/* Name */       	'Bloc-Notes',
	/* Description*/ 	'Display notebooks on the backend',
	/* Author */     	'Moe (http://gniark.net/), Pierre Van Glabeke',
	/* Version */    	'1.0.7',
	/* Properties */
	array(
		'permissions' => 'usage,contentadmin',
		'type' => 'plugin',
		'dc_min' => '2.12',
		'support' => 'http://lab.dotclear.org/wiki/plugin/blocNotes',
		'details' => 'http://plugins.dotaddict.org/dc2/details/blocNotes'
		)
);