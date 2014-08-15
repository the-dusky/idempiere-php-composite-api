IdempierePHPWebServiceWrapper
==============================

A php wrapper for the composite api in Idempiere

request_params can be sent in as json or an associative php array.

To install use composer

To use:

```php
use idempiere-php-ws-wrapper\IdApi.php

IdApi::build_request($json);

$response = IdApi::request();

$response = json_decode($response, true);
```

example json:

```json
{
    "params" : {
        "urlEndpoint" : "",
        "user" : "**Username**",
        "password" : "**Password**",
        "language" : "en_US",
        "clientId" : "11",
        "roleId" : "50004",
        "orgId" : "11",
        "warehouseId" : "103",
        "stage" : "9"
    },
    "call" : [
        {
            "type" : "createUpdateData",
            "preCommit" : "false",
            "postCommit" : "false",
            "serviceName" : "createBPartner1_0",
            "table" : "c_bpartner",
            "action" : "CreateUpdate",
            "values" : {
                "Name" : "Nicholas Miede",
                "email" : "nickmiede@gmail.com",
                "TaxID" : "",
                "IsVendor" : "N",
                "IsCustomer" : "Y",
                "IsTaxExempt" : "N",
                "C_BP_Group_ID" : "104",
                "PO_PriceList_ID" : "101"
            }
        },
        {
            "type" : "createUpdateData",
            "preCommit" : "true",
            "postCommit" : "false",
            "serviceName" : "CreateUpdateUser",
            "table" : "AD_User",
            "action" : "CreateUpdate",
            "values" : {
                "Name" : "Nicholas Miede",
                "Email" : "nickmiede@gmail.com",
                "C_BPartner_ID" : "@C_BPartner.C_BPartner_ID",
                "Phone" : ""
            }
        },
        {
            "type" : "createUpdateData",
            "preCommit" : "false",
            "postCommit" : "false",
            "serviceName" : "CreateUpdateLocation",
            "table" : "C_Location",
            "action" : "CreateUpdate",
            "values" : {
                "Address1" : "3 Rimrock",
                "Address2" : "",
                "lookup" : [
                    {
                        "id" : "C_Region_ID",
                        "value" : "CA"
                    },
                    {
                        "id" : "C_Country_ID",
                         "value" : "United States"
                    }
                ],
                "RegionName" : "CA",
                "Postal" : "92603-3604",
                "City" : "Irvine"
            }
        }
        {
            "type" : "setDocAction",
            "preCommit" : "",
            "postCommit" : "",
            "serviceName" : "",
            "table" : "",
            "values" : {
                "idColumn" : "Y",
                "action" : "CO"
            }
        }
    ]
}
```

