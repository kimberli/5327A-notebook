<?php
/**
 * WhitelistedNamespaces
 * Author:  Lisa Ridley
 * Date:  25 Feb 2010
 * Version 0.85 beta
 * Copyright (C) 2010 Lisa Ridley
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You can find a copy of the GNU General Public License at http://www.gnu.org/copyleft/gpl.html
 * A paper copy can be obtained by writing to:  Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 *
 * To install this extension, save this file in the "extensions" folder of your
 *   MediaWiki installation, and add the following to LocalSettings.php
 *
 *   $wgGroupPermissions['*']['read'] = false;
 *   require_once("$IP/extensions/WhitelistedNamespaces.php");
 *   $wgWhitelistedNamespaces = array(NS_MAIN, NS_TALK);
 *
 *
 */
 
$wgExtensionCredits['other'][] = array(
    'name' => 'WhitelistedNamespaces',
    'author' => 'Lisa Ridley',
    'url' => 'http://www.mediawiki.org/wiki/Extension:WhitelistedNamespaces',
    'version' => '0.85 beta',
    'description' => 'Allows for whitelisting of all pages in a particular namespace or set of namespaces',
);
 
$wgExtensionFunctions[] = 'fnWhitelistedNamespaceSetup';
 
/**
 * extension setup
 */
function fnWhitelistedNamespaceSetup(){
    global $wgHooks, $wgGroupPermissions;
    $wgGroupPermissions['*']['read'] = false;
    $wgHooks['UserGetRights'][] = 'fnWhitelistedNamespaces';
}
/**
 * Adds currently viewed page to $wgWhitelistRead if page is in whitelisted namespace
 * Always returns true so that other extensions using the UserGetRights hook
 * will be executed
 *
 * @params $user User object
 * @params $rights array of user rights
 * @return boolean true
 */
function fnWhitelistedNamespaces($user, $rights){
    global $wgWhitelistedNamespaces, $wgTitle, $wgWhitelistRead;
    /** if user is not anonymous, then exit the script; access is allowed **/
    if(!$user->isAnon()){
        return true;
    }
    $namespace = $wgTitle->getNamespace();
    $nstext = $wgTitle->getNsText();
    $title = $wgTitle->getFullText();
    //Check to see if namespace of current title is in whitelisted namespaces
    if(in_array($namespace, $wgWhitelistedNamespaces)) {
        //build title with prefix
        $titletoadd = $title;
        //check to see if title is in whitelist
        if(is_array($wgWhitelistRead)) {
            if(!in_array($titletoadd, $wgWhitelistRead)) {
                //add if not in whitelist
                $wgWhitelistRead[] = $titletoadd;
            }
        } else {
            $wgWhitelistRead = array($titletoadd);
        }
    }
    return true;
}