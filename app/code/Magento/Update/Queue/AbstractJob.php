<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Update\Queue;

use Magento\Update\Status;
use Magento\Update\MaintenanceMode;

/**
 * Magento updater application abstract job.
 */
abstract class AbstractJob
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $params;

    /**
     * @var Status
     */
    protected $jobStatus;
    
    /**
     * @var MaintenanceMode
     */
    protected $maintenanceMode;

    /**
     * Initialize job instance.
     *
     * @param string $name
     * @param array $params
     * @param Status|null $status
     * @param MaintenanceMode|null $maintenanceMode
     */
    public function __construct($name, array $params, Status $status = null, MaintenanceMode $maintenanceMode = null)
    {
        $this->name = $name;
        $this->params = $params;
        $this->jobStatus = $status ? $status : new Status();
        $this->maintenanceMode = $maintenanceMode ? $maintenanceMode : new MaintenanceMode();
    }

    /**
     * Get job name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get string representation of a job.
     *
     * @return string
     */
    public function __toString()
    {
        return '<' . $this->name . '>' . json_encode($this->params);
    }

    /**
     * Execute job.
     *
     * @return $this
     * @throws \RuntimeException
     */
    abstract public function execute();
}