<?php

namespace Arsam\Rmto\Services;

use Exception;
use Arsam\Rmto\Contracts\RmtoService;
use Arsam\Rmto\Models\Driver;
use SoapClient;

class GetDriverByNationalCodeService extends RmtoService
{
    private string $nationalCode;

    function nationalCode($nationalCode): GetDriverByNationalCodeService
    {
        $this->nationalCode = $nationalCode;
        return $this;
    }

    /**
     * @return Driver
     * @throws \SoapFault
     */
    function invoke(): Driver
    {
        $url = config('constants.soap_api_url');
        $client = new SoapClient($url);
        $data = [
            'SVARCHAR2-RMTO_WEB_SERVICESInput' => [
                'IN_USERNAME-VARCHAR2-IN' => $this->username,
                'IN_PASSWORD-VARCHAR2-IN' => $this->password,
                'IN_SERVICEID-NUMBER-IN' => 3,
                'IN_PARAM_1-VARCHAR2-IN' => $this->nationalCode,
                'IN_PARAM_2-VARCHAR2-IN' => '',
                'IN_PARAM_3-VARCHAR2-IN' => '',
                'IN_PARAM_4-VARCHAR2-IN' => '',
                'IN_PARAM_5-VARCHAR2-IN' => '',
                'IN_PARAM_6-VARCHAR2-IN' => '',
                'IN_PARAM_7-VARCHAR2-IN' => '',
                'IN_PARAM_8-VARCHAR2-IN' => '',
                'IN_PARAM_9-VARCHAR2-IN' => '',
                'IN_PARAM_10-VARCHAR2-IN' => '',
            ]
        ];
        $response = $client->__soapCall('RMTO_WEB_SERVICES', $data);
        $response = json_decode(json_encode($response), true);
        if (isset($response['RETURN'])) {
            $result = $response['RETURN'];
            if ($result == -1 || $result == '-1') {
                throw new Exception('Driver with this national code not found.');
            } else {
                $splitData = explode(';', $result);
                $resultArray = [];
                for ($i = 0; $i < count($splitData); $i++) {
                    $splitField = explode(':', $splitData[$i]);
                    if (count($splitField) == 2) {
                        $resultArray[$splitField[0]] = $splitField[1];
                    }
                }
                return new Driver($resultArray);
            }
        }
        throw new Exception('API Call was not successful.');
    }
}