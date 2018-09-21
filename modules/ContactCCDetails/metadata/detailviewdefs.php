<?php
$module_name = 'ContactCCDetails';
$viewdefs[$module_name]['DetailView'] = array(
    'templateMeta' => array('maxColumns' => '2',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
            array('label' => '10', 'field' => '30')
        ),
    ),
    'panels' => array(
        'default' =>
            array(
                array(
                    array('name' => 'name'),
                ),
                array(
                    array('name' => 'contact_name'),
                    array('name' => 'companycode_name'),
                ),
                array(
                    array('name' => 'description'),
                ),
                array(
                    array('name' => 'paymentterms'),
                    array('name' => 'abccategory'),
                ),
                array(
                    array('name' => 'incoterm1'),
                    array('name' => 'incoterm2'),
                ),
            ),
    ),
);