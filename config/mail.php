<?php
return [

    // 'driver'      => 'mail',
    // 'host'        => 'mail.smtp2go.com',
    // 'port'        => 465,
    // 'from'        => ['address' => 'info@mahratkom.aait-sa.com', 'name' => 'CORSATI'],
    // 'encryption'  => 'ssl',
    // 'username'    => 'info@mahratkom.aait-sa.com',
    // 'password'    => 'O;)cQ*Z^$Xoh',
    // 'sendmail'    => '/usr/sbin/sendmail -bs',

    'driver'     => 'sendmail',
    'host'       => 'mail.smtp2go.com',
    'port'       => 80,
    'from'       => array('address' => 'info@mahratkom.aait-sa.com' , 'name' => 'CORSATI'),
    'encryption' => 'tls',
    'username'   => 'info@mahratkom.aait-sa.com',
    'password'   => 'w70Ryj1lhFRM',
    'sendmail'   => '/usr/sbin/sendmail -bs',
    'pretend'    => false,
];
