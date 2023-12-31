<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once('Func.php');
$Meta = new Meta();
$db=new General();
date_default_timezone_set('Europe/London');
$Date=date('Y-m-d');	

require  'vendor/autoload.php';

use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;

$api = Api::init("1274678116479284","6a061c959506f6b04e4067411314f4ba","EAASHUCBV8TQBO3ORRGZBYT5DgUrKDx7nqCGMyEbzJMP4UQQACtcwmQaVZCfoMIIciJCxZCofkwvUhtJiuBfk6tG5EFJkRcrszyibwNTsZAU0ZCNF2cn6zXBZBClSr2d76oGtZBRGU16s92yXxLnzwB4YXRphFkDj9yVw9wPT13G2sKbJC7bXU2iRrnsVA8zIZB4npwPcLRlx54vD2fwXtx8Xn2ln8L47CnK1DwZDZD");
$api->setLogger(new CurlLogger());

$fields = array(
  'name',
  'status'
);

$insights = array(
  'impressions',
  'objective',
  'spend',
  'cpc',
  'cpm',
  'ctr'
);

$Companies = $db->Query('Companies',['FacebookAct' => ['$ne' => null]], [], 'COK');

foreach ($Companies as $Companies_item) {
	$CompanyCode=$Companies_item["CompanyCode"];
	$act="act_".$Companies_item["FacebookAct"];
	$Commission=$Companies_item["Commission"];

	$json = json_encode((new AdAccount($act))->getCampaigns($fields, array('date_preset' => 'maximum'))->getResponse()->getContent(), JSON_PRETTY_PRINT);
	$Json_Decode = json_decode($json, true);
	foreach ($Json_Decode["data"] as $value) {
		$json = json_encode((new AdSet($value["id"]))->getInsights($insights, array('date_preset' => 'maximum'))->getResponse()->getContent(), JSON_PRETTY_PRINT);
		$Json_Decode = json_decode($json, true);

		$Params= array(
				'CompaniesCode' => (int)$CompanyCode,
		  	'CampaignId' => (int)$value["id"],
	      'CampaignName' => $value["name"],
	      'Status'		=>	$value["status"],
	      'impressions'	=> $Json_Decode["data"][0]["impressions"],
	      'objective'	=> $Json_Decode["data"][0]["objective"],
	      'spend'		=> (double)$Meta->Commission($Json_Decode["data"][0]["spend"],$Commission),
	      'cpc'		=> (double)$Meta->Commission($Json_Decode["data"][0]["cpc"],$Commission),
	      'cpm'		=> (double)$Meta->Commission($Json_Decode["data"][0]["cpm"],$Commission),
	      'ctr'		=> (double)$Meta->Commission($Json_Decode["data"][0]["ctr"],$Commission),
	      'Date' => strtotime($Date)
	    );
		$MetaCampaign = $db->Query('MetaCampaign',['Date' => strtotime($Date),'CampaignId' => (int)$value["id"]], [], 'TEK');	
	    if($MetaCampaign["_id"]=="")
	      $db->Add("MetaCampaign", $Params);
	    else
	      $db->UpdateByObjectId("MetaCampaign",(string)$MetaCampaign["_id"], $Params);

	  	
		echo '<pre>';
		print_r($Json_Decode);

	}
}
?>