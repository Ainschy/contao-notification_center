<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  terminal42 gmbh 2013
 * @license    LGPL
 */

namespace NotificationCenter\Model\Gateway;

use NotificationCenter\BagType\BagTypeInterface;
use NotificationCenter\Model\Language;
use NotificationCenter\Model\Notification;

class Base extends Gateway
{
    /**
     * The notification bag type
     * @var BagTypeInterface
     */
    protected $objBagType = null;

    /**
     * The notification model
     * @var Notification
     */
    protected $objNotification = null;

    /**
     * The language model
     * @var Language
     */
    protected $objLanguage = null;

    /**
     * Set notification bag type and models
     * @param   BagTypeInterface
     * @param   Notification
     * @param   Language
     * @param   Gateway
     */
    public function __construct(
        BagTypeInterface $objBagType,
        Notification $objNotification,
        Language $objLanguage
    )
    {
        $this->objBagType           = $objBagType;
        $this->objNotification      = $objNotification;
        $this->objLanguage          = $objLanguage;
    }

    /**
     * Gets the bag type
     * @return  BagTypeInterface
     */
    public function getBagType()
    {
        return $this->objBagType;
    }

    /**
     * Gets the notification
     * @return  BagTypeInterface
     */
    public function getNotification()
    {
        return $this->objNotification;
    }

    /**
     * Gets the language
     * @return  Language
     */
    public function getLanguage()
    {
        return $this->objLanguage;
    }

    /**
     * Gets an array of valid attachments
     * @param   array Tokens
     * @return  array
     */
    protected function getAttachments($arrTokens)
    {
        $arrAttachments = array();

        if (!$this->objLanguage->attachments) {
            return $arrAttachments;
        }

        $arrAttachmentTokens = trimsplit(',', $this->objLanguage->attachments);
        foreach ($arrAttachmentTokens as $strToken) {
            $strFile = \String::parseSimpleTokens($strToken, $arrTokens);

            if (is_file($strFile)) {
                $arrAttachments[$strToken] = $strFile;
            }
        }

        return $arrAttachments;
    }
}