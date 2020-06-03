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

    function GetSectorsFullData($l)
    {
        prs::unSetData();
        prs::$table = SECTORS_TABLE;
        $i = 0;
        $f = 0;
        foreach (prs::select__record() as $t => $s) {
            $this->return[$i] = array(
                'id' => $s['id'],
                'title' => $s['title_' . $l],
                'about' => $s['about_' . $l],

            );
            $this->sector_id = $s['id'];
            prs::unSetData();
            prs::$table = SERVICES_TABLE;
            prs::$select_cond = array('sid' => $this->sector_id);

            foreach (prs::select__record() as $x => $d) {
                $this->return[$i]['services'][] = array(
                    'id' => $d['id'],
                    'title' => $d['service_' . $l],
                    'city' => $d['city_id'],
                    'about' => $d['about_service_' . $l],
                );
                prs::unSetData();
                prs::$table = PROJECTS_TABLE;
                $this->service_id = $d['id'];
                prs::$select_cond = array('service_id' => $this->service_id);
                foreach (prs::select__record() as $o => $x) {
                    $this->return[$i]['services'][$f]['projects'][] = array(
                        'id' => $x['id'],
                        'title' => $x['title_' . $l],
                        'city' => $x['city_id'],
                        'service_id' => $x['service_id'],
                        'start' => $x['date_start'],
                        'end' => $x['date_end'],
                    );
                }
                $f++;
            }


            $i++;
        }
        return $this->return;
    }

    function GetCompanyInfo($type)
    {
        $data = array(
            'title_ar' => '',
            'title_en' => '',
        );
        prs::unSetData();
        prs::$select_cond = array('data_type' => $type);
        prs::$table = COMPANY_TABLE;
        foreach (prs::select__record() as $t => $info) {
            $data['title_ar'] = $info['data_ar'];
            $data['title_en'] = $info['data_en'];
        }
        return $data;
    }

    function WebClosed()
    {
        $data = array(
            'closed' => 0,
        );
        prs::unSetData();
        prs::$table = WEB_SETTINGS;
        foreach (prs::select__record() as $t => $info) {
            $data['closed'] = $info['closed'];
        }
        return $data;
    }
    function CompanyInfo($type, $l)
    {
        prs::unSetData();
        prs::$table = COMPANY_TABLE;
        prs::$select_cond = array('data_type' => $type);
        $company_background = '';
        foreach (prs::select__record() as $t => $back) {
            $company_background = $back['data_' . $l];
        }
        return $company_background;
    }

    function ServiceCompanyCities()
    {
        prs::unSetData();
        prs::$table = PROJECTS_TABLE;
        prs::$data_select = array('distinct city_id');
        prs::$select_cond = array('city_id' => 'NOT:0');
        $city_a = array();
        foreach (prs::select__record() as $i => $city) {
            $city_a[] = array(
                'name' => $this->GetCityName($city['city_id']),
                'id' => $city['city_id']
            );
        }
        return $city_a;
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
            $options .= '<option value="' . $op['id'] . '" ' . (($op['id'] == 13) ? "selected" : "") . '>' . $op['name'] . ' - ' . $op['name_en'] . '</option>';
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

    function SuppliersList($option = false, $show_all = false)
    {
        prs::unSetData();
        prs::$table = SUPP_TABLE;
        $options = '';
        if ($option) {
            if ($show_all) {
                $options = '<option value="0">All - الكل</option>';
            } else {
                $options = '';
            }
        }
        foreach (prs::select__record() as $t => $op) {

            if ($option) {
                $options .= '<option value="' . $op['id'] . '">' . $op['name_ar'] . ' - ' . $op['name_en'] . '</option>';
            } else {
                $options .= '
                <tr>
                <td>' . $op['name_ar'] . ' - ' . $op['name_en'] . '</td>
                <td>' . $op['webLink'] . '</td>
                <td><img src="images/suppliers/' . $op['logo'] . '" style="width:50px;height:50px;"></td>
                <td><i class="fa fa-trash"></i></td>
                </tr>
                ';
            }
        }
        return $options;
    }

    function SuppliersListArray($l)
    {
        prs::unSetData();
        prs::$table = SUPP_TABLE;

        foreach (prs::select__record() as $t => $op) {
            $this->return[] = array(
                'name' => $op['name_' . $l],
                'link' => $op['webLink'],
                'logo' => $op['logo'],
            );
        }

        return $this->return;
    }
    function GetCityName($id)
    {
        prs::unSetData();
        prs::$table = CITY_BRANCH_TABLE;
        prs::$select_cond = array('id' => $id);
        foreach (prs::select__record() as $t => $name) {
            $this->return['name'] = $name['name'] . '-' . $name['name_en'];
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

    function Branches($l, $id = 0)
    {
        prs::unSetData();
        prs::$table = BRAN_TABLE;
        if ($id == 0) {
            prs::$select_cond = array('mc' => 1);
            $title = 'المركز الرئيسي - Main Center';
        } else {
            prs::$select_cond = array('city_id' => $id);
            $title = '';
        }
        $options = '';
        foreach (prs::select__record() as $t => $x) {
            if ($x['mc'] == 1) {
                $title = 'المركز الرئيسي - Main Center';
            }
            $options = '
                    <div class="contact-address">
                    <div class="col-md-6 contact-address1">
                        <div class="clearfix"></div>
                        <h5>Address</h5>
                       <p><b>Al Alkhram - الاخرم - ' . $title . '</b></p>
                        <p>' . $x['address_' . $l] . '</p>
                    </div>
                    <div class="col-md-6 contact-address1">
                        <h5>Email Address </h5>
                          <p>General :<a href="malito:' . $x['email'] . '">' . $x['email'] . '</a></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="contact-address">
                    <div class="col-md-6 contact-address1">
                        <h5 >Phone </h5>
                        <p>Landline :  ' . $x['phone'] . '</p>
                        <p>Fax :  ' . $x['fax'] . '</p>
                        <p>Whatsapp :  ' . $x['whatsapp'] . '</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
         ';
        }
        return $options;
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
