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

$adsets = array(
	'id',
	'campaign_id',
  'name',
  'start_time',
  'end_time',
  'daily_budget',
  'lifetime_budget',
  'status',
  'optimization_goal',
  'targeting'
);

$Companies = $db->Query('Companies',['FacebookAct' => ['$ne' => null]], [], 'COK');

foreach ($Companies as $Companies_item) {
	$CompanyCode=$Companies_item["CompanyCode"];
	$act="act_".$Companies_item["FacebookAct"];
	$Commission=$Companies_item["Commission"];

	$json = json_encode((new AdAccount($act))->getCampaigns($fields, array('date_preset' => 'maximum'))->getResponse()->getContent(), JSON_PRETTY_PRINT);
	$Json_Decode = json_decode($json, true);
	foreach ($Json_Decode["data"] as $value) {
		$json = json_encode((new Campaign($value["id"]))->getAdSets($adsets, array('date_preset' => 'maximum'))->getResponse()->getContent(), JSON_PRETTY_PRINT);
		$Json_Decode = json_decode($json, true);

		
		$Params= array(
				'CompaniesCode' => (int)$CompanyCode,
		  	'CampaignId' => (int)$value["id"],
		  	'CampaignGroupId' => (int)$Json_Decode["data"][0]["id"],
	      'CampaignGroupName' => $Json_Decode["data"][0]["name"],
	      'Status'		=>	$Json_Decode["data"][0]["status"],
	      'start_time'	=> $Json_Decode["data"][0]["start_time"],
	      'end_time'	=> $Json_Decode["data"][0]["end_time"],
	      'daily_budget'		=> (double)$Meta->Commission($Json_Decode["data"][0]["daily_budget"],$Commission),
	      'lifetime_budget'		=> (double)$Meta->Commission($Json_Decode["data"][0]["lifetime_budget"],$Commission),
	      'optimization_goal'	=>	$Json_Decode["data"][0]["optimization_goal"],
	      'targeting'	=>	$Json_Decode["data"][0]["targeting"]["geo_locations"]["cities"][0]["name"].' '.$Json_Decode["data"][0]["targeting"]["geo_locations"]["cities"][0]["region"],
	      'Date' => strtotime($Date)
	    );
		$MetaCampaign = $db->Query('MetaCampaignAdGroup',['Date' => strtotime($Date),'CampaignGroupId' => (int)$Json_Decode["data"][0]["id"]], [], 'TEK');	
	    if($MetaCampaign["_id"]=="")
	      $db->Add("MetaCampaignAdGroup", $Params);
	    else
	      $db->UpdateByObjectId("MetaCampaignAdGroup",(string)$MetaCampaign["_id"], $Params);

	  	
		echo '<pre>';
		print_r($Json_Decode);

	}
}
?>