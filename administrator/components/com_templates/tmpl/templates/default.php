<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_templates
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.multiselect');

$user      = JFactory::getUser();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo JRoute::_('index.php?option=com_templates&view=templates'); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row">
		<div id="j-sidebar-container" class="col-md-2">
			<?php echo $this->sidebar; ?>
		</div>
		<div class="col-md-10">
			<div id="j-main-container" class="j-main-container">
				<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this, 'options' => array('selectorFieldName' => 'client_id'))); ?>
				<?php if ($this->total > 0) : ?>
					<table class="table" id="template-mgr">
						<thead>
							<tr>
								<th scope="col" class="col1template d-none d-md-table-cell" style="width:20%">
									<?php echo JText::_('COM_TEMPLATES_HEADING_IMAGE'); ?>
								</th>
								<th scope="col" style="width:30%">
									<?php echo JHtml::_('searchtools.sort', 'COM_TEMPLATES_HEADING_TEMPLATE', 'a.element', $listDirn, $listOrder); ?>
								</th>
								<th scope="col" style="width:10%" class="d-none d-md-table-cell text-center">
									<?php echo JText::_('JVERSION'); ?>
								</th>
								<th scope="col" style="width:10%" class="d-none d-md-table-cell text-center">
									<?php echo JText::_('JDATE'); ?>
								</th>
								<th scope="col" style="width:25%" class="d-none d-md-table-cell text-center">
									<?php echo JText::_('JAUTHOR'); ?>
								</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan="5">
									<?php echo $this->pagination->getListFooter(); ?>
								</td>
							</tr>
						</tfoot>
						<tbody>
						<?php foreach ($this->items as $i => $item) : ?>
							<tr class="row<?php echo $i % 2; ?>">
								<td class="text-center d-none d-md-table-cell">
									<?php echo JHtml::_('templates.thumb', $item->element, $item->client_id); ?>
									<?php echo JHtml::_('templates.thumbModal', $item->element, $item->client_id); ?>
								</td>
								<th scope="row" class="template-name">
									<a href="<?php echo JRoute::_('index.php?option=com_templates&view=template&id=' . (int) $item->extension_id . '&file=' . $this->file); ?>">
										<?php echo JText::sprintf('COM_TEMPLATES_TEMPLATE_DETAILS', ucfirst($item->name)); ?></a>
									<div>
									<?php if ($this->preview && $item->client_id == '0') : ?>
										<a href="<?php echo JRoute::_(JUri::root() . 'index.php?tp=1&template=' . $item->element); ?>" target="_blank">
										<?php echo JText::_('COM_TEMPLATES_TEMPLATE_PREVIEW'); ?>
										</a>
									<?php elseif ($item->client_id == '1') : ?>
										<?php echo JText::_('COM_TEMPLATES_TEMPLATE_NO_PREVIEW_ADMIN'); ?>
									<?php else : ?>
										<span class="hasTooltip" title="<?php echo JHtml::_('tooltipText', 'COM_TEMPLATES_TEMPLATE_NO_PREVIEW_DESC'); ?>"><?php echo JText::_('COM_TEMPLATES_TEMPLATE_NO_PREVIEW'); ?></span>
									<?php endif; ?>
									</div>
								</th>
								<td class="small d-none d-md-table-cell text-center">
									<?php echo $this->escape($item->xmldata->get('version')); ?>
								</td>
								<td class="small d-none d-md-table-cell text-center">
									<?php echo $this->escape($item->xmldata->get('creationDate')); ?>
								</td>
								<td class="d-none d-md-table-cell text-center">
									<?php if ($author = $item->xmldata->get('author')) : ?>
										<div><?php echo $this->escape($author); ?></div>
									<?php else : ?>
										&mdash;
									<?php endif; ?>
									<?php if ($email = $item->xmldata->get('authorEmail')) : ?>
										<div><?php echo $this->escape($email); ?></div>
									<?php endif; ?>
									<?php if ($url = $item->xmldata->get('authorUrl')) : ?>
										<div><a href="<?php echo $this->escape($url); ?>"><?php echo $this->escape($url); ?></a></div>
									<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php endif; ?>

				<input type="hidden" name="task" value="">
				<input type="hidden" name="boxchecked" value="0">
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</div>
	</div>
</form>
