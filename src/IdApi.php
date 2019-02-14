<?

namespace IdempierePhpCompositeApi;

class IdApi {

    private $json_request;
    private $array_request;
    private $xml_request;
    private $xml_response;
    private $raw_array_response;
    private $raw_json_response;
    private $array_response;
    private $json_response;


    public function __construct() {
        $this->request = '';
        $this->response = '';
    }

    public function get_json_request() {
        return $this->json_request;
    }

    public function get_json_response() {
        return $this->json_response;
    }

    public function get_array_request() {
        return $this->array_request;
    }

    public function get_array_response() {
        return $this->array_response;
    }

    public function get_raw_array_response() {
        return $this->raw_array_response;
    }

    public function get_raw_json_response() {
        return $this->raw_json_response;
    }

    public function get_xml_request() {
        return $this->xml_request;
    }

    public function get_xml_response() {
        return $this->xml_response;
    }

    public function make_request() {
        $this->build_request_footer();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,               $this->array_request['settings']['urlEndpoint']);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,    10);
        curl_setopt($ch, CURLOPT_TIMEOUT,           10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,    true );
        curl_setopt($ch, CURLOPT_POST,              true );
        curl_setopt($ch, CURLOPT_FRESH_CONNECT,     TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS,        $this->xml_request);
        $this->xml_response = curl_exec($ch);
        curl_close($ch);
    }

    public function parse_response() {
        $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $this->xml_response);
        $ob = simplexml_load_string($xml);
        $this->raw_json_response = json_encode($ob);
        $this->raw_array_response = json_decode($this->raw_json_response, true);
        $this->array_response = $this->reformat_array_response();
        $this->json_response = json_encode($this->array_response);
    }

    public function reformat_array_response() {
        $new_array = array();
        $summary_array = array();
        $formatted_array = $this->raw_array_response['soapBody']['ns1compositeOperationResponse']['CompositeResponses']['CompositeResponse'];
        foreach($formatted_array['StandardResponse'] as $key => $value) {
            if(isset($value['IsError'])) {
                $new_array['IsError'] = $value['IsError'];
                if(isset($value['IsRolledBack'])) {
                    $new_array['IsRolledBack'] = $value['IsRolledBack'];
                }
                if(isset($formatted_array['StandardResponse']['Error'])) {
                    $new_array['Error'] = $formatted_array['StandardResponse']['Error'];
                }
                break;
            } else {
                $new_array = $this->parse_serviceName($new_array, $key);

                $new_array = $this->parse_RecordID($new_array, $key, $value);

                if(isset($value['outputFields'])) {
                    foreach($value['outputFields'] as $value2) {
                        if(isset($value2['@attributes'])) {
                            if(isset($value2['@attributes']['value'])) {
                                $new_array[$key]['OutputFields'][$value2['@attributes']['column']] = $value2['@attributes']['value'];
                            } else {
                                $new_array[$key]['OutputFields'][$value2['@attributes']['column']] = 'NULL';
                            }
                        } else {
                            foreach($value2 as $value3) {
                                if(isset($value3['@attributes']['value'])) {
                                    $new_array[$key]['OutputFields'][$value3['@attributes']['column']] = $value3['@attributes']['value'];
                                } else {
                                    $new_array[$key]['OutputFields'][$value3['@attributes']['column']] = 'NULL';
                                }
                            }
                        }
                    }
                }

                if(isset($value['@attributes']['IsError'])) {
                    $new_array[$key]['IsError'] = $value['@attributes']['IsError'];
                }

                if(isset($value['@attributes']['IsRolledBack'])) {
                    $new_array[$key]['IsRolledBack'] = $value['@attributes']['IsRolledBack'];
                }

                if(isset($value['RunProcessResponse'])) {
                    $new_array[$key]['RunProcessResponse'] = $value['RunProcessResponse'];
                }

                if(isset($value['Error'])) {
                    $new_array[$key]['Error'] = $value['Error'];
                    $error = $this->array_request['call'][$key]['serviceName'] . " - " . $value['Error'];
                }
            }
        }
        if(isset($error)) {
            return array('Summary' => $this->get_response_summary($formatted_array), 'Response' => $new_array, 'Error' => $error);
        } else {
            return array('Summary' => $this->get_response_summary($formatted_array), 'Response' => $new_array);
        }
    }

    public function get_response_summary($formatted_array) {
        $summary_array = array();
        foreach($formatted_array['StandardResponse'] as $key => $value) {
            if(isset($this->array_request['call'][$key]['name']) && isset($value['@attributes']['RecordID'])) {
                if(isset($summary_array[$this->array_request['call'][$key]['name']])) {
                    if(is_array($summary_array[$this->array_request['call'][$key]['name']])) {
                        $summary_array[$this->array_request['call'][$key]['name']][] = $value['@attributes']['RecordID'];
                    } else {
                        $summary_array[$this->array_request['call'][$key]['name']] = array($summary_array[$this->array_request['call'][$key]['name']], $value['@attributes']['RecordID']);
                    }

                } else {
                    $summary_array[$this->array_request['call'][$key]['name']] = $value['@attributes']['RecordID'];
                }
            }
        }
        return $summary_array;
    }

    public function parse_serviceName($new_array, $key) {
        if(isset($this->array_request['call'][$key]['serviceName'])) {
            $new_array[$key]['serviceName'] = $this->array_request['call'][$key]['serviceName'];
        }
        return $new_array;
    }

    public function parse_RecordID($new_array, $key, $value) {
        if(isset($value['@attributes']['RecordID'])) {
            $new_array[$key]['RecordID'] = $value['@attributes']['RecordID'];
        }
        return $new_array;
    }

    public function validate_response() {
        return true;
    }

    public function build_request($request, $append = false) {

        if(!is_array($request)) {
            $this->json_request = $request;
            $this->array_request = json_decode($request, true);
        } else {
            $this->array_request = $request;
        }

        if($append == false) {
            $this->build_request_head();
        }
        $this->build_request_body();
    }

    public function build_request_head() {
        $this->xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:_0="http://idempiere.org/ADInterface/1_0"><soapenv:Header/>';
        $this->xml_request .= '<soapenv:Body>';
        $this->xml_request .= '<_0:compositeOperation>';
        $this->xml_request .= '<_0:CompositeRequest>';
        $this->xml_request .= '<_0:ADLoginRequest>';
        $this->xml_request .= '<_0:user>' .  $this->array_request['settings']['user'] . '</_0:user>';
        $this->xml_request .= '<_0:pass>' .  $this->array_request['settings']['password'] . '</_0:pass>';
        $this->xml_request .= '<_0:lang>' .  $this->array_request['settings']['language'] . '</_0:lang>';
        $this->xml_request .= '<_0:ClientID>' .  $this->array_request['settings']['clientId'] . '</_0:ClientID>';
        $this->xml_request .= '<_0:RoleID>' .  $this->array_request['settings']['roleId'] . '</_0:RoleID>';
        $this->xml_request .= '<_0:OrgID>' .  $this->array_request['settings']['orgId'] . '</_0:OrgID>';
        $this->xml_request .= '<_0:WarehouseID>' .  $this->array_request['settings']['warehouseId'] . '</_0:WarehouseID>';
        $this->xml_request .= '<_0:stage>' .  $this->array_request['settings']['stage'] . '</_0:stage>';
        $this->xml_request .= '</_0:ADLoginRequest>';
        $this->xml_request .= '<_0:serviceType>SyncOrder</_0:serviceType>';
        $this->xml_request .= '<_0:operations>';
    }

    public function build_request_body() {
        foreach($this->array_request['call'] as $request) {
            if($request['type'] == 'setDocAction') {
                $this->xml_request .= '<_0:operation preCommit="' . $request['preCommit'] . '" postCommit="' . $request['postCommit'] . '">';
                $this->xml_request .= '<_0:TargetPort>setDocAction</_0:TargetPort>';
                $this->xml_request .= '<_0:ModelSetDocAction>';
                $this->xml_request .= '<_0:serviceType>' . $request['serviceName'] . '</_0:serviceType>';
                $this->xml_request .= '<_0:tableName>' . $request['table'] . '</_0:tableName>';
                $this->xml_request .= '<_0:recordID>' . '0' . '</_0:recordID>';
                $this->xml_request .= '<_0:recordIDVariable>@' . $request['table'] . "." . $request['idColumn'] . '</_0:recordIDVariable>';
                $this->xml_request .= '<_0:docAction>' . $request['action'] . '</_0:docAction>';
                $this->xml_request .= '</_0:ModelSetDocAction>';
                $this->xml_request .= '</_0:operation>';
            } elseif($request['type'] == 'runProcess') {
                $this->xml_request .= '<_0:operation preCommit="' . $request['preCommit'] . '" postCommit="' . $request['postCommit'] . '">';
                $this->xml_request .= '<_0:TargetPort>runProcess</_0:TargetPort>';
                $this->xml_request .= '<_0:ModelRunProcess>';
                $this->xml_request .= '<_0:serviceType>' . $request['serviceName'] . '</_0:serviceType>';
                $this->xml_request .= '<_0:ParamValues>';
                foreach($request['values'] as $key => $value) {
                    if($key == 'lookup') {
                        foreach($value as $lookup_req) {
                            $this->xml_request .= '<_0:field column="' . $lookup_req['id'] . '" lval="' . $lookup_req['value'] . '"/>';
                        }
                    } else {
                        $this->xml_request .= '<_0:field column="' . $key . '">';
                        $this->xml_request .= '<_0:val>' . $value . '</_0:val>';
                        $this->xml_request .= '</_0:field>';
                    }
                }
                $this->xml_request .= '</_0:ParamValues>';
                $this->xml_request .= '</_0:ModelRunProcess>';
                $this->xml_request .= '</_0:operation>';
            } else {
                $this->xml_request .= '<_0:operation preCommit="' . $request['preCommit'] . '" postCommit="' . $request['postCommit'] . '">';
                $this->xml_request .= '<_0:TargetPort>' . $request['type'] . '</_0:TargetPort>';
                $this->xml_request .= '<_0:ModelCRUD>';
                $this->xml_request .= '<_0:serviceType>' . $request['serviceName'] . '</_0:serviceType>';
                $this->xml_request .= '<_0:TableName>' . $request['table'] . '</_0:TableName>';
                $this->xml_request .= '<_0:RecordID>0</_0:RecordID>';
                $this->xml_request .= '<_0:Action>' . $request['action'] . '</_0:Action>';
                $this->xml_request .= '<_0:DataRow>';
                foreach($request['values'] as $key => $value) {
                    if($key == 'lookup') {
                        foreach($value as $lookup_req) {
                            $this->xml_request .= '<_0:field column="' . $lookup_req['id'] . '" lval="' . $lookup_req['value'] . '"/>';
                        }
                    } else {
                        $this->xml_request .= '<_0:field column="' . $key . '">';
                        $this->xml_request .= '<_0:val>' . $value . '</_0:val>';
                        $this->xml_request .= '</_0:field>';
                    }
                }
                $this->xml_request .= '</_0:DataRow>';
                $this->xml_request .= '</_0:ModelCRUD>';
                $this->xml_request .= '</_0:operation>';
            }
        }
    }

    public function build_request_footer() {
        $this->xml_request .= '</_0:operations>';
        $this->xml_request .= '</_0:CompositeRequest>';
        $this->xml_request .= '</_0:compositeOperation>';
        $this->xml_request .= '</soapenv:Body>';
        $this->xml_request .= '</soapenv:Envelope>';
    }
}