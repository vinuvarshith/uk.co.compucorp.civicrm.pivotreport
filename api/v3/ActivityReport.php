<?php

/**
 * ActivityReport.get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRM/API+Architecture+Standards
 */
function _civicrm_api3_activity_report_get_spec(&$spec) {
}

/**
 * ActivityReport.get API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_activity_report_get($params) {
  $startDate = !empty($params['start_date']) ? $params['start_date'] : null;
  $endDate = !empty($params['end_date']) ? $params['end_date'] : null;
  $page = !empty($params['page']) ? (int)$params['page'] : 0;

  $dataInstance = new CRM_PivotReport_DataActivity();
  $cacheGroupInstance = new CRM_PivotCache_GroupActivity();

  return civicrm_api3_create_success(
    $dataInstance->get(
      $cacheGroupInstance,
      array(
        'start_date' => $startDate,
        'end_date' => $endDate,
      ),
      $page
    ),
    $params
  );
}

/**
 * ActivityReport.getheader API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_activity_report_getheader($params) {
  $cacheGroupInstance = new CRM_PivotCache_GroupActivity();

  return civicrm_api3_create_success($cacheGroupInstance->getHeader(), $params);
}

/**
 * ActivityReport.rebuildcache API
 *
 * @param array $params
 * @return array API result descriptor
 * @throws API_Exception
 */
function civicrm_api3_activity_report_rebuildcache($params) {
  $startDate = !empty($params['start_date']) ? $params['start_date'] : null;
  $endDate = !empty($params['end_date']) ? $params['end_date'] : null;

  $dataInstance = new CRM_PivotReport_DataActivity();
  $cacheGroupInstance = new CRM_PivotCache_GroupActivity();

  return civicrm_api3_create_success(
    $dataInstance->rebuildCache(
      $cacheGroupInstance,
      array(
        'start_date' => $startDate,
        'end_date' => $endDate,
      )
    ),
    $params
  );
}