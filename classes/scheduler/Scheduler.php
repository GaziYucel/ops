<?php

/**
 * @file classes/scheduler/Scheduler.php
 *
 * Copyright (c) 2024 Simon Fraser University
 * Copyright (c) 2024 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class Scheduler
 *
 * @brief Core scheduler class, responsible to register scheduled tasks specific for the application
 */

namespace APP\scheduler;

use APP\tasks\UsageStatsLoader;
use PKP\scheduledTask\PKPScheduler;

class Scheduler extends PKPScheduler
{
    /**
     * @copydoc \PKP\scheduledTask\PKPScheduler::registerSchedules
     */
    public function registerSchedules(): void
    {
        parent::registerSchedules();

        $this
            ->schedule
            ->call(fn () => (new UsageStatsLoader([]))->execute())
            ->daily()
            ->name(UsageStatsLoader::class)
            ->withoutOverlapping();
    }
}
