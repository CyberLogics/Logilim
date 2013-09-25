<?php

$gmc= new GearmanClient();
$gmc->addServer("192.168.1.8",4730);
for ($i = 1; $i <= 10; $i++) {
    $gmc->addTaskBackground("ping".$i,array(), null, $i);
    $gmc->setCompleteCallback('complete_pong');
}

if (! $gmc->runTasks())
{
    echo "ERROR " . $gmc->error() . "\n";
    exit;
}

echo "Process has been fired. You may check your logs in 'monitor' directory."."\n";


function complete_pong($task) {
    echo sprintf("Pong Index(%d) : %s"."\n",$task->unique(), $task->data());
}