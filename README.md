# php go-client
SoapClient for usage with GO API (https://www.general-overnight.com).

## How to use

Just create an object of GoClient class.

```
$wdsl = "Path/to/wdsl";
$options = [
    'login' => 'yourGoLoginName',
    'password' => 'yourGoPassword',
    ...
    # pass other options for SoapCLient as noted in https://www.php.net/manual/de/soapclient.soapclient.php
];

$goClient = new GoClient($wdsl, $options);
``` 




