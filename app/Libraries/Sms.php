<?php
namespace  App\Libraries;

class Sms {

    public static function send_sms_yamamah($phone,$code)
    {

        $url = 'http://api.yamamah.com/SendSMS';
        $fields = array(
            "Username"             => "0533336567",
            "Password"             => "Thamer12345",
            "Message"              => __('auth.sms') . $code,
            "RecepientNumber"      => (new self)->setPhone($phone),
            "ReplacementList"      => "",
            "SendDateTime"         => "0",
            "EnableDR"             => False,
            "Tagname"              => "BASMATII",
            "VariableList"         => "0"
        );

        $fields_string             = json_encode($fields);
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_POST           => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER     => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS     => $fields_string
        ));
        $result                    = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

     public function setPhone($phone){
        if(is_array($phone)){
            return implode(";", $this->phoneFormat($phone));
        }else{
            return '966' . ltrim($phone, '0');
        }
    }

    function phoneFormat($phones) {
        return array_map(function($val) { return '966' . ltrim($val, '0') ; }, $phones);
    }

}
