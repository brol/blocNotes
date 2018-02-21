<?php
# ***** BEGIN LICENSE BLOCK *****
#
# This file is part of Bloc-Notes.
# Copyright 2008,2010,2011 Moe (http://gniark.net/)
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

class blocNotes
	{
		public static function adminDashboardIcons($core,$icons)
		{
			$icons['blocNotes'] = array(__('Notebook'),
				'plugin.php?p=blocNotes',
				'index.php?pf=blocNotes/icon-big.png');
		}

		public static function form()
		{
			global $core;

			$core->blog->settings->addNameSpace('blocnotes');
			
			$set = $core->blog->settings->blocnotes;
			
			$notes = $core->con->select('SELECT bloc_notes '.
				'FROM '.$core->prefix.'user '.
				'WHERE user_id = \''.
				$core->con->escape($core->auth->userID()).'\'')->f(0);

			echo '<p class="area" id="blocNotes_personal" style="margin: 0 0.5em 0 0;">'.
				'<label for="blocNotes_personal_text">'.
					__('Personal notebook (other users can\'t edit it):').
				'</label>'.
				form::textarea('blocNotes_personal_text',50,5,
				html::escapeHTML($notes),'maximal').
				'</p>'.
				'<p class="area" id="blocNotes" style="margin: 0 0.5em 0 0;">'.
				'<label for="blocNotes_text">'.
					__('Blog-specific notebook (users of the blog can edit it):').
				'</label>'.
				form::textarea('blocNotes_text',50,5,
				html::escapeHTML(base64_decode($set->blocNotes_text)),
				'maximal').
				'</p>'.
				'<p><span class="form-note">'.
				__('These notes may be read by anyone, don\'t write some sensitive information (password, personal information, etc.)').
				'</span></p>';
		}

		public static function putSettings()
		{
			global $core;

			if (isset($_POST['blocNotes_text']))
			{
				# Personal notebook
				$cur = $core->con->openCursor($core->prefix.'user');
				$cur->bloc_notes = $_POST['blocNotes_personal_text'];
				$cur->update('WHERE user_id = \''.$core->con->escape($core->auth->userID()).'\'');
				
				$core->blog->settings->addNameSpace('blocnotes');
				# Blog-specific notebook
				$core->blog->settings->blocnotes->put('blocNotes_text',
					base64_encode($_POST['blocNotes_text']),'text',
					'Bloc-Notes\' text');
			}
		}

		public static function adminPostHeaders()
		{
			return '<script type="text/javascript" '.
				'src="index.php?pf=blocNotes/post.js">'.
				'</script>'."\n";
		}
	}