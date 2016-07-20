<?php

require_once 'nobillingfields.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function nobillingfields_civicrm_config(&$config) {
  _nobillingfields_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function nobillingfields_civicrm_xmlMenu(&$files) {
  _nobillingfields_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function nobillingfields_civicrm_install() {
  _nobillingfields_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function nobillingfields_civicrm_uninstall() {
  _nobillingfields_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function nobillingfields_civicrm_enable() {
  _nobillingfields_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function nobillingfields_civicrm_disable() {
  _nobillingfields_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function nobillingfields_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _nobillingfields_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function nobillingfields_civicrm_managed(&$entities) {
  _nobillingfields_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function nobillingfields_civicrm_caseTypes(&$caseTypes) {
  _nobillingfields_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function nobillingfields_civicrm_angularModules(&$angularModules) {
_nobillingfields_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function nobillingfields_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _nobillingfields_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implement buildForm hook to remove billing fields
 * @param string $formName
 * @param CRM_Core_Form $form
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_buildForm
 */
function nobillingfields_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Contribute_Form_Contribution_Main')  {
    $displayedFields = array('billing_first_name', 'billing_last_name');
    $form->assign('billingDetailsFields', $displayedFields);

    $bltID = $form->get('bltID');
    $suppressedFields = array(
      "billing_street_address-{$bltID}", 
      "billing_city-{$bltID}",
      "billing_state_province_id-{$bltID}",
      "billing_postal_code-{$bltID}",
      "billing_country_id-{$bltID}"
    );
    foreach ($suppressedFields as $fieldId) {
      $form->_paymentFields[$fieldId]['is_required'] = FALSE;
    }
  }
}
