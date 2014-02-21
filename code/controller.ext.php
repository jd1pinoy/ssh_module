<?php

/**
 *
 * ZPanel - A Cross-Platform Open-Source Web Hosting Control panel.
 * 
 * @package ZPanel
 * @version $Id$
 * @author Bobby Allen - ballen@zpanelcp.com
 * @copyright (c) 2008-2011 ZPanel Group - http://www.zpanelcp.com/
 * @license http://opensource.org/licenses/gpl-3.0.html GNU Public License v3
 *
 * This program (ZPanel) is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
 
class module_controller {

	static function getDescription() {
			return ui_module::GetModuleDescription();
    }

	static function getModuleName() {
		$module_name = ui_module::GetModuleName();
        return $module_name;
    }

	static function getModuleIcon() {
		global $controller;
		$module_icon = "/modules/" . $controller->GetControllerRequest('URL', 'module') . "/assets/icon.png";
        return $module_icon;
    }
	
	static function ExecuteSavePassword($inUserName, $inPassword) {
		global $controller;
	    if (!empty($inUserName) && !empty($inPassword)) {
			$htpasswd     = ctrl_options::GetOption('zpanel_root') . "modules/" . $controller->GetControllerRequest('URL', 'module') . "/sndsec/snd.htpasswd";
			$htaccessfile = ctrl_options::GetOption('zpanel_root') . "modules/" . $controller->GetControllerRequest('URL', 'module') . "/sndsec/.htaccess";
	        system(ctrl_options::GetOption('htpasswd_exe') . " -b -m -c " . $htpasswd . " " . $inUserName . " " . $inPassword . "");
	        $fh = fopen($htaccessfile, 'w');
	        $stringData = "AuthUserFile " . $htpasswd ."\r\nAuthType Basic\r\nAuthName \"SSH Module\"\r\nRequire valid-user";
	        fwrite($fh, $stringData);
	        fclose($fh);
	    } else {

		}
	}

    static function doSavePassword() {
		global $controller;
		$formvars = $controller->GetAllControllerRequests('FORM');
		if (isset($formvars['inUserName']) && isset($formvars['inPassword'])){
        	if (self::ExecuteSavePassword($formvars['inUserName'], $formvars['inPassword'])) {
            	return true;
        	} else {
            	return false;
        	}
		}
    }
	
	static function getWelcome () {
		return 'This module is strictly for ZPanel server administrator only. <b style="color:red;">DO NOT</b> share or enable this to Users or Resellers for security reason.';
	}
	
	static function getAuthenticNotes () {
		return 'NOTE: You must always set a password protect to your SSH module to prevent it from unauthorized access.<br/>If this is your first time, please create .htpasswd File Password Encryption to protect files and directory';
	}
	
	static function getReadAuthorised () {
		global $controller;
        $file = "./modules/ssh_module/code/readme.txt";
        $IframeForm = fs_filehandler::ReadFileContents($file); 
        return $IframeForm;
	}
	
	static function getReadMindterm() {
        global $controller;
        $file = "./modules/ssh_module/mindterm/readme.html";
        $ReadMindterm = fs_filehandler::ReadFileContents($file); 
        return $ReadMindterm;
    }
	
	static function getCurrentProtect() {
        global $controller;
        $file = "./modules/ssh_module/sndsec/snd.htpasswd";
        $CurrentProtect = fs_filehandler::ReadFileContents($file); 
        return $CurrentProtect;
    }
	
		static function getCheckStatus() {
        global $controller;
        if (!file_exists(ctrl_options::GetOption('zpanel_root') . "modules/" . $controller->GetControllerRequest('URL', 'module') . "/sndsec/snd.htpasswd")){
			$message = "<font color=\"red\">Disabled</font>";
		} else {
			$message = "<font color=\"green\">Enabled</font>";
		}
		return $message;
    }

	
}

?>