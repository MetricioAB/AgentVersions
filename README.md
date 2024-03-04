# Agent Versions front end Module 

This module is compatible with Zabbix 6.0.

## Install

To use this in a Zabbix installation download the files and put them inside /usr/share/zabbix/modules folder on the Zabbix server.

In the Zabbix front end go to Administration->General->Modules and press Scan Directory, the module should appear as Agent Versions.

Under the reports tab there should now be a new entry called Agent Versions.

Note that this module looks at the last value of agent.version key, this means that if there is no data recieved on that key the host will not show up. 

## Use

Can be used to get a quick overview of agent versions on all hosts or press the export button to export to either csv or json and view it excel or other tool. 

## Contrib

If you want to develop the tool further the best way is to have a VM or test machine with zabbix installed. Then follow the install instructions above. You can use VS Code with SSH-Remote to develop directly on the server and reap the benefits of code completion etc. or any other code editor you like.

If you don't have a Zabbix Server I recommend downloading the Zabbix source code from [here](https://git.zabbix.com/) and then put the module code inside ui/modules and then use whatever code editor you like and you should get proper code completion etc.

PR's are always welcome! 

## Links

[Zabbix Frontend Modules](https://www.zabbix.com/documentation/current/en/manual/extensions/frontendmodules)

[Zabbix develop frontend modules](https://www.zabbix.com/documentation/current/en/devel/modules)