```XML
<soapenv:Body>
                <_0:compositeOperation>
                    <_0:CompositeRequest>
                        <_0:ADLoginRequest>
                            <_0:user>WebService</_0:user>
                            <_0:pass>2Four6Eight10</_0:pass>
                            <_0:lang>en_US</_0:lang>
                            <_0:ClientID>11</_0:ClientID>
                            <_0:RoleID>50004</_0:RoleID>
                            <_0:OrgID>11</_0:OrgID>
                            <_0:WarehouseID>103</_0:WarehouseID>
                            <_0:stage>9</_0:stage>
                        </_0:ADLoginRequest>
                        <_0:serviceType>SyncOrder</_0:serviceType>
                        <_0:operations>
                            <_0:operation>
                                <_0:TargetPort>createUpdateData</_0:TargetPort>
                                <_0:ModelCRUD>
                                    <_0:serviceType>CreateBPartner1_0</_0:serviceType>
                                    <_0:TableName>C_BPartner</_0:TableName>
                                    <_0:RecordID>0</_0:RecordID>
                                    <_0:Action>CreateUpdate</_0:Action>
                                    <_0:DataRow>
                                        <_0:field column="Name">
                                        <_0:val>Nicholas Miede</_0:val>
                                        </_0:field>
                                        <_0:field column="email">
                                        <_0:val>nickmiede@gmail.com</_0:val>
                                        </_0:field>
                                        <_0:field column="TaxID">
                                        <_0:val></_0:val>
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
                                        <_0:field column="PO_PriceList_ID">
                                        <_0:val>101</_0:val>
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
                                        <_0:val>Nicholas Miede</_0:val>
                                        </_0:field>
                                        <_0:field column="EMail">
                                        <_0:val>nickmiede@gmail.com</_0:val>
                                        </_0:field>
                                        <_0:field column="C_BPartner_ID">
                                        <_0:val>@C_BPartner.C_BPartner_ID</_0:val>
                                        </_0:field>
                                        <_0:field column="Phone">
                                        <_0:val></_0:val>
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
                                        <_0:field column="C_Country_ID" lval="United States"/>
                                        <_0:field column="Address1">
                                        <_0:val>3 Rimrock</_0:val>
                                        </_0:field>
                                        <_0:field column="Address2">
                                        <_0:val></_0:val>
                                        </_0:field>
                                        <_0:field column="C_Region_ID" lval="CA"/>
                                        <_0:field column="RegionName">
                                        <_0:val>CA</_0:val>
                                        </_0:field>
                                        <_0:field column="Postal">
                                        <_0:val>92603-3604</_0:val>
                                        </_0:field>
                                        <_0:field column="City">
                                        <_0:val>Irvine</_0:val>
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
                            <_0:operation preCommit="false" postCommit="false">
                                <_0:TargetPort>createUpdateData</_0:TargetPort>
                                <_0:ModelCRUD>
                                    <_0:serviceType>CreateUpdateUser</_0:serviceType>
                                    <_0:TableName>AD_User</_0:TableName>
                                    <_0:RecordID>0</_0:RecordID>
                                    <_0:Action>CreateUpdate</_0:Action>
                                    <_0:DataRow>
                                        <_0:field column="C_BPartner_ID">
                                        <_0:val>@C_BPartner.C_BPartner_ID</_0:val>
                                        </_0:field>
                                        <_0:field column="EMail">
                                        <_0:val>nickmiede@gmail.com</_0:val>
                                        </_0:field>
                                        <_0:field column="C_BPartner_Location_ID">
                                        <_0:val>@C_BPartner_Location.C_BPartner_Location_ID</_0:val>
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
                                        <_0:val>Nicholas Miede</_0:val>
                                        </_0:field>
                                        <_0:field column="EMail">
                                        <_0:val>nickmiede@gmail.com</_0:val>
                                        </_0:field>
                                        <_0:field column="C_BPartner_ID">
                                        <_0:val>@C_BPartner.C_BPartner_ID</_0:val>
                                        </_0:field>
                                        <_0:field column="Phone">
                                        <_0:val></_0:val>
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
                                        <_0:field column="C_Country_ID" lval="United States"/>
                                        <_0:field column="Address1">
                                            <_0:val>3 Rimrock</_0:val>
                                        </_0:field>
                                        <_0:field column="Address2">
                                            <_0:val></_0:val>
                                        </_0:field>
                                        <_0:field column="C_Region_ID" lval="CA"/>
                                        <_0:field column="RegionName">
                                        <_0:val>CA</_0:val>
                                        </_0:field>
                                        <_0:field column="Postal">
                                        <_0:val>92603-3604</_0:val>
                                        </_0:field>
                                        <_0:field column="City">
                                        <_0:val>Irvine</_0:val>
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
                                    </_0:DataRow>
                                </_0:ModelCRUD>
                            </_0:operation>
                            <_0:operation preCommit="false" postCommit="false">
                                <_0:TargetPort>createUpdateData</_0:TargetPort>
                                <_0:ModelCRUD>
                                    <_0:serviceType>CreateUpdateUser</_0:serviceType>
                                    <_0:TableName>AD_User</_0:TableName>
                                    <_0:RecordID>0</_0:RecordID>
                                    <_0:Action>CreateUpdate</_0:Action>
                                    <_0:DataRow>
                                        <_0:field column="C_BPartner_ID">
                                        <_0:val>@C_BPartner.C_BPartner_ID</_0:val>
                                        </_0:field>
                                        <_0:field column="EMail">
                                        <_0:val>nickmiede@gmail.com</_0:val>
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
                                    <_0:serviceType>createOrderRecord</_0:serviceType>
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
                                        <_0:field column="DocumentNo">
                                        <_0:val>shopify_296385413</_0:val>
                                        </_0:field>
                                        <_0:field column="C_DocTypeTarget_ID">
                                        <_0:val>132</_0:val>
                                        </_0:field>
                                        <_0:field column="FreightCostRule">
                                        <_0:val>I</_0:val>
                                        </_0:field>
                                        <_0:field column="M_PriceList_ID" lval="Retail"/>
                                    </_0:DataRow>
                                </_0:ModelCRUD>
                            </_0:operation><_0:operation preCommit="false" postCommit="false">
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
                                            <_0:field column="M_Product_ID" lval="THS-331"/>
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
                                            <_0:val>15.00</_0:val>
                                            </_0:field>
                                            <_0:field column="PriceActual">
                                            <_0:val>15.00</_0:val>
                                            </_0:field>
                                        </_0:DataRow>
                                    </_0:ModelCRUD>
                                </_0:operation><_0:operation preCommit="false" postCommit="false">
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
                                            <_0:field column="M_Product_ID" lval="THS-549"/>
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
                                            <_0:val>30.00</_0:val>
                                            </_0:field>
                                            <_0:field column="PriceActual">
                                            <_0:val>30.00</_0:val>
                                            </_0:field>
                                        </_0:DataRow>
                                    </_0:ModelCRUD>
                                </_0:operation><_0:operation preCommit="true" postCommit="true">
                                <_0:TargetPort>setDocAction</_0:TargetPort>
                                <_0:ModelSetDocAction>
                                    <_0:serviceType>UpdateOrderStatus</_0:serviceType>
                                    <_0:tableName>C_Order</_0:tableName>
                                    <_0:recordID>0</_0:recordID>
                                    <_0:recordIDVariable>@C_Order.C_Order_ID</_0:recordIDVariable>
                                    <_0:docAction>CO</_0:docAction>
                                </_0:ModelSetDocAction>
                            </_0:operation>
                        </_0:operations>
                    </_0:CompositeRequest>
                </_0:compositeOperation>
            </soapenv:Body>
```