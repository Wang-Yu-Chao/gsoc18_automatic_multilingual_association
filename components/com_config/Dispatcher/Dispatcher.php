<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Config\Site\Dispatcher;

defined('_JEXEC') or die;

use Joomla\CMS\Access\Exception\NotAllowed;

/**
 * Dispatcher class for com_config
 *
 * @since  4.0.0
 */
class Dispatcher extends \Joomla\CMS\Dispatcher\Dispatcher
{
	/**
	 * Method to check component access permission
	 *
	 * @since   4.0.0
	 *
	 * @return  void
	 *
	 * @throws  Exception|Notallowed
	 */
	protected function checkAccess()
	{
		parent::checkAccess();

		if (!$this->app->getIdentity()->authorise('core.admin'))
		{
			throw new Notallowed($this->app->getLanguage()->_('JERROR_ALERTNOAUTHOR'), 403);
		}
	}
}
