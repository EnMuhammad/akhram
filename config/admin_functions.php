<?php
/*
 * PROGRAMED BY EN.MUHAMMAD KAMAL OMAIR 2017
 * ALL RIGHT RESERVED
 * en.muhammadkamal@live.com
 *
 */

namespace Admins;

use PROCESS\prs as prs;

class AdminFunctions
{

    var $inputData = array();
    var $additionalData = array();
    var $inputCont = array();
    var $file = array();
    var $inputID = 0;
    var $output;
    var $output_id = 0;
    function AddContactInfo()
    {
        prs::unSetData();
        prs::$table = CONTACT_INFO_TABLE;
        prs::$data_in = $this->inputData;
        prs::add__record();
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
    function AddCompanyInfo()
    {
        prs::unSetData();
        prs::$table = COMPANY_TABLE;
        prs::$select_cond = array('data_type' => $this->inputData['data_type']);
        if (!empty(prs::select__record())) {
            prs::$cond = array('data_type' => $this->inputData['data_type']);
            prs::delete__record();
        }
        prs::$data_in = $this->inputData;
        prs::add__record();
    }

    function CloseWeb()
    {
        prs::unSetData();
        prs::$table = WEB_SETTINGS;
        prs::$update_value = $this->inputData;
        prs::update__record();
    }
    function AddMedia()
    {
        $folders = array(
            'sectors' => 'sectors',
            'services' => 'services',
            'projects' => 'project_media',
            'slides' => 'slides',
            'items' => 'equipments',
            'clients' => 'clients',
            'pages' => 'pages',
        );
        $file = $this->inputData['photo'];
        $name = $file['name'];
        $tmp = $file['tmp_name'];
        $type = $file['type'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $new_name = time() . uniqid() . '-ALAKHRAM.' . $ext;
        if ($this->inputData['media_type'] == 'projects') {
            $dir = DIR . DS . 'public' . DS . 'images' . DS . $folders[$this->inputData['media_type']] . DS . $this->inputData['media_id'];
        } else {
            $dir = DIR . DS . 'public' . DS . 'images' . DS . $folders[$this->inputData['media_type']];
        }
        if (!is_dir($dir)) {
            mkdir($dir, 777);
        }
        if (in_array($type, prs::$accepted_files)) {
            if (move_uploaded_file($tmp, $dir . DS . $new_name)) {
                prs::unSetData();
                prs::$table = MEDIA_TABLE;
                prs::$data_in = array(
                    'type' => $this->inputData['media_type'],
                    'name_ar' => $this->inputData['name_ar'],
                    'name_en' => $this->inputData['name_en'],
                    'url' => $new_name,
                    'media_id' => $this->inputData['media_id'],
                );
                prs::add__record();
            }
        }
    }

    function GetMedia()
    {
        $folders = array(
            /// Type  => Folder
            'sectors' => 'sectors',
            'services' => 'services',
            'projects' => 'project_media',
            'slides' => 'slides',
            'items' => 'equipments',
            'clients' => 'clients',
            'pages' => 'pages',
        );
        prs::unSetData();
        prs::$table = MEDIA_TABLE;
        prs::$select_cond = array('type' => $this->inputData['type']);
        foreach (prs::select__record() as $t => $m) {
            $this->output[] = array(
                'folder' => (($this->inputData['type'] == 'projects') ? $folders[$this->inputData['type']] . '/' . $m['media_id'] : $folders[$this->inputData['type']]),
                'name' => $m['url'],
                'id' => $m['id']
            );
        }
        return $this->output;
    }
    function AddPage()
    {
        prs::unSetData();
        prs::$table = PAGES_TABLE;
        prs::$data_in = $this->inputData;
        prs::add__record();
        $pid = prs::$last_id;
        $this->output_id = $pid;
        if (!empty($this->file)) {
            for ($i = 0; $i < count($this->file); $i++) {
                if (isset($file['name'][$i])) {
                    $file = $this->file;
                    $name = $file['name'][$i];
                    $tmp = $file['tmp_name'][$i];
                    $type = $file['type'][$i];
                    $ext = pathinfo($name, PATHINFO_EXTENSION);
                    $new_name = time() . uniqid() . '-ALAKHRAM.' . $ext;
                    $dir = DIR . DS . 'public' . DS . 'images' . DS . 'pages';
                    if (!is_dir($dir)) {
                        mkdir($dir, 777);
                    }
                    if (in_array($type, prs::$accepted_files)) {
                        if (move_uploaded_file($tmp, $dir . DS . $new_name)) {
                            prs::unSetData();
                            prs::$table = MEDIA_TABLE;
                            prs::$data_in = array(
                                'type' => 'pages',
                                'name_ar' => $this->inputData['title_ar'],
                                'name_en' => $this->inputData['title_en'],
                                'url' => $new_name,
                                'media_id' => $pid,
                            );
                            prs::add__record();

                        }
                    }
                }
            }
        }
    }

    function addMenuOrder($id, $type, $order_number)
    {
        prs::unSetData();
        prs::$table = MENU_ORDER_TABLE;
        prs::$data_in = array(
            'page_id' => $id,
            'page_type' => $type,
            'order_number' => $order_number
        );
        prs::add__record();
    }
    function AddClients()
    {
        prs::unSetData();
        prs::$table = CLIENTS_TABLE;
        prs::$data_in = $this->inputData;
        prs::add__record();
    }

    function AddSector()
    {
        prs::unSetData();
        prs::$table = SECTORS_TABLE;
        prs::$data_in = $this->inputData;
        prs::add__record();

    }

    function GetLastSectorNumber()
    {
        prs::unSetData();
        prs::$own_sql = "SELECT MAX( menu_order ) AS max FROM " . SECTORS_TABLE . "";
        $max = 0;
        foreach (prs::select__record() as $t => $m) {
            $max = $m['max'];
        }
        return $max;
    }

    function GetLastMenuNumber($type)
    {
        prs::unSetData();
        prs::$own_sql = "SELECT MAX( order_number ) AS max FROM " . MENU_ORDER_TABLE . " WHERE page_type='" . $type . "'";
        $max = 0;
        foreach (prs::select__record() as $t => $m) {
            $max = $m['max'];
        }
        return $max;
    }
    function UpdateSector()
    {
        prs::unSetData();
        prs::$table = SECTORS_TABLE;
        prs::$update_cond = array('id' => $this->inputID);
        prs::$update_value = $this->inputData;
        prs::update__record();
    }

    function DeleteData($id, $type)
    {
        switch ($type) {
            case 'pages':
                prs::unSetData();
                prs::$table = MEDIA_TABLE;
                prs::$cond = array('type' => 'pages', 'media_id' => $id);
                prs::delete__record();
                prs::unSetData();
                prs::$table = PAGES_TABLE;
                prs::$cond = array('id' => $id);
                prs::delete__record();
                break;
            case 'sectors':
                prs::unSetData();
                prs::$table = PROJECTS_TABLE;
                prs::$cond = array('sid' => $id);
                prs::delete__record();
                prs::unSetData();
                prs::$table = SERVICES_TABLE;
                prs::$cond = array('sid' => $id);
                prs::delete__record();
                prs::$table = SECTORS_TABLE;
                prs::$cond = array('id' => $id);
                prs::delete__record();
                break;
            case 'media':
                prs::unSetData();
                prs::$table = MEDIA_TABLE;
                prs::$cond = array('id' => $id);
                prs::delete__record();
                break;
        }
    }
}

class Services extends AdminFunctions
{
    function AddServices()
    {
        prs::unSetData();
        prs::$table = SERVICES_TABLE;
        prs::$data_in = $this->inputData;
        prs::add__record();
    }

    function UpdateServices()
    {
        prs::unSetData();
        prs::$table = SERVICES_TABLE;
        prs::$update_cond = array('id' => $this->inputID);
        prs::$update_value = $this->inputData;
        prs::update__record();
    }

    function DeleteServices()
    {
        prs::unSetData();
        prs::$table = SERVICES_STR_TABLE;
        prs::$cond = array('sid' => $this->inputID);
        prs::delete__record();
        prs::unSetData();;
        prs::$table = SERVICES_TABLE;
        prs::$cond = array('id' => $this->inputID);
        prs::delete__record();
    }
}

class ProjectsItems extends AdminFunctions
{
    function AddProjectsItems($project_type = 'projects')
    {
        if ($project_type == 'projects') {
            prs::unSetData();
            prs::$table = PROJECTS_TABLE;
            prs::$data_in = $this->inputData;
            prs::add__record();
        } else {
            $file = $this->inputData['photo'];
            $name = $file['name'];
            $tmp = $file['tmp_name'];
            $type = $file['type'];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $new_name = time() . uniqid() . '-ALAKHRAM.' . $ext;
            $dir = DIR . DS . 'public' . DS . 'images' . DS . 'equipments' . DS . $new_name;
            if (in_array($type, prs::$accepted_files)) {
                if (move_uploaded_file($tmp, $dir)) {
                    prs::unSetData();
                    prs::$table = EQUI_TABLE;
                    prs::$data_in = array(
                        'name_ar' => $this->inputData['name_ar'],
                        'name_en' => $this->inputData['name_en'],
                        'service_id' => $this->inputData['service_id'],
                        'photo' => $new_name,
                    );
                    prs::add__record();
                }
            }
        }
    }

    function UpdateProjectItems()
    {
        prs::unSetData();
        prs::$table = PROJECTS_TABLE;
        prs::$update_cond = array('id' => $this->inputID);
        prs::$update_value = $this->inputData;
        prs::update__record();
    }

    function DeleteProjectItems()
    {

    }

}

class AddOthers extends AdminFunctions
{
    var $multi_input = array();
    var $logo = '';
    var $logo_file = array();
    var $file_name = '';
    var $file_tmp = '';
    var $file_type = '';

    function UploadLogo()
    {
        $name = $this->file_name;
        $tmp = $this->file_tmp;
        $type = $this->file_type;
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $new_name = time() . uniqid() . '-ALAKHRAM.' . $ext;
        $dir = DIR . DS . 'public' . DS . 'images' . DS . 'suppliers' . DS . $new_name;
        if (in_array($type, prs::$accepted_files)) {
            if (move_uploaded_file($tmp, $dir)) {
                $this->logo = $new_name;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function addSuppliers()
    {
        prs::unSetData();
        prs::$table = SUPP_TABLE;
        prs::$data_in = $this->inputData;
        prs::add__record();
    }

    function addBranch()
    {
        prs::unSetData();
        prs::$table = BRAN_TABLE;
        prs::$data_in = $this->inputData;
        prs::add__record();
    }

    function BranchesList($option = false, $show_all = false)
    {
        prs::unSetData();
        prs::$table = BRAN_TABLE;
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
                $options .= '<option value="' . $op['id'] . '">' . $op['address_ar'] . ' - ' . $op['address_en'] . '</option>';
            } else {
                $options .= '
                <tr>
                <td>' . $op['address_ar'] . ' - ' . $op['address_en'] . '</td>
                <td>' . $op['phone'] . '</td>
                <td>' . $op['email'] . ' </td>
                <td>' . $op['fax'] . ' </td>
                <td>' . $op['whatsapp'] . ' </td>
                <td align=center>
              ' . (($op['mc'] == 0) ? '  <button type"button" onclick="UpdateMC(' . $op['id'] . ')" class="btn btn-primary btn-sm">
                <i class="fa fa-check"></i>
                </button>' : '
                <i class="fa fa-home"></i>
                ') . '
                </td>
                <td><i class="fa fa-trash"></i></td>
                </tr>
                ';
            }
        }
        return $options;
    }

    function PagesList($show_all = false)
    {
        prs::unSetData();
        prs::$table = PAGES_TABLE;
        $options = '';
        if ($show_all) {
            $options = '<option value="0">Select Page - أختر صفحة</option>';
        }
        foreach (prs::select__record() as $t => $op) {
            $options .= '<option value="' . $op['id'] . '">' . $op['title_ar'] . ' - ' . $op['title_en'] . '</option>';

        }
        return $options;
    }

    function UpdatePageInfoMVG($type, $page_id)
    {
        prs::unSetData();
        prs::$table = VMG_TABLE;

        prs::$select_cond = array('id' => 1);
        if (empty(prs::select__record())) {
            prs::$data_in = array(
                $type => $page_id
            );
            prs::add__record();
        } else {
            prs::$update_cond = array('id' => 1);
            prs::$update_value = array($type => $page_id);
            prs::update__record();
        }
    }
    function UpdatePage()
    {
        prs::unSetData();
        prs::$table = PAGES_TABLE;
        prs::$update_cond = array('id' => $this->inputID);
        prs::$update_value = $this->inputData;
        prs::update__record();
    }
    function UpdateBrMC($id)
    {
        prs::unSetData();
        prs::$table = BRAN_TABLE;
        prs::$select_cond = array('mc' => 1);
        if (!empty(prs::select__record())) {
            prs::$update_cond = array('mc' => 1);
            prs::$update_value = array('mc' => 0);
            prs::update__record();
        }
        prs::$update_cond = array('id' => $id);
        prs::$update_value = array('mc' => 1);
        prs::update__record();
    }

    function UpdateOrder($id, $type, $page_type = 'about')
    {
        prs::unSetData();
        prs::$table = MENU_ORDER_TABLE;
        prs::$select_cond = array('page_id' => $id, 'page_type' => $page_type);
        $current_order = prs::select__record();
        $c_order = 0;
        foreach ($current_order as $t => $o) {
            $c_order = $o['order_number'];
        }
        if ($type == 'up') {
            $new_order = $c_order + 1;
        } else {
            if (($c_order - 1) == 0) {
                $new_order = $c_order + 1;
            } else {
                $new_order = $c_order - 1;
            }
        }
        prs::$table = MENU_ORDER_TABLE;
        prs::$select_cond = array('order_number' => $new_order, 'page_type' => $page_type);
        if (!empty(prs::select__record())) {
            prs::$table = MENU_ORDER_TABLE;
            prs::$update_cond = array('order_number' => $new_order, 'page_type' => $page_type);
            prs::$update_value = array('order_number' => $c_order, 'page_type' => $page_type);
            prs::update__record();
            prs::$update_cond = array('page_id' => $id, 'page_type' => $page_type);
            prs::$update_value = array('order_number' => $new_order, 'page_type' => $page_type);
            prs::update__record();
        }
    }
}
