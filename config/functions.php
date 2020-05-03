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
    var $project_id = 0;
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
        prs::$select_cond = array('service_id' => $this->service_id);
        $this->return = prs::select__record();
        return $this->return;
    }
    function GetProjects($limit = 0)
    {
        prs::unSetData();
        prs::$table = PROJECTS_TABLE;
        if ($limit > 0) {
            prs::$limit = $limit;
        }
        foreach (prs::select__record() as $p => $val) {
            $this->return[] = $val;
        }
        return $this->return;
    }

    function GetProjectsMedia($pid, $cover = false)
    {
        prs::unSetData();
        prs::$table = PROJECTS_MEDIA_TABLE;
        prs::$select_cond['pid'] = $pid;
        if ($cover) {
            prs::$select_cond['cover'] = 1;
        }
        $image = '';
        foreach (prs::select__record() as $item => $key) {
            if ($cover) {
                $image = $key['media_name'];
            } else {
                $this->return[] = $key['media_name'];
            }

        }
        if ($cover) {
            return $image;
        } else {
            return $this->return;
        }
    }

    function GetProjectInfo($lang)
    {
        prs::unSetData();
        prs::$table = PROJECTS_TABLE;
        prs::$select_cond = array('id' => $this->project_id);
        $this->return['Task'] = array();
        foreach (prs::select__record() as $t => $p) {
            $this->return['title'] = $p['title_' . $lang];
            $this->return['city'] = $this->GetCityName($p['city_id']);
            $this->return['service'] = $this->GetServiceName($p['service_id'], $lang);
            $this->return['date_start'] = $p['date_start'];
            $this->return['date_end'] = $p['date_end'];
            $this->return['Client'] = $this->GetClientName($p['client_id'], $lang);
            $this->return['contract'] = $p['contract_type'];
            $this->return['ads'] = $p['advisor'];

            /// Get Tasks ///
            prs::unSetData();
            prs::$table = PROJECTS_TASK_TABLE;
            prs::$select_cond = array('pid' => $p['id']);
            foreach (prs::select__record() as $y => $task) {
                $this->return['Task'][] = $task['task_' . $lang];
            }
        }
        return $this->return;
    }
    function GetServicesStr($sid)
    {
        prs::unSetData();
        prs::$table = SERVICES_STR_TABLE;
        prs::$select_cond = array('sid' => $sid);
        foreach (prs::select__record() as $r => $t) {
            $this->return[] = $t;
        }
        return $this->return;
    }
    function GetCityName($id)
    {
        prs::unSetData();
        prs::$table = CITY_BRANCH_TABLE;
        prs::$select_cond = array('id' => $id);
        foreach (prs::select__record() as $t => $name) {
            $this->return['name'] = $name['name'];
        }
        return $this->return['name'];
    }

    function GetServiceName($id, $lang)
    {
        prs::unSetData();
        prs::$table = SERVICES_TABLE;
        prs::$select_cond = array('id' => $id);
        foreach (prs::select__record() as $t => $name) {
            $this->return['name'] = $name['service_' . $lang];
        }
        return $this->return['name'];
    }

    function GetClientName($id, $lang)
    {
        prs::unSetData();
        prs::$table = CLIENTS_TABLE;
        prs::$select_cond = array('id' => $id);
        foreach (prs::select__record() as $t => $name) {
            $this->return['name'] = $name['name_' . $lang];
        }
        return $this->return['name'];
    }
}
