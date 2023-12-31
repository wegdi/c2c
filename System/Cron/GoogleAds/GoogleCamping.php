<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once('Func.php');
require_once(SYSTEM.'General/General.php');
$db=new General();
$GoogleAds=new GoogleAds();
date_default_timezone_set('Europe/London');
$Date=date('Y-m-d');

//$Tarih=date('2023-04-06');
$Query='{
"pageSize": 100,
"query": "
  SELECT campaign.name,
    campaign_budget.amount_micros,
    campaign_budget.delivery_method,
    campaign_budget.explicitly_shared,
    campaign_budget.has_recommended_budget,
    campaign_budget.id,
    campaign.id,
    campaign_budget.name,
    campaign_budget.period,
    campaign_budget.recommended_budget_amount_micros,
    campaign_budget.recommended_budget_estimated_change_weekly_clicks,
    campaign_budget.recommended_budget_estimated_change_weekly_cost_micros,
    campaign_budget.recommended_budget_estimated_change_weekly_interactions,
    campaign_budget.recommended_budget_estimated_change_weekly_views,
    campaign_budget.reference_count,
    campaign_budget.resource_name,
    campaign_budget.status,
    campaign_budget.total_amount_micros,
    campaign_budget.type,
    metrics.all_conversions,
    metrics.all_conversions_from_interactions_rate,
    metrics.all_conversions_value,
    metrics.average_cost,
    metrics.average_cpc,
    metrics.average_cpe,
    metrics.average_cpm,
    metrics.average_cpv,
    metrics.clicks,
    metrics.conversions,
    metrics.conversions_from_interactions_rate,
    metrics.conversions_value,
    metrics.cost_micros,
    metrics.cost_per_all_conversions,
    metrics.cost_per_conversion,
    metrics.cross_device_conversions,
    metrics.ctr,
    metrics.engagement_rate,
    metrics.engagements,
    metrics.impressions,
    metrics.interaction_event_types,
    metrics.interaction_rate,
    metrics.interactions,
    metrics.value_per_all_conversions,
    metrics.value_per_conversion,
    metrics.video_view_rate,
    metrics.video_views,
    metrics.view_through_conversions,
    campaign.bidding_strategy_type
  FROM campaign
  WHERE segments.date BETWEEN \''.$Date.'\' AND \''.$Date.'\'
"
}';


$GoogleSystem = $db->Query('Settings',['AccessToken' => ['$ne' => null]], [], 'TEK');
$Companies = $db->Query('Companies',['GoogleId' => ['$ne' => null]], [], 'COK');

foreach ($Companies as $key => $AccountValue) {
  $AccountId=$AccountValue["GoogleId"];
  $CompaniesCode=$AccountValue["CompanyCode"];
  $Commission=$AccountValue["Commission"];
  $SuankiButce=$AccountValue["google_ads_butce"];



  $GoogelSonuclar=$GoogleAds->googleistek(Google_DEVELOPER_TOKEN,Google_ID,$GoogleSystem['AccessToken'],$AccountId,$Query);
  foreach ($GoogelSonuclar["results"] as $key => $value) {

    print_r($value);
    $Params= array(
      'CampaignName' => $value["campaign"]["name"],
      'CampaignClick' => $value["metrics"]["clicks"],
      'CampaignClickCost' => $GoogleAds->Commission($value["metrics"]["averageCpc"],$Commission)/1000000,
      'CampaignView' => $value["metrics"]["impressions"],
      'CampaignInteraction' => $value["metrics"]["interactions"],
      'CampaignType' => $GoogleAds->GoogleDurumlar($value["campaign"]["biddingStrategyType"]),
      'CampaignConversion' => $value["metrics"]["conversions"],
      'CampaignStatus' => $value["campaignBudget"]["status"],
      'Period' => $value["campaignBudget"]["period"],
      'CampaignId' =>   (int)trim($value["campaign"]["id"]),
      'DailyBudget' => $GoogleAds->Commission($value["campaignBudget"]["amountMicros"],$Commission)/1000000,
      'Remaining_Budget' => $GoogleAds->Commission($value["metrics"]["costMicros"],$Commission)/1000000,
      'CompaniesCode' => $CompaniesCode,
      'Date' => strtotime($Date)
    );

    $GoogleCampaign = $db->Query('GoogleCampaign',['Date' => strtotime($Date),'CampaignId' => (int)$value["campaign"]["id"]], [], 'TEK');


    if ($GoogleCampaign["_id"]=="") {
      $db->Add("GoogleCampaign", $Params);

    }else {
      $db->UpdateByObjectId("GoogleCampaign",(string)$GoogleCampaign["_id"], $Params);

    }

  }



}

//
?>
