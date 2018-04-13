<?php

namespace Classes;

// mono log
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

define('__ROOT__', dirname(dirname(__FILE__)));
require(__ROOT__ . "/vendor/autoload.php");


/**
 * Class AbstractClass
 *
 * @package Classes
 */
class AbstractClass
{
    /**
     * PSR 3 Audit Log
     *
     * @var object
     */
    public $monoLog;
    /**
     * Detailed debug information
     */
    const LOG_DEBUG = 100;

    /**
     * Interesting events.
     * Examples: User logs in, SQL logs.
     */
    const LOG_INFO = 200;

    /**
     * Normal but significant events.
     */
    const LOG_NOTICE = 250;

    /**
     * Exceptional occurrences that are not errors.
     * Examples: Use of deprecated APIs, poor use of an API, undesirable things that are not necessarily wrong.
     */
    const LOG_WARNING = 300;

    /**
     * Runtime errors that do not require immediate action but should typically be logged and monitored.
     */
    const LOG_ERROR = 400;

    /**
     * Critical conditions.
     * Example: Application component unavailable, unexpected exception.
     */
    const LOG_CRITICAL = 500;

    /**
     * Action must be taken immediately.
     * Example: Entire website down, database unavailable, etc. This should trigger the SMS alerts and wake you up.
     */
    const LOG_ALERT = 550;

    /**
     * Emergency: system is unusable.
     */
    const LOG_EMERGENCY = 600;

    /**
     * AbstractClass constructor.
     * @note api on function level only
     *
     * @throws \Exception
     */
    public function __construct()
    {

    }

    /**
     * @param int $mode
     * @param null $message
     * @throws \Exception
     */
    function setMonolog($mode = 100, $message = null)
    {
        // check file exist
        $message = preg_replace('/\\s/', ' ', $message);

        $path = __ROOT__ . '/Log/' . date("Y-m-d") . ".txt";
        $logFileStream = new Logger('System Log');
        $logFileStream->pushHandler(new StreamHandler($path, $mode));


        switch ($mode) {
            case self::LOG_DEBUG:
                try {
                    $logFileStream->addDebug($message);
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
                break;
            case self::LOG_INFO:
                try {
                    $logFileStream->addInfo($message);
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
                break;
            case self::LOG_NOTICE:
                try {
                    $logFileStream->addNotice($message);
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
                break;
            case self::LOG_WARNING:
                try {
                    $logFileStream->addWarning($message);
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
                break;
            case self::LOG_ERROR:
                try {
                    $logFileStream->addError($message);
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
                break;
            case self::LOG_CRITICAL:
                try {
                    $logFileStream->addCritical($message);
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
                break;
            case self::LOG_ALERT:
                try {
                    $logFileStream->addAlert($message);
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
                break;
            case self::LOG_EMERGENCY:
                try {
                    $logFileStream->addEmergency($message);
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
                break;
        }
    }


}


