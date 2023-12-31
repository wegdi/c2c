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
"pageSize": 1000,
"query": "
  SELECT
  ad_group.ad_rotation_mode,
  ad_group.audience_setting.use_audience_grouped,
  ad_group.base_ad_group,
  ad_group.campaign,
  ad_group.cpc_bid_micros,
  ad_group.cpm_bid_micros,
  ad_group.cpv_bid_micros,
  ad_group.display_custom_bid_dimension,
  ad_group.effective_cpc_bid_micros,
  ad_group.effective_target_cpa_micros,
  ad_group.effective_target_cpa_source,
  ad_group.effective_target_roas,
  ad_group.effective_target_roas_source,
  ad_group.excluded_parent_asset_field_types,
  ad_group.excluded_parent_asset_set_types,
  ad_group.final_url_suffix,
  ad_group.id,
  ad_group.labels,
  ad_group.name,
  ad_group.optimized_targeting_enabled,
  ad_group.percent_cpc_bid_micros,
  ad_group.resource_name,
  ad_group.status,
  ad_group.target_cpa_micros,
  ad_group.target_cpm_micros,
  ad_group.target_roas,
  ad_group.targeting_setting.target_restrictions,
  ad_group.tracking_url_template,
  ad_group.type,
  ad_group.url_custom_parameters,
  metrics.absolute_top_impression_percentage,
  metrics.active_view_cpm,
  metrics.active_view_ctr,
  metrics.active_view_impressions,
  metrics.active_view_measurability,
  metrics.active_view_measurable_cost_micros,
  metrics.active_view_measurable_impressions,
  metrics.active_view_viewability,
  metrics.all_conversions,
  metrics.all_conversions_by_conversion_date,
  metrics.all_conversions_from_interactions_rate,
  metrics.all_conversions_value,
  metrics.all_conversions_value_by_conversion_date,
  metrics.all_new_customer_lifetime_value,
  metrics.average_cpc,
  metrics.average_cpe,
  metrics.average_cpm,
  metrics.average_cpv,
  metrics.average_page_views,
  metrics.average_time_on_site,
  metrics.bounce_rate,
  metrics.clicks,
  metrics.content_impression_share,
  metrics.content_rank_lost_impression_share,
  metrics.conversions,
  metrics.conversions_by_conversion_date,
  metrics.conversions_from_interactions_rate,
  metrics.conversions_value,
  metrics.conversions_value_by_conversion_date,
  metrics.cost_micros,
  metrics.cost_per_all_conversions,
  metrics.cost_per_conversion,
  metrics.cost_per_current_model_attributed_conversion,
  metrics.cross_device_conversions,
  metrics.ctr,
  metrics.current_model_attributed_conversions,
  metrics.current_model_attributed_conversions_value,
  metrics.engagement_rate,
  metrics.engagements,
  metrics.gmail_forwards,
  metrics.gmail_saves,
  metrics.gmail_secondary_clicks,
  metrics.impressions,
  metrics.interaction_event_types,
  metrics.interaction_rate,
  metrics.interactions,
  metrics.new_customer_lifetime_value,
  metrics.percent_new_visitors,
  metrics.phone_calls,
  metrics.phone_impressions,
  metrics.phone_through_rate,
  metrics.relative_ctr,
  metrics.search_absolute_top_impression_share,
  metrics.search_budget_lost_absolute_top_impression_share,
  metrics.search_budget_lost_top_impression_share,
  metrics.search_exact_match_impression_share,
  metrics.search_impression_share,
  metrics.search_rank_lost_absolute_top_impression_share,
  metrics.search_rank_lost_impression_share,
  metrics.search_rank_lost_top_impression_share,
  metrics.search_top_impression_share,
  metrics.top_impression_percentage,
  metrics.value_per_all_conversions,
  metrics.value_per_all_conversions_by_conversion_date,
  metrics.value_per_conversion,
  metrics.value_per_conversions_by_conversion_date,
  metrics.value_per_current_model_attributed_conversion,
  metrics.video_quartile_p100_rate,
  metrics.video_quartile_p25_rate,
  metrics.video_quartile_p50_rate,
  metrics.video_quartile_p75_rate,
  metrics.video_view_rate,
  metrics.video_views,
  metrics.view_through_conversions
  FROM ad_group
  WHERE segments.date BETWEEN \''.$Date.'\' AND \''.$Date.'\'

"
}';


$GoogleSystem = $db->Query('Settings',['AccessToken' => ['$ne' => null]], [], 'TEK');
$Companies = $db->Query('Companies',['GoogleId' => ['$ne' => null]], [], 'COK');

foreach ($Companies as $key => $AccountValue) {
  $AccountId=$AccountValue["GoogleId"];
  $CompaniesCode=$AccountValue["CompanyCode"];
  $Commission=$AccountValue["Commission"];



  $GoogelSonuclar=$GoogleAds->googleistek(Google_DEVELOPER_TOKEN,Google_ID,$GoogleSystem['AccessToken'],$AccountId,$Query);

  foreach ($GoogelSonuclar["results"] as $key => $value) {

    $campaign=explode("/",$value["adGroup"]["campaign"]);
    $data = array(
      'Status' => $value["adGroup"]["status"],
      'Type' => $GoogleAds->GoogleDurumlar($value["adGroup"]["type"]),
      'Id' => (int)$value["adGroup"]["id"],
      'CampaignId' => end($campaign),
      'Name' => $value["adGroup"]["name"],
      'Cpc' => $GoogleAds->Commission($value["adGroup"]["cpcBidMicros"],$Commission)/1000000,
      'CostMicros' => $GoogleAds->Commission($value["metrics"]["costMicros"],$Commission)/1000000,
      'AverageCpc' => $GoogleAds->Commission($value["metrics"]["averageCpc"],$Commission)/1000000,
      'AverageCpm' => $GoogleAds->Commission($value["metrics"]["averageCpm"],$Commission)/1000000,
      'Clicks' => $value["metrics"]["clicks"],
      'Conversions' => $value["metrics"]["conversions"],
      'PhoneCalls' => $value["metrics"]["phoneCalls"],
      'PhoneImpressions' => $value["metrics"]["phoneImpressions"],
      'Impressions' =>  $value["metrics"]["impressions"],
      'VideoViews' => $value["metrics"]["videoViews"],
      'CompaniesCode' =>  $CompaniesCode,
      'Date' => strtotime($Date)


    );
    print_r($data);



    $GoogleAdGroup = $db->Query('GoogleAdGroup',['Date' => strtotime($Date),'Id' => (int)$value["adGroup"]["id"]], [], 'TEK');


    if ($GoogleAdGroup["_id"]=="") {
      $db->Add("GoogleAdGroup", $data);

    }else {
      $db->UpdateByObjectId("GoogleAdGroup",(string)$GoogleAdGroup["_id"], $data);

    }

  }



}

//
?>
