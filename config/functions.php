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
    var $sector_id = 0;
    var $service_id = 0;
    var $project_id = 0;
    var $page_id = 0;
    var $return = array();

    function CreateUrlName($string)
    {
        return str_replace(' ', '_', trim($string));
    }
    function GetSectors()
    {
        prs::unSetData();
        prs::$table = SERVICES_TABLE;
        $this->return = prs::select__record();
        return $this->return;
    }
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
        prs::$table = MEDIA_TABLE;
        prs::$select_cond['media_id'] = $pid;
        prs::$select_cond['type'] = 'projects';
        prs::$limit = 1;
        prs::$order = 'id DESC';
        $image = '';
        foreach (prs::select__record() as $item => $key) {
            if ($cover) {
                $image = $key['url'];
            } else {
                $this->return[] = $key['url'];
            }

        }
        if ($cover) {
            return $image;
        } else {
            return $this->return;
        }
    }

    function GetCoverMedia($pid, $type = "projects")
    {
        prs::unSetData();
        prs::$table = MEDIA_TABLE;
        prs::$select_cond['media_id'] = $pid;
        prs::$select_cond['type'] = $type;
        prs::$limit = 1;
        prs::$order = 'id DESC';
        $image = '';
        if (!empty(prs::select__record())) {
            foreach (prs::select__record() as $item => $key) {
                if ($type == 'projects') {
                    $image = $pid . '/' . $key['url'];
                } else {
                    $image = $key['url'];
                }
            }
        } else {
            $image = 'def-logo.png';
        }
        return $image;
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

    function GetSectorFullData($l)
    {
        prs::unSetData();
        prs::$table = SECTORS_TABLE;
        prs::$select_cond = array('id' => $this->sector_id);
        foreach (prs::select__record() as $t => $s) {
            $this->return = array(
                'id' => $s['id'],
                'title' => $s['title_' . $l],
                'about' => $s['about_' . $l],
            );
        }
        prs::unSetData();
        prs::$table = SERVICES_TABLE;
        prs::$select_cond = array('sid' => $this->sector_id);
        foreach (prs::select__record() as $x => $d) {
            $this->return['services'][] = array(
                'id' => $d['id'],
                'title' => $d['service_' . $l],
                'city' => $d['city_id'],
                'about' => $d['about_service_' . $l],
            );
        }
        prs::unSetData();
        prs::$table = PROJECTS_TABLE;
        prs::$select_cond = array('sid' => $this->sector_id);
        foreach (prs::select__record() as $o => $x) {
            $this->return['projects'][] = array(
                'id' => $x['id'],
                'title' => $x['title_' . $l],
                'city' => $x['city_id'],
                'start' => $x['date_start'],
                'end' => $x['date_end'],
            );
        }
        return $this->return;
    }

    function GetFullPageData($l)
    {
        prs::unSetData();
        prs::$table = PAGES_TABLE;
        prs::$select_cond = array('id' => $this->page_id);
        foreach (prs::select__record() as $i => $p) {
            $this->return = array(
                'title' => $p['title_' . $l],
                'content' => $p['content_' . $l],
                'views' => $p['views']
            );
        }
        prs::unSetData();
        prs::$table = MEDIA_TABLE;
        prs::$select_cond = array('type' => 'pages', 'media_id' => $this->page_id);
        if (!empty(prs::select__record())) {
            foreach (prs::select__record() as $r => $m) {
                $this->return['media'][] = array(
                    'url' => $m['url'],
                    'title' => $m['name_' . $l]
                );
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

    function CityListAsOptions($all = false)
    {
        prs::unSetData();
        prs::$table = CITY_BRANCH_TABLE;
        if ($all) {
            $options = '<option value="0">All - الكل</option>';
        } else {
            $options = '';
        }
        foreach (prs::select__record() as $t => $op) {
            $options .= '<option value="' . $op['id'] . '">' . $op['name'] . ' - ' . $op['name_en'] . '</option>';
        }
        return $options;
    }

    function ServicesListAsOptions($all = false, $sid = false)
    {
        prs::unSetData();
        prs::$table = SERVICES_TABLE;
        if ($all) {
            $options = '<option value="0">All - الكل</option>';
        } else {
            $options = '';
        }
        if ($sid != false) {
            prs::$select_cond = array('sid' => $sid);
        }
        foreach (prs::select__record() as $t => $op) {
            $options .= '<option value="' . $op['id'] . '">' . $op['service_ar'] . ' - ' . $op['service_en'] . '</option>';
        }
        return $options;
    }

    function ClientsListAsOptions($all = false)
    {
        prs::unSetData();
        prs::$table = CLIENTS_TABLE;
        if ($all) {
            $options = '<option value="0">All - الكل</option>';
        } else {
            $options = '';
        }
        foreach (prs::select__record() as $t => $op) {
            $options .= '<option value="' . $op['id'] . '">' . $op['name_ar'] . ' - ' . $op['name_en'] . '</option>';
        }
        return $options;
    }

    function ProjectsListAsOptions($all = false)
    {
        prs::unSetData();
        prs::$table = PROJECTS_TABLE;
        if ($all) {
            $options = '<option value="0">All - الكل</option>';
        } else {
            $options = '';
        }
        foreach (prs::select__record() as $t => $op) {
            $options .= '<option value="' . $op['id'] . '">' . $op['title_ar'] . ' - ' . $op['title_en'] . '</option>';
        }
        return $options;
    }

    function SectorsListAsOptions($all = false)
    {
        prs::unSetData();
        prs::$table = SECTORS_TABLE;
        if ($all) {
            $options = '<option value="0">All - الكل</option>';
        } else {
            $options = '';
        }
        foreach (prs::select__record() as $t => $op) {
            $options .= '<option value="' . $op['id'] . '">' . $op['title_ar'] . ' - ' . $op['title_en'] . '</option>';
        }
        return $options;
    }
    function ItemsListAsOptions($all = false)
    {
        prs::unSetData();
        prs::$table = EQUI_TABLE;
        if ($all) {
            $options = '<option value="0">All - الكل</option>';
        } else {
            $options = '';
        }
        foreach (prs::select__record() as $t => $op) {
            $options .= '<option value="' . $op['id'] . '">' . $op['name_ar'] . ' - ' . $op['name_en'] . '</option>';
        }
        return $options;
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

class AdminFunctions
{

    var $username;
    var $password;
    var $uid = 0;

    function CheckLogin()
    {
        $this->password = sha1(md5($this->password));
        prs::unSetData();
        prs::$table = ADMIN_TABLE;
        prs::$select_cond = array('username' => $this->username, 'password' => $this->password);
        if (!empty(prs::select__record())) {
            foreach (prs::select__record() as $t => $i) {
                $this->uid = $i['id'];
            }
            $this->SaveLogin();
            return true;
        } else {
            return false;
        }
    }

    function SaveLogin()
    {
//    if(!isset($_SESSION['AdminLogin'])){
        $_SESSION['AdminLogin'] = $this->username;
        $_SESSION['AdminId'] = $this->uid;
//    }
    }

    function Logout()
    {
        $_SESSION['AdminLogin'] = '';
        $_SESSION['AdminId'] = 0;
        unset($_SESSION['AdminId']);
        unset($_SESSION['AdminLogin']);
    }

}
