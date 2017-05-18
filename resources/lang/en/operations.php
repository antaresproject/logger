<?php

/**
 * Part of the Antares package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Logger
 * @version    0.9.0
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */



return

        array(
            'FOOROW_DELETED'                                      => 'Foo item :owner_id has been deleted by :user',
            'FOOROW_UPDATED'                                      => 'Foo item :owner_id has been updated by :user',
            'FOOROW_CREATED'                                      => 'Foo item :owner_id has been created by :user',
            'IMPORT_UPDATED'                                      => 'Import :owner_id has been updated by :user',
            'IMPORT_CREATED'                                      => 'Import :owner_id has been created by :user',
            'SERVER_CREATED'                                      => 'Server :owner_id has been created by :user',
            'SERVER_CREATED_LOCATION'                             => 'Server :owner_id has been created by :user in location :location',
            'LOCATION_CREATED'                                    => 'Location :owner_id has been created by :user',
            'ADDONPLANQUANTITY_CREATED'                           => 'Addon plan quantity :owner_id has been created by :user',
            'IMPORTLOG_CREATED'                                   => 'New import log :owner_id has been created by :user',
            'PLAN_CREATED'                                        => 'New plan :owner_id has been created by :user',
            'ADDON_CREATED'                                       => 'New addon :owner_id has been created by :user',
            'CPANELACCOUNT_UPDATED'                               => 'Cpanel account :owner_id has been updated by :user',
            'RULE_CREATED'                                        => 'New ban rule :owner_id has been created by :user',
            'RULE_DELETED'                                        => 'Ban rule :owner_id has been deleted by :user',
            'RULE_CREATED_USER'                                   => 'New ban rule for :owner_id has been created by :user',
            'RULE_UPDATED_USER'                                   => 'Ban rule for :owner_id has been updated by :user',
            'RULE_DELETED_USER'                                   => 'Ban rule for :owner_id has been deleted by :user',
            'BANNEDEMAIL_UPDATED'                                 => 'Information about banned email :owner_id has been updated by :user',
            'BANNEDEMAIL_UPDATED_USER'                            => 'Information about banned email :owner_id has been updated by :user',
            'BANNEDEMAIL_CREATED'                                 => 'An email :owner_id has been added to banned list by :user',
            'BANNEDEMAIL_CREATED_USER'                            => 'An email :owner_id has been added to banned list by :user',
            'BANNEDEMAIL_DELETED'                                 => 'An email :owner_id has been deleted from ban list by :user',
            'BANNEDEMAIL_DELETED_USER'                            => 'An email :owner_id has been deleted from ban list by :user',
            'RULE_UPDATED'                                        => 'A ban rule :owner_id has been updated by :user',
            'USER_CREATED'                                        => 'New user :owner_id has been created by :user',
            'USER_DELETED'                                        => 'User :owner_id has been deleted by :user',
            'ROLE_DELETED'                                        => 'User group :owner_id has been deleted by :user',
            'ROLE_UPDATED'                                        => 'User group :owner_id has been updated by :user',
            'ROLE_UPDATED_AREA'                                   => 'User group :owner_id has been updated by :user with area :area',
            'ROLE_CREATED'                                        => 'New user group :owner_id has been created by :user',
            'BRANDS_CREATED'                                      => 'New brand :owner_id has been created by :user',
            'BRANDS_UPDATED'                                      => 'Brand :owner_id has been updated by user :user',
            'CREDENTIAL_LOGOUT'                                   => 'User logout successfully',
            'CREDENTIAL_USERHASLOGGEDIN'                          => 'User login successfully',
            'USER_UPDATED'                                        => 'User :owner_id data updated by :user',
            'CORE_DASHBOARD_SHOW'                                 => 'Dashboard show',
            'LOGGER_ACTIVITY_SHOW'                                => 'Logger activity show',
            'LOGGER_ACTIVITY_INDEX'                               => 'Logger default action',
            'JOBS_CREATED'                                        => 'Automation job :owner_id has been created by :user',
            'JOBRESULTS_CREATED'                                  => 'Automation job :name has been launched by :user and completed :return in :times',
            'JOBRESULTS_CREATED_ERROR'                            => 'Automation job :name has been launched by :user and returns :return in :time',
            'JOBS_UPDATED'                                        => 'Automation job :owner_id configuration has been updated by :user',
            'JOBS_UPDATED_COMPONENT_CATEGORY'                     => 'Automation job :owner_id configuration in category :category has been updated by :user',
            'TICKET_CREATED'                                      => 'New ticket :owner_id has been created by :user',
            'LANGUAGES_CREATED'                                   => 'New language :owner_id has been created by :user',
            'FIELDCATEGORY_CREATED'                               => 'New customfield :owner_id category has been created by :user',
            'FIELD_CREATED'                                       => 'New custom field :owner_id has been created by :user',
            'FIELD_CREATED_GROUPS_TYPES'                          => 'New custom field :owner_id has been created by :user in group :groups with type :types',
            'REPORT_CREATED'                                      => 'New system report has been created',
            'NOTIFICATIONS_CREATED'                               => 'New notification :owner_id has been created by :user',
            'NOTIFICATIONS_CREATED_TYPE_LEVEL_CATEGORY'           => 'Notification :owner_id has been created by :user with type :type with level :level and category :category ',
            'NOTIFICATIONS_UPDATED_TYPE_LEVEL_CATEGORY_EVENT'     => 'Notification :owner_id has been updated by :user with type :type with level :level and category :category using event :event',
            'NOTIFICATIONS_UPDATED'                               => 'Notification :owner_id has been updated by :user',
            'TEMPLATES_CREATED'                                   => 'New notification :owner_id template has been created by :user',
            'TEMPLATETYPES_CREATED'                               => 'New notification :owner_id template type has been created by :user',
            'TEMPLATES_UPDATED'                                   => 'Notification template :owner_id has been updated by :user',
            'ENTITYTAG_CREATED'                                   => 'Entity tag :owner_id has been created by :user',
            'TAGS_CREATED'                                        => 'New tag :owner_id has been created by user :user',
            'TAGS_DELETED'                                        => 'Tag :owner_id has been deleted by user :user',
            'TAGS_CREATED_COMPONENT_LANGUAGE_CATEGORY'            => 'Tag :owner_id has been created by user :user with language :language in category :category',
            'TAGSCATEGORY_CREATED_COMPONENT_LANGUAGE'             => 'Tag category :owner_id has been created by user :user with language :language',
            'PROVIDER_UPDATED'                                    => 'Provider configuration :owner_id has been updated by :user',
            'USERCONFIG_CREATED'                                  => 'Provider configuration :owner_id has been created by :user',
            'USERCONFIG_CREATED_PROVIDER'                         => 'Provider configuration :owner_id has been created by :user for :provider',
            'AUTHENTICATEUSER_HANDLEUSERWASAUTHENTICATED'         => 'User :user has been logged in',
            'USERAUTHLISTENER_ONUSERLOGIN'                        => 'User :user has been logged in',
            'DEAUTHENTICATEUSER_LOGOUT'                           => 'User :user has been logged out',
            'USERAUTHLISTENER_ONUSERLOGOUT'                       => 'User :user has been logged out',
            'AUTH_LOGOUT'                                         => 'User :user has been logged out',
            'LOGSLOGINDEVICES_UPDATED_LOG_USER'                   => 'Device configuration :owner_id has been updated by :user',
            'LOGSLOGINDEVICES_UPDATED_LOG'                        => 'Device configuration :owner_id has been updated by :user',
            'LOGSLOGINDEVICES_CREATED'                            => 'Device configuration :owner_id has been created by :user',
            'REQUESTPROCESSOR_CLEAR'                              => 'Request log :owner_id has been cleared by :user',
            'INDEXPROCESSOR_DELETE'                               => 'Error log :owner_id has been deleted by :user',
            'INDEXPROCESSOR_DOWNLOAD'                             => 'Error log :owner_id has been downloaded by :user',
            'SANDBOX_CREATED'                                     => 'Sandbox :owner_id has been created by :user',
            'SANDBOX_DELETED'                                     => 'Sandbox :owner_id has been deleted by :user',
            'TAGS_CREATED_COMPONENT_LANGUAGE'                     => 'Tag :owner_id has been assigned by :user in module :component with language :language',
            'JOBS_CREATED_COMPONENT_CATEGORY'                     => 'Job :owner_id has been created by :user in component :component in category :category',
            'ADDONPLAN_CREATED'                                   => 'Addon plan :owner_id has been created by :user',
            'DOMAIN_CREATED'                                      => 'Domain :owner_id has been added by :user',
            'PACKAGE_CREATED'                                     => 'Package :owner_id has been added by :user',
            'PACKAGE_DELETED'                                     => 'Package :owner_id has been deleted by :user',
            'CPANELACCOUNT_CREATED'                               => 'Cpanel account :owner_id has been created by :user',
            'PACKAGE_UPDATED'                                     => 'Package :owner_id has been updated by :user',
            'RESELLER_DELETED'                                    => 'Reseller :owner_id has been deleted by :user',
            'RESELLER_CREATED'                                    => 'Reseller :owner_id has been created by :user',
            'SERVER_UPDATED'                                      => 'Server :owner_id has been updated by :user',
            'SERVER_UPDATED_LOCATION'                             => 'Server :owner_id has been updated by :user in location :location',
            'SERVER_DELETED_LOCATION'                             => 'Server :owner_id has been deleted by :user in location :location',
            'PLAN_UPDATED'                                        => 'Plan :owner_id has been updated by :user',
            'REPORT_CREATED_BRAND_TYPE'                           => 'Report :owner_id has been created by :user in brand :brand and type :type',
            'BRANDS_UPDATED_OPTIONS_COLORS'                       => 'Brand :owner_id has been updated by :user with options identifier :options and colors identifier :colors',
            'BRANDS_UPDATED_OPTIONS'                              => 'Brand :owner_id has been updated by :user with options identifier :options',
            'BRANDS_DELETED_OPTIONS_COLORS'                       => 'Brand :owner_id has been deleted by :user with options identifier :options and colors identifier :colors',
            'BRANDS_DELETED_OPTIONS'                              => 'Brand :owner_id has been deleted by :user with options identifier :options',
            'MODULEROW_CREATED'                                   => 'Item :owner_id has been created by :user',
            'MODULEROW_UPDATED'                                   => 'Item :owner_id has been updated by :user',
            'MODULEROW_DELETED'                                   => 'Item :owner_id has been deleted by :user',
            'NOTIFICATIONS_CREATED_COMPONENT_TYPE_LEVEL_CATEGORY' => 'Notification :owner_id has been created by :user with type :type at level :level in category :category',
            'LOGSLOGINDEVICES_CREATED_LOG'                        => 'Device details :owner_id has been updated by :user with log :log',
            'TICKET_CREATED_BRAND'                                => 'New ticket :owner_id has been created by :user in brand :brand',
            'TAGS_DELETED_COMPONENT_LANGUAGE'                     => 'Tag :owner_id has been deleted by user :user in component :component with language :language',
            'APPAREA_DELETED'                                     => 'Application level :owner_id has been deleted by user :user',
            'APPAREA_UPDATED'                                     => 'Application level :owner_id has been updated by user :user',
            'APPAREA_CREATED'                                     => 'Application level :owner_id has been created by user :user',
            'CLIENTUSER_CREATED'                                  => 'Client :owner_id has been created by :user',
            'CLIENTCONTACTS_CREATED_CLIENT'                       => 'Contact :owner_id has been created by :user (client :client)',
            'CLIENTFIELDTYPES_CREATED_TYPE_CUSTOMFIELD'           => 'Custom field type :owner_id has been created by :user with type :type and customfield :customfield',
            'CLIENTSSTATUS_CREATED'                               => 'Client status :owner_id has been created by :user',
            'CLIENTSENTITYTYPE_CREATED'                           => 'Client type :owner_id has been created by :user',
            'IMPORTLOG_CREATED'                                   => 'New import log :owner_id has been created by :user',
            'PLAN_CREATED'                                        => 'New plan :owner_id has been created by :user',
            'ADDON_CREATED'                                       => 'New addon :owner_id has been created by :user',
            'CPANELACCOUNT_UPDATED'                               => 'Cpanel account :owner_id has been updated by :user',
            'CPANELACCOUNT_CREATED'                               => 'Cpanel account :owner_id has been created by :user',
            'DOMAIN_CREATED'                                      => 'Domain :owner_id has been created by :user',
            'ADDONPLAN_CREATED'                                   => 'Addon plan :owner_id has been created by :user',
            'CPANELACCOUNT_CREATED_SERVER_PACKAGE'                => 'Cpanel account :owner_id has been created by :user with server :server and package :package',
            'RESELLER_UPDATED_INFO'                               => 'Reseller :owner_id has been updated by :user with info :info',
            'CPANELACCOUNT_UPDATED_SERVER_PACKAGE'                => 'Cpanel account :owner_id has been updated by :user in server :server and package :package',
            'DOMAIN_UPDATED_CPANELACCOUNT'                        => 'Domain :owner_id has been updated by :user',
            'DOMAIN_CREATED_PARENT'                               => 'Domain :owner_id has been created by :user',
            'ADDONPLANQUANTITY_UPDATED'                           => 'Addon plan quantity :owner_id has been updated by :user',
            'ADDON_UPDATED'                                       => 'Addon :owner_id has been updated by :user',
            'IMPORT_CREATED_SERVER_PRIOTIRY'                      => 'Import :owner_id has been created by :user in server :server and priority :priotiry',
            'IMPORT_UPDATED_SERVER_CANCEL_USER_PRIOTIRY'          => 'Import :owner_id has been updated by :user using server :server, cancel :cancel, user :user and priority :priotiry',
            'CPANELACCOUNT_UPDATED_RESELLER_SERVER_PACKAGE'       => 'Cpanel account :owner_id has been updated by :user (reseller :reseller) and server :server with package :package',
            'CPANELACCOUNT_CREATED_RESELLER_SERVER_PACKAGE'       => 'Cpanel account :owner_id has been created by :user (reseller :reseller) and server :server with package :package',
            'CPANELACCOUNT_CREATED_RESELLER_PACKAGE'              => 'Cpanel account :owner_id has been created by :user (reseller :reseller) and package :package',
            'DOMAIN_CREATED_CPANELACCOUNT'                        => 'Domain :owner_id has been created by :user in cpanel account :CPANELACCOUNT',
            'IMPORT_UPDATED_SERVER_PARENT_PRIOTIRY'               => 'Import :owner_id has been updated by :user with server :server in parent :parent and priority :priotiry',
            'IMPORT_CREATED_SERVER_PARENT_PRIOTIRY'               => 'Import :owner_id has been created by :user with server :server in parent :parent and priority :priotiry',
            'IMPORT_UPDATED_SERVER_PRIOTIRY'                      => 'Import :owner_id has been updated by :user with server :server and priority :priotiry',
            'DOMAIN_CREATED_CPANELACCOUNT_PARENT'                 => 'Domain :owner_id has been created by :user in cpanel account :CPANELACCOUNT',
            'DOMAIN_UPDATED_CPANELACCOUNT_PARENT'                 => 'Domain :owner_id has been updated by :user in cpanel account :CPANELACCOUNT',
            'RESELLER_UPDATED'                                    => 'Reseller :owner_id has been updated by :user',
            'LOGSLOGINDEVICES_UPDATED'                            => 'Device configuration :owner_id has been updated by :user',
            'NOTIFICATIONS_UPDATED_COMPONENT_TYPE_LEVEL_CATEGORY' => 'Notification :owner_id has been updated by :user in component :component in type :type, level :level and category :category',
            'FIELD_DELETED_TYPES'                                 => 'Customfield :owner_id with type :types has been deleted by :user ',
            'DOMAIN_DELETED_CPANELACCOUNT'                        => 'Domain :owner_id in cpanel account :CPANELACCOUNT has been deleted by :user',
            'DOMAIN_DELETED'                                      => 'Domain :owner_id has been deleted by :user',
            'CPANELACCOUNT_DELETED_RESELLER_SERVER_PACKAGE'       => 'Cpanel account :owner_id attached to reseller :reseller with server :server and package :package has been deleted by :user',
            'CPANELACCOUNT_DELETED_RESELLER_PACKAGE'              => 'Cpanel account :owner_id attached to reseller :reseller in package :package has been deleted by :user',
            'DOMAIN_DELETED_CPANELACCOUNT_PARENT'                 => 'Domain :owner_id in cpanel account :CPANELACCOUNT has been deleted by :user',
            'CPANELACCOUNT_DELETED_SERVER_PACKAGE'                => 'Cpanel account :owner_id with server :server and package :package has been deleted by :user',
            'LOCATION_DELETED'                                    => 'Location :owner_id has been deleted by :user',
            'LOCATION_UPDATED'                                    => 'Location :owner_id has been updated by :user',
            'ADDONPLAN_DELETED_ADDON_PLAN'                        => 'Addon plan :owner_id in addon :addon and plan :plan has been deleted by :user ',
            'ADDONPLAN_CREATED_ADDON_PLAN'                        => 'Addon plan :owner_id in addon :addon and plan :plan has been created by :user ',
            'PLAN_DELETED'                                        => 'Plan :owner_id has been deleted by :user',
            'ADDON_DELETED'                                       => 'Addon :owner_id has been deleted by :user',
            'SMSMANAGER_DEFAULT_USERS'                            => 'Sms notification titled ":title" has been pushed to recipients :users and returns with code <span class="label-basic label-basic--danger">:code</span> and message ":message"',
            'MAILER_DEFAULT_USERS'                                => 'E-mail notification titled ":title" has been pushed to recipients :users and returns with code <span class="label-basic label-basic--danger">:code</span> and message ":message"',
            'USER_UPDATE_ALERT'                                   => 'User :owner_id has not been updated by :user.',
            'NOTIFICATIONS_CREATED_TYPE_CATEGORY'                 => 'Notification :owner_id has been created by :user with type :type in category :category',
            'OWNERUSER_UPDATED'                                   => 'Owner :owner_id has been updated by :user',
            'OWNERUSER_CREATED'                                   => 'Owner :owner_id has been created by :user',
            'OWNERSENTITYTYPE_CREATED'                            => 'Owner entity type :owner_id has been created by :user',
            'OWNERFIELDTYPES_CREATED_TYPE_CUSTOMFIELD'            => 'New customfield  :owner_id has been created by :user with type :type and in :customfield',
            'OWNERCONTACTS_CREATED_OWNER'                         => 'Contact :owner_id has been created by :user and assigned with owner :owner',
            'USERCONFIG_UPDATED_PROVIDER'                         => 'Two factor auth provider :owner_id has been updated by :user',
            'TRADEMARKDETAILS_CREATED_COUNTRY'                    => 'Trademark :owner_id has been imported by :user with country :country',
            'TRADEMARKDETAILS_UPDATED_COUNTRY'                    => 'Trademark :owner_id has been updated by :user with country :country',
            'TRADEMARKDETAILS_CREATED'                            => 'Trademark :owner_id has been created by :user',
            'TRADEMARKDETAILS_UPDATED'                            => 'Trademark :owner_id has been updated by :user',
            'LANGUAGES_UPDATED'                                   => 'Language :owner_id has been updated by :user',
            'LANGUAGES_DELETED'                                   => 'Language :owner_id has been deleted by :user',
            'LANGUAGES_CREATED'                                   => 'Language :owner_id has been created by :user',
            'TRADEMARKDETAILS_CREATED_COUNTRY_OWNER'              => 'Trademark :owner_id has been created manually by :user with country :country and owner :owner',
            'OWNERCONTACTS_CREATED_OWNER_OWNERS'                  => 'Contacts :owner_id has been assigned to owner :owner',
            'TRIGGER_DELETED'                                     => 'Event :owner_id has been deleted by :user',
            'TRIGGER_UPDATED'                                     => 'Event :owner_id has been updated by :user',
            'TRIGGER_CREATED'                                     => 'Event :owner_id has been created by :user',
            'USER_CREATED_ACTIVITY'                               => 'User :owner_id activity has been created by :user',
            'USER_UPDATED_ACTIVITY'                               => 'User activity :owner_id has been updated',
            'USER_DELETED_ACTIVITY'                               => 'User activity :owner_id has been deleted.',
            'CALENDAREVENTCOMMENTS_UPDATED_EVENT'                 => 'Comment :owner_id for event :event has been updated by :user',
            'CALENDAREVENTCOMMENTS_CREATED_EVENT'                 => 'Comment :owner_id for event :event has been created by :user',
);
