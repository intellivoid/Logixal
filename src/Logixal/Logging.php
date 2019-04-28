<?php


    namespace Logixal;


    use Logixal\Abstracts\MessageTypes;

    /**
     * Class Logging
     * @package Logixal
     */
    class Logging
    {
        /**
         * Writes to the log as a information entry
         *
         * @param string $module_name
         * @param string $message
         * @param MessageTypes|string $type
         * @param bool $include_sub
         * @param string $sub_name
         */
        private static function write_entry(string $module_name, string $message, string $type, bool $include_sub = false, string $sub_name = 'none')
        {
            $unix_timestamp = time();
            $str_timestamp = date('h:i:s', $unix_timestamp);

            $entry = sprintf("%s %s => %s\r\n", $str_timestamp, $type, $message);
            $j_entry = json_encode(array(
                'timestamp' => $unix_timestamp,
                'type' => 'information',
                'entry' => $message
            ));
            $j_entry = sprintf('%s\r\n' . $j_entry);

            $log_file = fopen(Utilities::getLogLocation($module_name, 'log'), 'r');
            fwrite($log_file, $entry);
            fclose($log_file);

            $jlog_file = fopen(Utilities::getLogLocation($module_name, 'jlog'), 'r');
            fwrite($jlog_file, $j_entry);
            fclose($jlog_file);

            if($include_sub == true)
            {
                $log_file = fopen(Utilities::getSubLogLocation($module_name, $sub_name, 'log'), 'r');
                fwrite($log_file, $entry);
                fclose($log_file);
            }
        }

        /**
         * Writes a information entry
         *
         * @param string $module_name
         * @param string $message
         */
        public static function information(string $module_name, string $message)
        {
            self::write_entry(
                $module_name, $message,
                MessageTypes::Information, false
            );
        }

        /**
         * Writes a warning entry
         *
         * @param string $module_name
         * @param string $message
         */
        public static function warning(string $module_name, string $message)
        {
            self::write_entry(
                $module_name, $message,
                MessageTypes::Warning, false
            );
        }

        /**
         * Writes a error entry
         *
         * @param string $module_name
         * @param string $message
         */
        public static function error(string $module_name, string $message)
        {
            self::write_entry(
                $module_name, $message,
                MessageTypes::Error,
                true, 'errors'
            );
        }

        /**
         * Writes a success entry
         *
         * @param string $module_name
         * @param string $message
         */
        public static function success(string $module_name, string $message)
        {
            self::write_entry(
                $module_name, $message,
                MessageTypes::Success, false
            );
        }

    }