<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SYSTEM.'General/General.php');
require_once('Func.php');
$Meta = new Meta();
$db=new General();
date_default_timezone_set('Europe/London');
$Date=date('Y-m-d');	

require  'vendor/autoload.php';

use FacebookAds\Object\AdCreative;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\Ads;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;

$api = Api::init("1274678116479284","6a061c959506f6b04e4067411314f4ba","EAASHUCBV8TQBO3ORRGZBYT5DgUrKDx7nqCGMyEbzJMP4UQQACtcwmQaVZCfoMIIciJCxZCofkwvUhtJiuBfk6tG5EFJkRcrszyibwNTsZAU0ZCNF2cn6zXBZBClSr2d76oGtZBRGU16s92yXxLnzwB4YXRphFkDj9yVw9wPT13G2sKbJC7bXU2iRrnsVA8zIZB4npwPcLRlx54vD2fwXtx8Xn2ln8L47CnK1DwZDZD");
$api->setLogger(new CurlLogger());

$fields = array(
  'name',
  'status'
);

$ads = array(
  "id",
	"adset_id",
	"campaign_id",
	"conversion_specs",
	"name",
	"status"
);

$Companies = $db->Query('Companies',['FacebookAct' => ['$ne' => null]], [], 'COK');

foreach ($Companies as $Companies_item) {
	$CompanyCode=$Companies_item["CompanyCode"];
	$act="act_".$Companies_item["FacebookAct"];
	$Commission=$Companies_item["Commission"];

	$json = json_encode((new AdAccount($act))->getCampaigns($fields, array('date_preset' => 'maximum'))->getResponse()->getContent(), JSON_PRETTY_PRINT);
	$Json_Decode = json_decode($json, true);
	foreach ($Json_Decode["data"] as $value) {
		$json = json_encode((new Campaign($value["id"]))->getAds($ads, array('date_preset' => 'maximum'))->getResponse()->getContent(), JSON_PRETTY_PRINT);
		$Json_Decode = json_decode($json, true);


		$json = json_encode((new AdAccount($Json_Decode["data"][0]["adset_id"]))->getAdCreatives(array(''), array())->getResponse()->getContent(), JSON_PRETTY_PRINT);
		$adcreatives = json_decode($json, true);

    $json = json_encode((new AdCreative($adcreatives["data"][0]["id"]))->getSelf(array('thumbnail_url'), array())->exportAllData(), JSON_PRETTY_PRINT);
		$post_info = json_decode($json, true);

		
		$Params= array(
				'CompaniesCode' => (int)$CompanyCode,
		  	'CampaignId' => (int)$value["id"],
		  	'CampaignGroupId' => (int)$Json_Decode["data"][0]["adset_id"],
		  	'AdsId' => (int)$Json_Decode["data"][0]["id"],
	      'Name' => $Json_Decode["data"][0]["name"],
	      'Status'		=>	$Json_Decode["data"][0]["status"],
	      'page'	=>	(int)$Json_Decode["data"][0]["conversion_specs"][0]["page"][0],
	      'post'	=>	(int)$Json_Decode["data"][0]["conversion_specs"][0]["post"][0],
	      'post_thumb'	=>	$post_info["thumbnail_url"],
	      'Date' => strtotime($Date)
	    );
		$MetaCampaign = $db->Query('MetaCampaignAds',['Date' => strtotime($Date),'AdsId' => (int)$Json_Decode["data"][0]["id"]], [], 'TEK');	
	    if($MetaCampaign["_id"]=="")
	      $db->Add("MetaCampaignAds", $Params);
	    else
	      $db->UpdateByObjectId("MetaCampaignAds",(string)$MetaCampaign["_id"], $Params);




	  	
		echo '<pre>';
		//print_r($adcreatives);

	}
}
?>