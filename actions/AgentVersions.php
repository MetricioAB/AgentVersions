<?php

    namespace Modules\agentversions\Actions;
    require_once 'AgentVersionsHelper.php';
    use AgentVersionsHelper;
    use CController;
    use CControllerResponseData;
    use CControllerResponseFatal;
    use CControllerResponseRedirect;
    use CRoleHelper;
    use CMessageHelper;
    
    class AgentVersions extends CController{
        
        public function init(): void {
            $this->disableSIDvalidation();
        }
        protected function checkInput(): bool {
            $fields = [
                'name' =>			'string',
                'hostid' =>			'string',
                'itemid' =>				'string',
                'lastvalue' =>			'string'
            ];
            $ret = $this->validateInput($fields);
            if(!$ret){
                $this->setResponse(new CControllerResponseFatal());
            }
            return $ret;
        }
        protected function checkPermissions(): bool {
            return $this->checkAccess(CRoleHelper::UI_REPORTS_SYSTEM_INFO);
        }
        
        protected function doAction(): void {
            $this->checkInput();
            $data = AgentVersionsHelper::getDataFromApi();
            if (!$data){
                CMessageHelper::setErrorTitle(_('Failed to load'));
                $this->setResponse(new CControllerResponseRedirect('zabbix.php?action=dashboard.view'));
            }
            $response = new CControllerResponseData($data);
            $this->setResponse($response);

        }
    }