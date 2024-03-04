<?php
namespace Modules\agentversions\Actions;

require_once 'AgentVersionsHelper.php';
use CController;
use CRoleHelper;
use CControllerResponseRedirect;
use CMessageHelper;
use AgentVersionsHelper;
use CControllerResponseFatal;

class ExportVersions extends CController
{
    protected function checkPermissions(): bool
    {
        return $this->checkAccess(CRoleHelper::UI_REPORTS_SYSTEM_INFO);
    }
    protected function checkInput(): bool
    {
        $fields = [
            'format' => 'string'
        ];
        $ret = $this->validateInput($fields);
        if (!$ret) {
            $this->setResponse(new CControllerResponseFatal());
        }
        return $ret;

    }


    protected function doAction(): void
    {
        $format = $this->getInput('format');
        AgentVersionsHelper::log_to_console($format);
        $backurl = 'zabbix.php?action=agent.versions';
        $api_data = AgentVersionsHelper::getDataFromApi();
        AgentVersionsHelper::log_to_console("RESPONSE FROM EXPORT:");
        AgentVersionsHelper::log_to_console($api_data);

        if ($api_data) {
            $json_string = json_encode($api_data);
            if ($format == 'json'){
                AgentVersionsHelper::ExportToJson($json_string);
            }
            else{
                AgentVersionsHelper::ExportToCsv($json_string);
            }
        } else {
            $response = new CControllerResponseRedirect($this->getInput($backurl));
            CMessageHelper::setErrorTitle(_('Export failed'));
        }
        $this->setResponse($response);
    }
}