<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/**
 * twentyreasons ContactCCDetails
 * @author Sebastian Franz (twentyreasons)
 */
require_once('include/SugarObjects/templates/basic/Basic.php');
require_once('include/utils.php');

class ContactCCDetail extends SugarBean
{
    //Sugar vars
    public $table_name = "contactccdetails";
    public $object_name = "ContactCCDetail";
    public $new_schema = true;
    public $module_dir = "ContactCCDetails";

    public $id;
    public $date_entered;
    public $date_modified;
    public $date_indexed;
    public $assigned_user_id;
    public $modified_user_id;
    public $created_by;
    public $created_by_name;
    public $modified_by_name;
    public $name;
    public $description;

    public $contact_id;
    public $companycode;
    public $abccategory;
    public $paymentterms;
    public $incoterm1;
    public $incoterm2;

    public $companycode_name;

    public $relationship_fields = Array('companycode_id' => 'companycodes');

    function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return true;
        }
        return false;
    }

    function __toString()
    {
        return $this->get_summary_text();
    }

    function get_summary_text()
    {
        return $this->companycode_name;
    }
}