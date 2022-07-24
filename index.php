<?php

/* #########################
* This code was developed by:
* Audox Ingeniería SpA.
* website: www.audox.com
* email: info@audox.cl
######################### */

include 'auth.php';

function getRecords($object, $params){

    if($object == "deals"){
        $params['properties'] = "dealname,amount,closedate,dealstage,pipeline,hubspot_owner_id";
        $params['associations'] = "companies";
    }

    $hubspot_key = $params['hapikey'];
    unset($params['hapikey']);

    $url = 'https://api.hubapi.com/crm/v3/';
    if(in_array($object, array('companies', 'contacts', 'deals'))) $url .= 'objects/';
    $url .= $object.'?'.http_build_query($params);

    $headers = array(
        'Authorization:Bearer '.$hubspot_key,
        'Content-Type:application/json',
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($output, true);

    $records = [];

    if(!empty($result['results'])){
        foreach($result['results'] as $record){
            if($object == "deals"){
                $companies = $record['associations']['companies']['results'];
                foreach($companies as $company){
                    if($company['type'] == "deal_to_company"){
                        $record['properties']['company_id'] = $company['id'];
                        break;
                    }
                }
            }
            $records[] = $record;
        }
    }

    if(!empty($result['paging'])){
        $params['hapikey'] = $hubspot_key;
        $params["after"] = $result['paging']['next']['after'];
        $records = array_merge($records, getRecords($object, $params));
    }

    return $records;

}

$headers = getallheaders();
if(function_exists('Auth') && Auth($headers['Authorization']) == false) die(json_encode(array("error_code" => "401", "error_description" => "Unauthorized")));

$params = array(
    "hapikey" => $_REQUEST['hapikey'],
    "limit" => $_REQUEST['limit'],
);

if($_REQUEST["action"] == "getRecords") $result = getRecords($_REQUEST['object'], $params);

echo json_encode($result);

?>