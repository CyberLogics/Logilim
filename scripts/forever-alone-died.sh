echo "Preparing to kill all workers by -9"
logger "Preparing to kill all workers by -9"

echo ""

echo "-------------------------------------------------------"
ps -ef | grep "worker*" | awk '{print $2}' | xargs kill -9
#echo "Killed"
echo "-------------------------------------------------------"

echo ""
echo "Preparing aux for you to verify..."
ps aux | grep "worker*"


echo ""
echo "Process has been completed successfully!"
