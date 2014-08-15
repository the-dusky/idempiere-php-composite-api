<?

    namespace IdempierePHPCompositeAPI;

    class IDAPI {

        private $request;
        private $response;
        private $request_params;

        public function __construct() {
            $this->request = '';
            $this->response = '';
        }

        public function test() {
            echo "IT WORKS";
        }

        public function get_request() {
            return $this->request;
        }

        public function get_response() {
            return $this->response;
        }

        public function request() {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,               $this->request_params['settings']['urlEndpoint']);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,    10);
            curl_setopt($ch, CURLOPT_TIMEOUT,           10);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,    true );
            curl_setopt($ch, CURLOPT_POST,              true );
            curl_setopt($ch, CURLOPT_FRESH_CONNECT,     TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS,        $this->request);
            $this->response = curl_exec($ch);
            curl_close($ch);
        }

        public function build_request($request_params) {

            if(!is_array($request_params)) {
                $request_params = json_decode($request_params, true);
            }

            $this->request_params = $request_params;

            $this->set_request_params_settings_defaults();

            $this->build_request_head();

            $this->build_request_body();

            $this->build_request_footer();
        }

        public function build_request_head() {
            $this->request .= '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:_0="http://idempiere.org/ADInterface/1_0"><soapenv:Header/>';
                $this->request .= '<soapenv:Body>';
                    $this->request .= '<_0:compositeOperation>';
                        $this->request .= '<_0:CompositeRequest>';
                            $this->request .= '<_0:ADLoginRequest>';
                                    $this->request .= '<_0:user>' .  $this->request_params['settings']['user'] . '</_0:user>';
                                    $this->request .= '<_0:pass>' .  $this->request_params['settings']['password'] . '</_0:pass>';
                                    $this->request .= '<_0:lang>' .  $this->request_params['settings']['language'] . '</_0:lang>';
                                    $this->request .= '<_0:ClientID>' .  $this->request_params['settings']['client'] . '</_0:ClientID>';
                                    $this->request .= '<_0:RoleID>' .  $this->request_params['settings']['roleId'] . '</_0:RoleID>';
                                    $this->request .= '<_0:OrgID>' .  $this->request_params['settings']['orgId'] . '</_0:OrgID>';
                                    $this->request .= '<_0:WarehouseID>' .  $this->request_params['settings']['warehouseId'] . '</_0:WarehouseID>';
                                    $this->request .= '<_0:stage>' .  $this->request_params['settings']['stage'] . '</_0:stage>';
                            $this->request .= '</_0:ADLoginRequest>';
                            $this->request .= '<_0:serviceType>SyncOrder</_0:serviceType>';
                            $this->request .= '<_0:operations>';
        }

        public function build_request_body() {
            foreach($this->request_params['call'] as $request) {
                if($request['type'] == 'createUpdateData'){
                    $this->request .= '<_0:operation preCommit="' . $request['preCommit'] . '" postCommit="' . $request['posCommit'] . '">';
                        $this->request .= '<_0:TargetPort>createUpdateData</_0:TargetPort>';
                        $this->request .= '<_0:ModelCRUD>';
                            $this->request .= '<_0:serviceType>' . $request['serviceName'] . '</_0:serviceType>';
                            $this->request .= '<_0:TableName>' . $request['table'] . '</_0:TableName>';
                            $this->request .= '<_0:RecordID>0</_0:RecordID>';
                            $this->request .= '<_0:Action>CreateUpdate</_0:Action>';
                            $this->request .= '<_0:DataRow>';
                                foreach($request['params'] as $key => $value) {
                                    if($key == 'lookup') {
                                        foreach($value as $lookup_req) {
                                            $this->request .= '<_0:field column="' . $lookup_req['id'] . '" lval="' . $lookup_req['value'] . '"/>';
                                        }
                                    } else {
                                        $this->request .= '<_0:field column="' . $key . '">';
                                            $this->request .= '<_0:val>' . $value . '</_0:val>';
                                        $this->request .= '</_0:field>';
                                    }
                                }
                            $this->request .= '</_0:DataRow>';
                        $this->request .= '</_0:ModelCRUD>';
                    $this->request .= '</_0:operation>';
                } elseif($request['type'] == 'setDocAction') {
                    $this->request .= '<_0:operation preCommit="' . $request['preCommit'] . '" postCommit="' . $request['postCommit'] . '">';
                        $this->request .= '<_0:TargetPort>setDocAction</_0:TargetPort>';
                        $this->request .= '<_0:ModelSetDocAction>';
                            $this->request .= '<_0:serviceType>' . $request['service_name'] . '</_0:serviceType>';
                            $this->request .= '<_0:tableName>' . $request['table'] . '</_0:tableName>';
                            $this->request .= '<_0:recordID>' . '0' . '</_0:recordID>';
                            $this->request .= '<_0:recordIDVariable>@' . $request['id_column'] . '</_0:recordIDVariable>';
                            $this->request .= '<_0:docAction>' . $request['action'] . '</_0:docAction>';
                        $this->request .= '</_0:ModelSetDocAction>';
                    $this->request .= '</_0:operation>';
                }
            }
        }

        public function build_request_footer() {
                            $this->request .= '</_0:operations>';
                        $this->request .= '</_0:CompositeRequest>';
                    $this->request .= '</_0:compositeOperation>';
                $this->request .= '</soapenv:Body>';
            $this->request .= '</soapenv:Envelope>';
        }
    }