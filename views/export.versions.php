<?php
    $wdiget = (new CWidget())
    ->setTitle(_('Agent Versions Export'))
    ->addItem(new CDiv($data['my_csv']))
    ->show();