<?php

namespace PROCESS;
require_once(DIR . DS . 'config' . DS . 'files_name.php');

require_once(DIR . DS . 'config' . DS . DATABASE__FILE);
require_once(DIR . DS . 'config' . DS . 'tables.php');

use Database\connect;


class prs
{
    static $data_in = array();
    static $data_out = array();
    static $data_select = array();
    static $select_cond = array();
    static $select_operation = 'OR';
    static $limit = false;
    static $order = false;
    static $group = false;
    static $select_type = '*';
    static $not_equal = false;
    static $table;
    static $link = NULL;
    static $own_sql = false;
    static $error;
    static $cond = array();
    static $update_value = array();
    static $update_cond = array();
    static $upload_info = array();
    static $last_id;


    ///// --- Upload Files --- ////

    static $upload_dir = DIR . DS . 'files' . DS;
    static $file;
    static $new_name;
    static $multi_upload = false;
    static $accepted_files = array(
        'image/jpg', 'image/jpeg', 'image/gif', 'image/png'
    );
    static $accepted_doc = array(
        'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    );
    var $error_upload;

    static function string_enc($val, $cl = false)
    {
        if ($cl == false) {
            $hash = md5('ASFGYU123456789');
        } else {
            $hash = sha1('ASFGYU123456789');
        }
        return $pass = crypt($val, $hash);
    }

    static function check_ex_record($val, $type /* Required */)
    {
        $db = self::getInstance();
        $q = $db->prepare("SELECT count(*) FROM " . self::$table . " WHERE $type='$val'");
        $q->execute();
        return $q->fetchColumn();
    }

    static public function getInstance()
    {
        try {
            return connect::CreateConnection();
        } catch (\PDOException $e) {
            echo 'Our database is down, Please try again later ..';
        }
    }

    static function add__record()
    {
        /// - Require $table, NewValue

        if (is_array(self::$data_in) && !empty(self::$data_in)) {
            $row = array();
            $values = array();
            $q = array();
            foreach (self::$data_in as $key => $val) {
                $row[] = $key;
                $values[] = $val;
                $q[] = '?';
            }
            if (is_array(self::$table)) {
                self::$table = join(',', self::$table);
            }
            $db = self::getInstance();

            $q = $db->prepare("INSERT INTO " . self::$table . " (" . join(',', $row) . ") VALUES (" . join(',', $q) . ")");
            $q->execute($values);

            self::$last_id = $db->lastInsertId();
            return true;
        } else {
            self::$error = "ERROR , Please enter some data";
            return false;
        }
    }

    static function delete__record()
    {
        /// - Require $table , Condition

        if (is_array(self::$cond) && !empty(self::$cond)) {
            $row = array();
            $values = array();
            $q = array();
            $sql = ' WHERE ';
//                              data => value
            foreach (self::$cond as $key => $val) {
                $row[] = $key . '=?';
                $values[] = $val;
                $q[] = '?';
            }
            if (is_array(self::$table)) {
                self::$table = join(',', self::$table);
            }
            $db = self::getInstance();
            $q = $db->prepare("DELETE FROM " . self::$table . " WHERE " . join(" AND ", $row));
            $q->execute($values);
        } else {
            echo self::$error = "ERROR , Please enter some data";
        }
    }

    static function TRUNCATE_TABLE($table/* Required */)
    {
        if (is_array($table)) {
            $table = join(',', $table);
        }
        $db = self::getInstance();
        $x = $db->prepare("TRUNCATE TABLE " . $table);
        $x->execute();
    }

    static function update__record($all = false)
    {
        /// - Require $table, NewValue , Condition

        if (is_array(self::$table) && !empty(self::$table)) {
            self::$table = join(',', self::$table);
        }
        if (is_array(self::$update_value) && !empty(self::$update_value)) {

            $r = array();
            $q = array();
            $vl = array();

            //// data in ////
            foreach (self::$update_value as $k => $v) {
                $r[] = $k . '=?';
                $vl[] = $v;
            }
            if ($all == false || empty(self::$update_cond)) {
                if (is_array(self::$update_cond) && !empty(self::$update_cond)) {
                    foreach (self::$update_cond as $ql => $v) {
                        $q[] = $ql . '=?';
                        $vl[] = $v;
                    }
                    $sql = ' WHERE ' . join(' AND ', $q);
                } else {
                    $sql = '';
                }
            } else {
                $sql = '';
            }
            $db = self::getInstance();
            if (!empty($vl)) {
                $db->prepare("UPDATE " . self::$table . " SET " . join(',', $r) . $sql)->execute($vl);
            } else {
                $db->prepare("UPDATE " . self::$table . " SET " . join(',', $r))->execute();
            }

        }


////////////// UPDATE table SET value=:value WHERE id=?///////////
    }

    static function xss_clean($data)
    {

        $data = str_replace(array('&amp;', '&lt;', '&gt;'), array('&amp;amp;', '&amp;lt;', '&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);


        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove name spaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);

        return $data;
    }

    static function PanelId()
    {
        $rand = rand(10000, 99999);
        prs::unSetData();
        prs::$table = USER_TABLE;
        prs::$select_cond = array('panel_id' => $rand);
        if (count(prs::select__record()) == 0) {
            return $rand;
        } else {
            return self::PanelId();
        }
    }

    /**
     * @param string $select_type
     */
    public static function unSetData()
    {
        self::$own_sql = false;
        self::$table = '';
        self::$select_cond = array();
        self::$select_operation = 'AND';
        self::$data_select = array();
        self::$update_cond = array();
        self::$update_value = array();
        self::$upload_info = array();
        self::$cond = array();
        self::$data_in = array();
        self::$limit = false;
        self::$order = false;
        self::$not_equal = false;
    }

    static function select__record( /*
         *
         * /// Requirements///
         * data_select
         * table
         * select_cond
         * select operation
         *
         */)
    {
//        "SELECT data(*) FROM table WHERE id=? (OR || AND) id=?"
        if (self::$own_sql != false) {
            $db = self::getInstance();
            $q = $db->prepare(self::$own_sql);
            $q->execute();
            return $q->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $sql = 'SELECT ';
            if (is_array(self::$data_select) && !empty(self::$data_select)) {
                $sql .= ' ' . join(',', self::$data_select) . '';
            } else {
                $sql .= ' * ';
            }

            if (is_array(self::$table)) {
                $sql .= ' FROM ' . join(',', self::$table);
            } else {
                $sql .= ' FROM ' . self::$table;
            }
            $c = array();
            if (is_array(self::$select_cond) && !empty(self::$select_cond)) {
                $r = array();

                foreach (self::$select_cond as $e => $v) {
                    if (is_array($v)) {
                        foreach ($v as $vals) {
                            if (substr($vals, 0, 4) === 'NOT:') {
                                $r[] = $e . '<>? ';
                                $c[] = substr($vals, 4);
                            } else if (substr($vals, 0, 5) === 'LIKE:') {
                                $r[] = $e . ' LIKE ?';
                                $c[] = substr($vals, 5);
                            } else if (substr($vals, 0, 8) === 'GREATER:') {
                                $r[] = $e . '>?';
                                $c[] = substr($vals, 8);
                            } else if (substr($vals, 0, 9) === 'GREATEQU:') {
                                $r[] = $e . '>= ?';
                                $c[] = substr($vals, 9);
                            } else if (substr($vals, 0, 5) === 'LESS:') {
                                $r[] = $e . '<?';
                                $c[] = substr($vals, 5);
                            } else if (substr($vals, 0, 7) === 'LESSEQ:') {
                                $r[] = $e . '<=?';
                                $c[] = substr($vals, 7);
                            } else {
                                $r[] = $e . '=?';
                                $c[] = $v;
                            }

                        }
                    } else {
                        if (substr($v, 0, 4) === 'NIN:') {
                            $h = substr($v, 4);

//                    $r = ;
                            $value = explode(',', $h);
                            $qu_A = array();
                            foreach ($value as $qu) {
                                $qu_A[] .= '?';
                                $c[] = $qu;
                            }
                            array_push($r, $e . ' NOT IN (' . join(',', $qu_A) . ') ');
                        } else if (substr($v, 0, 3) === 'IN:') {
                            $h = substr($v, 3);

//                    $r = ;
                            $value = explode(',', $h);
                            $qu_A = array();
                            foreach ($value as $qu) {
                                $qu_A[] .= '?';
                                $c[] = $qu;
                            }
                            array_push($r, $e . ' IN (' . join(',', $qu_A) . ') ');
                        } else if (substr($v, 0, 4) === 'NOT:') {
                            $r[] = $e . '<>?';
                            $c[] = substr($v, 4);
                        } else if (substr($v, 0, 5) === 'LIKE:') {
                            $r[] = $e . ' LIKE ?';
                            $c[] = substr($v, 5);
                        } else if (substr($v, 0, 8) === 'GREATER:') {
                            $r[] = $e . '>?';
                            $c[] = substr($v, 8);
                        } else if (substr($v, 0, 9) === 'GREATEQU:') {
                            $r[] = $e . '>= ?';
                            $c[] = substr($v, 9);
                        } else if (substr($v, 0, 5) === 'LESS:') {
                            $r[] = $e . '<?';
                            $c[] = substr($v, 5);
                        } else if (substr($v, 0, 7) === 'LESSEQ:') {
                            $r[] = $e . '<=?';
                            $c[] = substr($v, 7);
                        } else if (substr($v, 0, 4) === 'RMV:') {
                            $r[] = $e . ' ? ';
                            $c[] = substr($v, 4);
                        } else {
                            $r[] = $e . '=?';
                            $c[] = $v;
                        }
                    }
                }
                if (count($r) > 1) {
                    $link = join(' ' . self::$select_operation . ' ', $r);
                } else {
                    $link = join(',', $r);
                }
                $sql .= ' WHERE ' . $link;
            }

            if (self::$order != false) {
                $sql .= ' ORDER BY ' . self::$order;
            }
            if (self::$group != false) {
                $sql .= ' GROUP BY ' . self::$group;
            }
            if (self::$limit != false) {
                $sql .= ' LIMIT ' . self::$limit;
            }
            $db = self::getInstance();

            $query = $db->prepare($sql);
//        echo $sql;
//        print_r($c);
            if (!empty($c)) {
                $query->execute($c);
            } else {
                $query->execute();
            }
            return $query->fetchAll(\PDO::FETCH_ASSOC);

        }
    }

    static function UserIpAddress()
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        return $ip;
    }

    static function UploadFiles()
    {
        if (is_array(self::$file)) {
            $tmp = self::$file['tmp_name'];
            $name = self::$file['name'];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            if (getimagesize($tmp)) {
                $info = getimagesize($tmp);
                $h = $info[1];
                $w = $info[0];
                $mime = $info['mime'];
                if (in_array($mime, self::$accepted_files)) {
                    if ($w >= 720 && $h >= 220) {
                        $uploaded_name = self::$new_name . '_' . time() . '.' . $ext;
                        $upload_dir = self::$upload_dir . DS . $uploaded_name;
                        if (move_uploaded_file($tmp, $upload_dir)) {
                            self::$upload_info = array(
                                'error' => 0,
                                'file_name' => $uploaded_name,
                            );
                        } else {
                            //// Not copied ///
                            self::$upload_info = array(
                                'error' => 1,
                                'file_name' => 0,
                            );
                        }
                    } else {
                        //// - dim wrong -///
                        self::$upload_info = array(
                            'error' => 2,
                            'file_name' => 0,
                        );
                    }
                } else {
                    ///// -mime wrong -//
                    self::$upload_info = array(
                        'error' => 3,
                        'file_name' => 0,
                    );
                }
            } else {
                ///// - false -///
                self::$upload_info = array(
                    'error' => 4,
                    'file_name' => 0,
                );
            }
        } else {
            //// false ////
            self::$upload_info = array(
                'error' => 5,
                'file_name' => 0,
            );
        }
        return self::$upload_info;
    }

    static function EncData($data)
    {
        $key = 'MihtkalSuperDataEnc';
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($data, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
        return $ciphertext;
    }

    static function DeEncData($ciphertext)
    {
        $key = 'MihtkalSuperDataEnc';
        $c = base64_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
        {
            return $original_plaintext;
        } else {
            return $ciphertext;
        }
    }
}