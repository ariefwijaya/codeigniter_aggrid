<?php

defined('BASEPATH') or exit('No direct script access allowed');

require(APPPATH . 'core/CI_Aggrid.php');
class Grid_model extends CI_Aggrid
{
    function initiateUserData($request)
    {
        $this->setRequest($request);
        $columnList = array(
            array(
                'key' => 'action',
                'type' => 'custom',
                'colDef' => array(
                    'width' => 150,
                    'cellRenderer' => 'actionCellRenderer',
                    'resizable'=>false
                )
            ),
             array(
                'key' => 'id',
                'type' => 'number',
                'colDef' => array(
                    // 'hide' => true,
                )
                // 'tableAlias'=>'a'
            ),
            array(
                'key' => 'username',
                'type' => 'text'
            ),
            array(
                'key' => 'name',
                'type' => 'text'
            ),
            array(
                'key' => 'gender',
                'type' => 'set'
            ),
            array(
                'key' => 'gender_format',
                'type' => 'set',
                'query'=>"IF(a.gender='F','FEMALE','MALE')"
            ),
            array(
                'key' => 'email',
                'type' => 'text'
            ),
            array(
                'key' => 'avatar_img',
                'type' => 'text',
                'colDef' => array(
                    'cellRenderer' => 'thumbImageRenderer',
                    'filter' => 'agTextColumnFilter',
                    'enablePivot' => false,
                    'enableRowGroup' => false,
                    'enableValue' => false
                )
            ),
           
            array(
                'key' => 'nationality',
                'type' => 'text',
                'query'=>"(Select sub.name from tbl_countries sub where sub.id=a.nationality_id)"
            ),
            array(
                'key' => 'islocked',
                'type' => 'set',
                'colDef' => array(
                    'cellRenderer' => 'booleanCellRenderer'
                )
            ),
            array(
                'key' => 'idt',
                'type' => 'date',
                'colDef'=>array('headerName'=>"Last Update")
            ),
        );
        $this->setCustomQuery(function ($curDB) {
            $curDB->where('isdeleted', 0);
        });
        $this->setdefaultColId("id");
        $this->setDB($this->db);
        $this->setColumnList($columnList);
        $this->setTableName("tbl_user","a");
    }
}
                        
/* End of file user_grid_model.php */
