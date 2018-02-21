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

if (!defined('DC_CONTEXT_ADMIN')) {return;}

$page_title = __('Notebook');
$msg = '';

try
{
	if (!empty($_POST['saveconfig']))
	{
		blocNotes::putSettings();
		http::redirect($p_url.'&saveconfig=1');
	}
}
catch (Exception $e)
{
	$core->error->add($e->getMessage());
}

if (isset($_GET['saveconfig']))
{
	$msg = __('Configuration successfully updated.');
}

?>
<html>
<head>
	<title><?php echo $page_title; ?></title>
</head>
<body>
<?php

	echo dcPage::breadcrumb(
		array(
			html::escapeHTML($core->blog->name) => '',
			'<span class="page-title">'.$page_title.'</span>' => ''
		));

if (!empty($msg)) {
  dcPage::success($msg);
}
?>

	<div id="settings" title="<?php echo __('settings'); ?>">
		<form method="post" action="<?php echo http::getSelfURI(); ?>">
			<?php blocNotes::form(); ?>
			
			<p><?php echo $core->formNonce(); ?></p>
			<p><input type="submit" name="saveconfig" value="<?php echo __('Save'); ?>" /></p>
		</form>
	</div>

</body>
</html>