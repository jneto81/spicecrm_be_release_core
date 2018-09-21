<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
* SugarCRM Community Edition is a customer relationship management program developed by
* SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
* 
* This program is free software; you can redistribute it and/or modify it under
* the terms of the GNU Affero General Public License version 3 as published by the
* Free Software Foundation with the addition of the following permission added
* to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
* IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
* OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
* 
* This program is distributed in the hope that it will be useful, but WITHOUT
* ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
* FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
* details.
* 
* You should have received a copy of the GNU Affero General Public License along with
* this program; if not, see http://www.gnu.org/licenses or write to the Free
* Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
* 02110-1301 USA.
* 
* You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
* SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
* 
* The interactive user interfaces in modified source and object code versions
* of this program must display Appropriate Legal Notices, as required under
* Section 5 of the GNU Affero General Public License version 3.
* 
* In accordance with Section 7(b) of the GNU Affero General Public License version 3,
* these Appropriate Legal Notices must retain the display of the "Powered by
* SugarCRM" logo. If the display of the logo is not reasonably feasible for
* technical reasons, the Appropriate Legal Notices must display the words
* "Powered by SugarCRM".
********************************************************************************/

//node the tree view. no need to add a root node,a invisible root node will be added to the
//tree by default.
//predefined properties for a node are  id, label, target and href. label is required property.
//set the target and href property for cases where target is an iframe.
class ExtNode
{
	//predefined node properties.
	var $_label;		//this is the only required property for a node.
	var $_href;
	var $id;
	
	//ad-hoc collection of node properties
	var $_properties=array();
	//collection of parmeter properties;
	var $_params=array();
	
	//sent to the javascript.
	var $uid; 		//unique id for the node.

	var $nodes=array();
	var $dynamic_load=false; //false means child records are pre-loaded.
	var $dynamicloadfunction='loadDataForNode'; //default script to load node data (children)
	var $expanded=false;  //show node expanded during initial load.
	 
	public function __construct($id,$label,$show_expanded=true)
    {
		$this->_label=$label;
		$this->id = $id;	
		$this->_properties['text']=$label;
		$this->uid=microtime();
		$this->set_property('id',$id);
        $this->expanded = $show_expanded;
	}

	//properties set here will be accessible via
	//node.data object in javascript.
	//users can add a collection of paramaters that will
	//be passed to objects responding to tree events
 	function set_property($name, $value, $is_param=false) {
 		if(!empty($name) && ($value === 0 || !empty($value))) {
 			if ($is_param==false) {
 				$this->_properties[$name]=$value;
 			} else {
 				$this->_params[$name]=$value;
 			}	
 		}
 	}
 	
	//add a child node.
 	function add_node($node) {
  		$this->nodes[$node->uid]=$node;
  	}

	//return definition of the node. the definition is a multi-dimension array and has 3 parts.
	// data-> definition of the current node.
	// attributes=> collection of additional attributes such as style class etc..
	// nodes: definition of children nodes. 	
 	function get_definition() {
 		$ret=array();

 		$ret = $this->_properties; 
 		if (!empty($this->_params)) {
 			$ret[] = $this->_params;	
 		}		
 		
		$ret['dynamicload']=$this->dynamic_load;
		$ret['dynamicloadfunction']=$this->dynamicloadfunction;
		$ret['expanded']=$this->expanded;
		$ret['children'] = array();
		$ret['type'] = 1;
						 	
 		foreach ($this->nodes as $node) {
 			$ret['children'][]=$node->get_definition();
 		}
		//$ret['leaf'] = empty($ret['children']);
		return $ret;		
 	}
}
?>