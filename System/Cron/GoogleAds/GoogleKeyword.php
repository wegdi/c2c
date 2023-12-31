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
    SELECT
          ad_group_criterion.youtube_channel.channel_id, ad_group_criterion.webpage.sample.sample_urls, ad_group_criterion.webpage.criterion_name, ad_group_criterion.webpage.coverage_percentage, ad_group_criterion.webpage.conditions, ad_group_criterion.user_list.user_list, ad_group_criterion.user_interest.user_interest_category, ad_group_criterion.url_custom_parameters, ad_group_criterion.type, ad_group_criterion.tracking_url_template, ad_group_criterion.topic.topic_constant, ad_group_criterion.topic.path, ad_group_criterion.system_serving_status, ad_group_criterion.status, ad_group_criterion.resource_name, ad_group_criterion.quality_info.search_predicted_ctr, ad_group_criterion.quality_info.quality_score, ad_group_criterion.quality_info.post_click_quality_score, ad_group_criterion.quality_info.creative_quality_score, ad_group_criterion.position_estimates.top_of_page_cpc_micros, ad_group_criterion.position_estimates.first_position_cpc_micros, ad_group_criterion.position_estimates.first_page_cpc_micros, ad_group_criterion.position_estimates.estimated_add_cost_at_first_position_cpc, ad_group_criterion.position_estimates.estimated_add_clicks_at_first_position_cpc, ad_group_criterion.placement.url, ad_group_criterion.percent_cpc_bid_micros, ad_group_criterion.parental_status.type, ad_group_criterion.negative, ad_group_criterion.mobile_application.name, ad_group_criterion.mobile_application.app_id, ad_group_criterion.mobile_app_category.mobile_app_category_constant, ad_group_criterion.location.geo_target_constant, ad_group_criterion.listing_group.type, ad_group_criterion.listing_group.path, ad_group_criterion.listing_group.parent_ad_group_criterion, ad_group_criterion.labels, ad_group_criterion.keyword.text, ad_group_criterion.ad_group, ad_group_criterion.age_range.type, ad_group_criterion.app_payment_model.type, ad_group_criterion.approval_status, ad_group_criterion.audience.audience, ad_group_criterion.bid_modifier, ad_group_criterion.combined_audience.combined_audience, ad_group_criterion.cpc_bid_micros, ad_group_criterion.keyword.match_type, ad_group_criterion.income_range.type, ad_group_criterion.gender.type, ad_group_criterion.final_urls, ad_group_criterion.final_url_suffix, ad_group_criterion.final_mobile_urls, ad_group_criterion.effective_percent_cpc_bid_source, ad_group_criterion.effective_percent_cpc_bid_micros, ad_group_criterion.effective_cpv_bid_source, ad_group_criterion.effective_cpv_bid_micros, ad_group_criterion.effective_cpm_bid_source, ad_group_criterion.effective_cpm_bid_micros, ad_group_criterion.effective_cpc_bid_source, ad_group_criterion.effective_cpc_bid_micros, ad_group_criterion.display_name, ad_group_criterion.disapproval_reasons, ad_group_criterion.custom_intent.custom_intent, ad_group_criterion.custom_audience.custom_audience, ad_group_criterion.custom_affinity.custom_affinity, ad_group_criterion.criterion_id,
           campaign.id,
           ad_group.id,
           metrics.cost_micros,
           metrics.impressions,
           metrics.average_cpe,
           metrics.average_cpm,
           metrics.average_cpv,
           metrics.clicks,
           metrics.conversions,
           metrics.average_cost
    FROM keyword_view
    WHERE segments.date BETWEEN \''.$Date.'\' AND \''.$Date.'\'  AND ad_group_criterion.negative = FALSE
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
    $Params = array(
      'CampaignId' => (string)$value["campaign"]["id"],
      'AdGroupId' => (int)$value["adGroup"]["id"],
      'CriterionId' => (int)$value["adGroupCriterion"]["criterionId"],
      'Clicks' => (int)$value["metrics"]["clicks"],
      'Conversions' => $value["metrics"]["conversions"],
      'Impressions' => $value["metrics"]["impressions"],
      'CostMicros' => $GoogleAds->Commission($value["metrics"]["costMicros"],$Commission)/1000000,
      'AverageCpm' => $GoogleAds->Commission($value["metrics"]["averageCpm"],$Commission)/1000000,
      'AverageCost' => $GoogleAds->Commission($value["metrics"]["averageCost"],$Commission)/1000000,
      'Keyword' => $value["adGroupCriterion"]["keyword"]["text"],
      'MatchType' => $GoogleAds->GoogleKeywordStatus($value["adGroupCriterion"]["keyword"]["matchType"]),
      'Type' => $value["adGroupCriterion"]["type"],
      'Status' => $value["adGroupCriterion"]["status"],
      'Negative' => $value["adGroupCriterion"]["negative"],
      'CreativeQualityScore' => $GoogleAds->GoogleKeywordQuality($value["adGroupCriterion"]["qualityInfo"]["creativeQualityScore"]),
      'PostClickQualityScore' => $GoogleAds->GoogleKeywordQuality($value["adGroupCriterion"]["qualityInfo"]["postClickQualityScore"]),
      'SearchPredictedCtr' => $GoogleAds->GoogleKeywordQuality($value["adGroupCriterion"]["qualityInfo"]["searchPredictedCtr"]),
      'QualityScore' => $value["adGroupCriterion"]["qualityInfo"]["qualityScore"],
      'ApprovalStatus' => $GoogleAds->GoogleKeywordApprovalStatus($value["adGroupCriterion"]["approvalStatus"]),
      'EffectiveCpcBidMicros' =>  $GoogleAds->Commission($value["adGroupCriterion"]["effectiveCpcBidMicros"],$Commission)/1000000,
      'CompaniesCode' => $CompaniesCode,
      'Date' => strtotime($Date)

    );



    $GoogleKeyword = $db->Query('GoogleKeyword',['Date' => strtotime($Date),'CriterionId' => (int)$value["adGroupCriterion"]["criterionId"]], [], 'TEK');


    if ($GoogleKeyword["_id"]=="") {
      $db->Add("GoogleKeyword", $Params);

    }else {
      $db->UpdateByObjectId("GoogleKeyword",(string)$GoogleKeyword["_id"], $Params);

    }

  }



}

//
?>
