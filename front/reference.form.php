<?php
/*
 * @version $Id: bill.tabs.php 530 2011-06-30 11:30:17Z walid $
 LICENSE

 This file is part of the order plugin.

 Order plugin is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Order plugin is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; along with Order. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 @package   order
 @author    the order plugin team
 @copyright Copyright (c) 2010-2011 Order plugin team
 @license   GPLv2+
            http://www.gnu.org/licenses/gpl.txt
 @link      https://forge.indepnet.net/projects/order
 @link      http://www.glpi-project.org/
 @since     2009
 ---------------------------------------------------------------------- */

define('GLPI_ROOT', '../../..');
include (GLPI_ROOT."/inc/includes.php");

if (!isset ($_GET["id"])) {
   $_GET["id"] = "";
}
if (!isset ($_GET["withtemplate"])) {
   $_GET["withtemplate"] = "";
}

$reference = new PluginOrderReference();

if (isset ($_POST["add"])) {
   $reference->check(-1,'w',$_POST);
   $newID = $reference->add($_POST);
   $url   = Toolbox::getItemTypeFormURL('PluginOrderReference')."?id=$newID";
   Html::redirect($url);
}
/* delete order */
else if (isset ($_POST["delete"])) {
   $reference->check($_POST['id'], 'w');
   $reference->delete($_POST);
   $reference->redirectToList();
}
/* restore order */
else if (isset ($_POST["restore"])) {
   $reference->check($_POST['id'], 'w');
   $reference->restore($_POST);
   $reference->redirectToList();
}
else if (isset($_POST["purge"])) {

	$reference->check($_POST['id'],'w');
   $reference->delete($_POST,1);
	$reference->redirectToList();
	
}
else if (isset ($_POST["update"])) {
   $reference->check($_POST['id'], 'w');
   $reference->update($_POST);
   Html::back();
}
Html::header(PluginOrderReference::getTypeName(1), '', "plugins", "order", "reference");
$reference->showForm($_GET["id"], array('withtemplate' => $_GET['withtemplate']));
Html::footer();