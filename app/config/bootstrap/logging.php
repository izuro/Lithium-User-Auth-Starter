<?php
use lithium\analysis\Logger;

// Logger::config(
//     array ('default' =>
//         array(
//             'production' => array(
//                 'adapter' => 'File',
//                 'priority' => array('emergency', 'alert', 'critical', 'error')
//             ),
//             'development' => array(
//                 'adapter' => 'File',
//                 'priority' => array('emergency', 'alert', 'critical', 'error', 'warning')
//             ),
//             'test' => array(
//                 'adapter' => 'File',
//                 'priority' => array('emergency')
//             )
//     )
// ));
Logger::config(array(
    'default' => array('adapter' => 'Syslog'),
    'problems' => array(
        'adapter' => 'File',
        'priority' => array('emergency', 'alert', 'critical', 'error')
    )
));
?>