php_idempiere_composite_api
===========================

A php wrapper for the composite api in Idempiere

request_params can be sent in as json or an associative php array.

example json:

{
    "settings" : {
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
            "serviceName" : "createBPartner",
            "table" : "c_bpartner",
            "keyValPairs" : {
                "X" : "Y"
            }
        },
        {
            "type" : "setDocAction",
            "preCommit" : "",
            "postCommit" : "",
            "serviceName" : "",
            "table" : "",
            "keyValPairs" : {
                "idColumn" : "Y",
                "action" : "CO"
            }
        }
    ]
}
