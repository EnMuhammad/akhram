<?php
/**
 * Created by PhpStorm.
 * User: MuhammadKamal
 * Date: 9/11/2018
 * Time: 10:42 PM
 */

namespace Fun;

use PROCESS\prs as prs;

class functions
{
    var $service_id = 0;
    var $return = array();

    function GetServices()
    {
        prs::unSetData();
        prs::$table = SERVICES_TABLE;
        $this->return = prs::select__record();
        return $this->return;
    }

    function GetProjectListByServiceID()
    {
        prs::unSetData();
        prs::$table = PROJECTS_TABLE;
        prs::$select_cond = array('id' => $this->service_id);
        $this->return = prs::select__record();
        return $this->return;
    }
}
