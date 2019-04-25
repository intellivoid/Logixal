<?php

    namespace Logixal;


    use Logixal\Exceptions\ConfigurationNotFoundException;

    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Abstracts' . DIRECTORY_SEPARATOR . 'ExceptionCodes.php');

    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'ConfigurationNotFoundException.php');

    /**
     * Class Logixal
     * @package Logixal
     */
    class Logixal
    {
        /**
         * @var array|bool
         */
        private $Configuration;

        /**
         * @var mixed
         */
        private $LoggingDirectory;

        /**
         * Logixal constructor.
         * @throws ConfigurationNotFoundException
         */
        public function __construct()
        {
            if(file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'configuration.ini') == false)
            {
                throw new ConfigurationNotFoundException();
            }

            $this->Configuration = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . 'configuration.ini');

            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
            {
                $this->LoggingDirectory = $this->Configuration['Windows_LoggingDirectory'];
            }
            else
            {
                $this->LoggingDirectory = $this->Configuration['Unix_LoggingDirectory'];
            }
        }

        /**
         * @return mixed
         */
        public function getLoggingDirectory()
        {
            return $this->LoggingDirectory;
        }
    }