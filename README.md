idempiere-php-composite-api
=====================

A php wrapper for the composite api in Idempiere

request_params can be sent in as json or an associative php array.

To install use composer:

```shell
composer require the-dusky/idempiere-php-composite-api

composer

```

Make Call:

```PHP
    use  IdempierePhpCompositeApi\IdApi;

    $IdApi = new IdApi();

    $IdApi->build_request($json_or_array);

    $IdApi->build_request($additional_json_or_array, true);

    $IdApi->make_request();

    $IdApi->parse_response();

```

Available Properties:

```PHP

    //JSON

        $json_request = $IdApi->get_json_request();

        $raw_json_response = $IdApi->get_raw_json_response();

        $parsed_json_response = $IdApi->get_json_response();

    //ARRAY

        $array_request = $IdApi->get_array_request();

        $raw_array_response = $IdApi->get_raw_array_response();

        $parsed_array_response = $IdApi->get_array_response();

    //XML

        $xml_soap_request = $IdApi->get_xml_request();

        $xml_soap_response = $IdApi->get_xml_response();

```

example json:

```JSON
{
   "settings":{
      "urlEndpoint":"**ENDPOINT**",
      "user":"**USERNAME**",
      "password":"**PASSWORD**",
      "language":"en_US",
      "clientId":"11",
      "roleId":"50004",
      "orgId":"11",
      "warehouseId":"103",
      "stage":"9"
   },
   "call":[
      {
         "type":"createUpdateData",
         "preCommit":"false",
         "postCommit":"false",
         "serviceName":"CreateBPartner1_0",
         "table":"c_bpartner",
         "action":"CreateUpdate",
         "values":{
            "Name":"Joe Schmoe",
            "email":"joe@schmoe.com",
            "TaxID":"",
            "IsVendor":"N",
            "IsCustomer":"Y",
            "IsTaxExempt":"N",
            "C_BP_Group_ID":"104"
         }
      },
      {
         "type":"createUpdateData",
         "preCommit":"false",
         "postCommit":"false",
         "serviceName":"CreateUpdateLocation",
         "table":"C_Location",
         "action":"CreateUpdate",
         "values":{
            "Address1":"100 Some Street",
            "Address2":"1B",
            "City":"Brooklyn",
            "lookup":[
               {
                  "id":"C_Region_ID",
                  "value":"NY"
               },
               {
                  "id":"C_Country_ID",
                  "value":"United States"
               }
            ],
            "Postal":"11211"
         }
      },
      {
         "type":"createUpdateData",
         "preCommit":"false",
         "postCommit":"false",
         "serviceName":"CreateUpdateBPLocation",
         "table":"C_BPartner_Location",
         "action":"CreateUpdate",
         "values":{
            "C_BPartner_ID":"@C_BPartner.C_BPartner_ID",
            "C_Location_ID":"@C_Location.C_Location_ID",
            "IsShipTo":"Y",
            "IsBillTo":"Y"
         }
      },
      {
         "type":"createUpdateData",
         "preCommit":"true",
         "postCommit":"false",
         "serviceName":"CreateUpdateUser",
         "table":"AD_User",
         "action":"CreateUpdate",
         "values":{
            "Name":"Joe Schmoe",
            "C_BPartner_ID":"@C_BPartner.C_BPartner_ID",
            "EMail":"joe@schmoe.com",
            "C_BPartner_Location_ID":"@C_BPartner_Location.C_BPartner_Location_ID"
         }
      },
      {
         "type":"createUpdateData",
         "preCommit":"false",
         "postCommit":"false",
         "serviceName":"CreateOrderRecord",
         "table":"C_Order",
         "action":"CreateUpdate",
         "values":{
            "M_Warehouse_ID":"1000001",
            "AD_User_ID":"@AD_User.AD_User_ID",
            "C_BPartner_ID":"@C_BPartner.C_BPartner_ID",
            "C_DocTypeTarget_ID":"132",
            "FreightCostRule":"I",
            "DocumentNo":"50000000"
         }
      },
      {
         "type":"createUpdateData",
         "preCommit":"false",
         "postCommit":"false",
         "serviceName":"CreateOrderRecord",
         "table":"C_Order",
         "action":"CreateUpdate",
         "values":{
            "DocumentNo":"50000000",
            "M_PriceList_ID":"100"
         }
      },
      {
         "type":"createUpdateData",
         "preCommit":"false",
         "postCommit":"false",
         "serviceName":"CreateOrderLine",
         "table":"C_OrderLine",
         "action":"CreateUpdate",
         "values":{
            "AD_Org_ID":"11",
            "AD_Client_ID":"11",
            "C_Order_ID":"@C_Order.C_Order_ID",
            "QtyEntered":"1",
            "QtyOrdered":"1",
            "Line":"10",
            "PriceEntered":"108",
            "PriceActual":"108",
            "lookup":[
               {
                  "id":"M_Product_ID",
                  "value":"1000015"
               }
            ]
         }
      },
      {
         "type":"createUpdateData",
         "preCommit":"false",
         "postCommit":"false",
         "serviceName":"CreateOrderLine",
         "table":"C_OrderLine",
         "action":"CreateUpdate",
         "values":{
            "AD_Org_ID":"11",
            "AD_Client_ID":"11",
            "C_Order_ID":"@C_Order.C_Order_ID",
            "QtyEntered":"1",
            "QtyOrdered":"1",
            "Line":"20",
            "PriceEntered":"42.13",
            "PriceActual":"42.13",
            "lookup":[
               {
                  "id":"M_Product_ID",
                  "value":"1000016"
               }
            ]
         }
      },
      {
         "type":"setDocAction",
         "preCommit":"true",
         "postCommit":"true",
         "serviceName":"UpdateOrderStatus",
         "table":"C_Order",
         "idColumn":"C_Order_ID",
         "action":"CO"
      }
   ]
}
```

