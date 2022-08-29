<?php
define('QUEUE_SERVER_INPUT', '/tmp/queueserver-input');
define('STATUS_STOPPED', 0);
define('STATUS_IN_PROGRESS', 1);
define('STATUS_DONE', 2);

define('STATUSES', [
   STATUS_STOPPED => 'Stopped',
   STATUS_IN_PROGRESS => 'In Progress',
   STATUS_DONE => 'Done'
]);