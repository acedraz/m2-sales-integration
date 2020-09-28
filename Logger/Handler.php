<?php
namespace Aislan\SalesIntegration\Logger;

use Aislan\SalesIntegration\Api\SystemInterface;
use Aislan\SalesIntegration\Model\Config;
use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

class Handler extends Base
{
    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::INFO;

    /**
     * File name
     * @var string
     */
    protected $fileName = Config::DIRECTTORY_VAR_LOG . Config::SALES_INTEGRATION_FILE_NAME;

    /**
     * @var SystemInterface
     */
    private $system;

    public function __construct(
        SystemInterface $system,
        DriverInterface $filesystem,
        $filePath = null,
        $fileName = null
    ) {
        parent::__construct(
            $filesystem,
            $filePath,
            $fileName
        );
        $this->system = $system;
        $this->setLogFileName();
    }

    public function setLogFileName()
    {
        if ($this->system->isEnabled()) {
            if ($this->system->getLogFile()) {
                $this->fileName = Config::DIRECTTORY_VAR_LOG . $this->system->getLogFile();
            }
        }
    }
}
