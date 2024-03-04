<?php
$action = 'versions.export';
$form = (new CForm())->setName('versions');
$table = (new CTableInfo())
    ->setHeader([
        _('Host Id'),
        _('Host'),
        _('Agent Version'),
        _('Item name'),
        _('Item Id'),
    ]);
foreach ($data as $d) {
    $name = new CLink($d['name'], 'zabbix.php?action=host.edit&hostid=' . $d['hostid']);
    $itemname = new CLink($d['itemname'], 'items.php?form=update&hostid=' . $d['hostid'] . '&itemid=' . $d['itemid'] . '&context=host');

    $table->addRow([
        [
            $d['hostid']
        ],
        [
            $name
        ],
        [
            $d['lastvalue']
        ],
        [
            $itemname
        ],
        [
            $d['itemid']
        ]
    ]);
}

$form->addItem([
    $table,
    (new CButton('export', 'Export'))
        ->setMenuPopup(
            [
                'type' => 'dropdown',
                'data' => [
                    'submit_form' => true,
                    'items' => [
                        [
                            'label' => _('JSON'),
                            'url' => (new CUrl('zabbix.php'))
                                ->setArgument('action', $action)
                                ->setArgument('format', 'json')
                                ->getUrl()
                        ],
                        [
                            'label' => _('CSV'),
                            'url' => (new CUrl('zabbix.php'))
                                ->setArgument('action', $action)
                                ->setArgument('format', 'csv')
                                ->getUrl()
                        ]
                    ]
                ]
            ]
        )

]);
$widget = (new CWidget())
    ->setTitle(_('Agent Versions'))
    ->addItem($form)
    ->show();