```xml
<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:_0="http://idempiere.org/ADInterface/1_0">
   <soapenv:Header />
   <soapenv:Body>
      <_0:compositeOperation>
         <_0:CompositeRequest>
            <_0:ADLoginRequest>
               <_0:user>**USERNAME**</_0:user>
               <_0:pass>**PASSWORD**</_0:pass>
               <_0:lang>en_US</_0:lang>
               <_0:ClientID>11</_0:ClientID>
               <_0:RoleID>50004</_0:RoleID>
               <_0:OrgID>11</_0:OrgID>
               <_0:WarehouseID>103</_0:WarehouseID>
               <_0:stage>9</_0:stage>
            </_0:ADLoginRequest>
            <_0:serviceType>SyncOrder</_0:serviceType>
            <_0:operations>
               <_0:operation preCommit="false" postCommit="false">
                  <_0:TargetPort>createUpdateData</_0:TargetPort>
                  <_0:ModelCRUD>
                     <_0:serviceType>CreateBPartner1_0</_0:serviceType>
                     <_0:TableName>c_bpartner</_0:TableName>
                     <_0:RecordID>0</_0:RecordID>
                     <_0:Action>CreateUpdate</_0:Action>
                     <_0:DataRow>
                        <_0:field column="Name">
                           <_0:val>Joe Schmoe</_0:val>
                        </_0:field>
                        <_0:field column="email">
                           <_0:val>joe@schmoe.com</_0:val>
                        </_0:field>
                        <_0:field column="TaxID">
                           <_0:val />
                        </_0:field>
                        <_0:field column="IsVendor">
                           <_0:val>N</_0:val>
                        </_0:field>
                        <_0:field column="IsCustomer">
                           <_0:val>Y</_0:val>
                        </_0:field>
                        <_0:field column="IsTaxExempt">
                           <_0:val>N</_0:val>
                        </_0:field>
                        <_0:field column="C_BP_Group_ID">
                           <_0:val>104</_0:val>
                        </_0:field>
                     </_0:DataRow>
                  </_0:ModelCRUD>
               </_0:operation>
               <_0:operation preCommit="false" postCommit="false">
                  <_0:TargetPort>createUpdateData</_0:TargetPort>
                  <_0:ModelCRUD>
                     <_0:serviceType>CreateUpdateLocation</_0:serviceType>
                     <_0:TableName>C_Location</_0:TableName>
                     <_0:RecordID>0</_0:RecordID>
                     <_0:Action>CreateUpdate</_0:Action>
                     <_0:DataRow>
                        <_0:field column="Address1">
                           <_0:val>Some Street</_0:val>
                        </_0:field>
                        <_0:field column="Address2">
                           <_0:val>1B</_0:val>
                        </_0:field>
                        <_0:field column="City">
                           <_0:val>Brooklyn</_0:val>
                        </_0:field>
                        <_0:field column="C_Region_ID" lval="NY" />
                        <_0:field column="C_Country_ID" lval="United States" />
                        <_0:field column="Postal">
                           <_0:val>11211</_0:val>
                        </_0:field>
                     </_0:DataRow>
                  </_0:ModelCRUD>
               </_0:operation>
               <_0:operation preCommit="false" postCommit="false">
                  <_0:TargetPort>createUpdateData</_0:TargetPort>
                  <_0:ModelCRUD>
                     <_0:serviceType>CreateUpdateBPLocation</_0:serviceType>
                     <_0:TableName>C_BPartner_Location</_0:TableName>
                     <_0:RecordID>0</_0:RecordID>
                     <_0:Action>CreateUpdate</_0:Action>
                     <_0:DataRow>
                        <_0:field column="C_BPartner_ID">
                           <_0:val>@C_BPartner.C_BPartner_ID</_0:val>
                        </_0:field>
                        <_0:field column="C_Location_ID">
                           <_0:val>@C_Location.C_Location_ID</_0:val>
                        </_0:field>
                        <_0:field column="IsShipTo">
                           <_0:val>Y</_0:val>
                        </_0:field>
                        <_0:field column="IsBillTo">
                           <_0:val>Y</_0:val>
                        </_0:field>
                     </_0:DataRow>
                  </_0:ModelCRUD>
               </_0:operation>
               <_0:operation preCommit="true" postCommit="false">
                  <_0:TargetPort>createUpdateData</_0:TargetPort>
                  <_0:ModelCRUD>
                     <_0:serviceType>CreateUpdateUser</_0:serviceType>
                     <_0:TableName>AD_User</_0:TableName>
                     <_0:RecordID>0</_0:RecordID>
                     <_0:Action>CreateUpdate</_0:Action>
                     <_0:DataRow>
                        <_0:field column="Name">
                           <_0:val>Joe Schmoe</_0:val>
                        </_0:field>
                        <_0:field column="C_BPartner_ID">
                           <_0:val>@C_BPartner.C_BPartner_ID</_0:val>
                        </_0:field>
                        <_0:field column="EMail">
                           <_0:val>joe@schmoe.com</_0:val>
                        </_0:field>
                        <_0:field column="C_BPartner_Location_ID">
                           <_0:val>@C_BPartner_Location.C_BPartner_Location_ID</_0:val>
                        </_0:field>
                     </_0:DataRow>
                  </_0:ModelCRUD>
               </_0:operation>
               <_0:operation preCommit="false" postCommit="false">
                  <_0:TargetPort>createUpdateData</_0:TargetPort>
                  <_0:ModelCRUD>
                     <_0:serviceType>CreateOrderRecord</_0:serviceType>
                     <_0:TableName>C_Order</_0:TableName>
                     <_0:RecordID>0</_0:RecordID>
                     <_0:Action>CreateUpdate</_0:Action>
                     <_0:DataRow>
                        <_0:field column="M_Warehouse_ID">
                           <_0:val>1000001</_0:val>
                        </_0:field>
                        <_0:field column="AD_User_ID">
                           <_0:val>@AD_User.AD_User_ID</_0:val>
                        </_0:field>
                        <_0:field column="C_BPartner_ID">
                           <_0:val>@C_BPartner.C_BPartner_ID</_0:val>
                        </_0:field>
                        <_0:field column="C_DocTypeTarget_ID">
                           <_0:val>132</_0:val>
                        </_0:field>
                        <_0:field column="FreightCostRule">
                           <_0:val>I</_0:val>
                        </_0:field>
                        <_0:field column="DocumentNo">
                           <_0:val>5000000</_0:val>
                        </_0:field>
                     </_0:DataRow>
                  </_0:ModelCRUD>
               </_0:operation>
               <_0:operation preCommit="false" postCommit="false">
                  <_0:TargetPort>createUpdateData</_0:TargetPort>
                  <_0:ModelCRUD>
                     <_0:serviceType>CreateOrderRecord</_0:serviceType>
                     <_0:TableName>C_Order</_0:TableName>
                     <_0:RecordID>0</_0:RecordID>
                     <_0:Action>CreateUpdate</_0:Action>
                     <_0:DataRow>
                        <_0:field column="DocumentNo">
                           <_0:val>5000000</_0:val>
                        </_0:field>
                        <_0:field column="M_PriceList_ID">
                           <_0:val>100</_0:val>
                        </_0:field>
                     </_0:DataRow>
                  </_0:ModelCRUD>
               </_0:operation>
               <_0:operation preCommit="false" postCommit="false">
                  <_0:TargetPort>createUpdateData</_0:TargetPort>
                  <_0:ModelCRUD>
                     <_0:serviceType>CreateOrderLine</_0:serviceType>
                     <_0:TableName>C_OrderLine</_0:TableName>
                     <_0:RecordID>0</_0:RecordID>
                     <_0:Action>CreateUpdate</_0:Action>
                     <_0:DataRow>
                        <_0:field column="AD_Org_ID">
                           <_0:val>11</_0:val>
                        </_0:field>
                        <_0:field column="AD_Client_ID">
                           <_0:val>11</_0:val>
                        </_0:field>
                        <_0:field column="C_Order_ID">
                           <_0:val>@C_Order.C_Order_ID</_0:val>
                        </_0:field>
                        <_0:field column="QtyEntered">
                           <_0:val>1</_0:val>
                        </_0:field>
                        <_0:field column="QtyOrdered">
                           <_0:val>1</_0:val>
                        </_0:field>
                        <_0:field column="Line">
                           <_0:val>10</_0:val>
                        </_0:field>
                        <_0:field column="PriceEntered">
                           <_0:val>108</_0:val>
                        </_0:field>
                        <_0:field column="PriceActual">
                           <_0:val>108</_0:val>
                        </_0:field>
                        <_0:field column="M_Product_ID" lval="1000015" />
                     </_0:DataRow>
                  </_0:ModelCRUD>
               </_0:operation>
               <_0:operation preCommit="false" postCommit="false">
                  <_0:TargetPort>createUpdateData</_0:TargetPort>
                  <_0:ModelCRUD>
                     <_0:serviceType>CreateOrderLine</_0:serviceType>
                     <_0:TableName>C_OrderLine</_0:TableName>
                     <_0:RecordID>0</_0:RecordID>
                     <_0:Action>CreateUpdate</_0:Action>
                     <_0:DataRow>
                        <_0:field column="AD_Org_ID">
                           <_0:val>11</_0:val>
                        </_0:field>
                        <_0:field column="AD_Client_ID">
                           <_0:val>11</_0:val>
                        </_0:field>
                        <_0:field column="C_Order_ID">
                           <_0:val>@C_Order.C_Order_ID</_0:val>
                        </_0:field>
                        <_0:field column="QtyEntered">
                           <_0:val>1</_0:val>
                        </_0:field>
                        <_0:field column="QtyOrdered">
                           <_0:val>1</_0:val>
                        </_0:field>
                        <_0:field column="Line">
                           <_0:val>20</_0:val>
                        </_0:field>
                        <_0:field column="PriceEntered">
                           <_0:val>42.13</_0:val>
                        </_0:field>
                        <_0:field column="PriceActual">
                           <_0:val>42.13</_0:val>
                        </_0:field>
                        <_0:field column="M_Product_ID" lval="1000016" />
                     </_0:DataRow>
                  </_0:ModelCRUD>
               </_0:operation>
               <_0:operation preCommit="true" postCommit="true">
                  <_0:TargetPort>setDocAction</_0:TargetPort>
                  <_0:ModelSetDocAction>
                     <_0:serviceType>UpdateOrderStatus</_0:serviceType>
                     <_0:tableName>C_Order</_0:tableName>
                     <_0:recordID>0</_0:recordID>
                     <_0:recordIDVariable>@C_Order.C_Order_ID</_0:recordIDVariable>
                     <_0:docAction>CO</_0:docAction>
                  </_0:ModelSetDocAction>
               </_0:operation>
               <_0:operation preCommit="false" postCommit="true">
                  <_0:TargetPort>runProcess</_0:TargetPort>
                  <_0:ModelRunProcess>
                     <_0:serviceType>GenerateInvoice</_0:serviceType>
                     <_0:ParamValues>
                        <_0:field column="AD_Org_ID">
                           <_0:val>11</_0:val>
                        </_0:field>
                        <_0:field column="C_Order_ID">
                           <_0:val>@C_Order.C_Order_ID</_0:val>
                        </_0:field>
                        <_0:field column="DocAction">
                           <_0:val>CO</_0:val>
                        </_0:field>
                     </_0:ParamValues>
                  </_0:ModelRunProcess>
               </_0:operation>
            </_0:operations>
         </_0:CompositeRequest>
      </_0:compositeOperation>
   </soapenv:Body>
</soapenv:Envelope>
```