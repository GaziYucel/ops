<?php

/**
 * @file classes/publication/Publication.inc.php
 *
 * Copyright (c) 2016-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class Publication
 * @ingroup publication
 *
 * @see PublicationDAO
 *
 * @brief Class for Publication.
 */

namespace APP\publication;

use PKP\publication\PKPPublication;

use APP\file\PublicFileManager;

class Publication extends PKPPublication
{
    public const PUBLICATION_RELATION_NONE = 1;
    public const PUBLICATION_RELATION_SUBMITTED = 2;
    public const PUBLICATION_RELATION_PUBLISHED = 3;

    /**
     * Get the URL to a localized cover image
     *
     * @param int $contextId
     *
     * @return string
     */
    public function getLocalizedCoverImageUrl($contextId)
    {
        $coverImage = $this->getLocalizedData('coverImage');

        if (!$coverImage) {
            return '';
        }

        $publicFileManager = new PublicFileManager();

        return join('/', [
            Application::get()->getRequest()->getBaseUrl(),
            $publicFileManager->getContextFilesPath($contextId),
            $coverImage['uploadName'],
        ]);
    }
}

if (!PKP_STRICT_MODE) {
    class_alias('\APP\publication\Publication', '\Publication');
    foreach (['PUBLICATION_RELATION_NONE', 'PUBLICATION_RELATION_SUBMITTED', 'PUBLICATION_RELATION_PUBLISHED'] as $constantName) {
        define($constantName, constant('\Publication::' . $constantName));
    }
}
