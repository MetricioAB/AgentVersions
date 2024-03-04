<?php
       namespace Modules\agentversions;
       require_once dirname(__FILE__).'/../../include/classes/core/APP.php';
       
       use APP;

       
       class Module extends \Core\CModule {
       
           public function init(): void {
               APP::Component()->get('menu.main')
               ->findOrAdd(_('Reports'))
               ->getSubmenu()
               ->insertAfter('Notifications', (new \CmenuItem(_('Agent Versions')))
               ->setAction('agent.versions'));
           }
       }