#!/bin/bash
echo "Hold on dude, I'm starting the workers for your jobs. Don't Rush :-)";
echo ""
logger "Preparing forever-alone to start workers"

echo 'Iterating Workers..'

flag=1;
for worker in ../distributed/worker*
do
	echo "------------------------------------------------------------------------------------"
	echo "Initializing Worker: ".$flag
	php $worker &
	logger "Started Worker No. ". $flag
	echo "Started Worker No: ".$flag." : ". $worker
	flag=$[flag+1]
	echo "------------------------------------------------------------------------------------"
	echo ""
done

echo "Please wait! Let me aux to get you workers"
#echo "------------------------------------------------------------------------------------"
ps aux | grep "worker"
#echo "------------------------------------------------------------------------------------"

echo "------------------------------------------------------------------------------------"
echo "This script has been primarily written by Hamza Waqas (Development Lead) at Logica."
echo "Forever-alone helps to resume all the workers of Gearman  over clusters."
echo "Basically written for internal use to start Job Workers."
echo "Current Script Version is: v0.1"
echo "Last Modified: 30 Aug, 2013"
echo "Credits: Abbas Ahmed (CTO) at Logica"
echo "(Note: You may stop all workers using forever-alone-died.sh"
echo "If any issue persist, please report at: "
echo "		hamza.waqas@logicait.pk"
echo "		abbas@cyberlogics.com"
echo "------------------------------------------------------------------------------------"
echo "Thanks for starting Workers :-P"
