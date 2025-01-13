<?php

/**
 * @file classes/orcid/actions/SendSubmissionToOrcid.php
 *
 * Copyright (c) 2014-2024 Simon Fraser University
 * Copyright (c) 2000-2024 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class SendSubmissionToOrcid
 *
 * @brief Compile and trigger deposits of submissions to ORCID.
 */

namespace APP\orcid\actions;

use APP\orcid\OrcidWork;
use PKP\orcid\actions\PKPSendSubmissionToOrcid;
use PKP\orcid\PKPOrcidWork;

class SendSubmissionToOrcid extends PKPSendSubmissionToOrcid
{
    /**
     * @inheritDoc
     */
    protected function getOrcidWork(array $authors): ?PKPOrcidWork
    {
        return new OrcidWork($this->publication, $this->context, $authors);
    }

    /**
     * @inheritDoc
     */
    protected function canDepositSubmission(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     * Override with empty implementation since OPS does not have reviews
     */
    public function depositReviewsForSubmission(): void
    {
    }
}
