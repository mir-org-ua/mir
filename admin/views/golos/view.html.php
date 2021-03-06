<?php
/**
 * JUIdei
 *
 * @package          Joomla.Site
 * @subpackage       com_mir
 *
 * @author           Denys Nosov, denys@joomla-ua.org
 * @copyright        2016-2017 (C) Joomla! Ukraine, http://joomla-ua.org. All rights reserved.
 * @license          GNU General Public License version 2 or later; see LICENSE.txt
 * @license          GNU/GPL based on AceIdei www.joomace.net
 */

/**
 * @copyright      2009-2011 Mijosoft LLC, www.mijosoft.com
 * @license        GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * @license        GNU/GPL based on AceIdei www.joomace.net
 *
 * @copyright (C)  2009 - 2011 Hristo Genev All rights reserved
 * @license        http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link           http://www.afactory.org
 */

defined('_JEXEC') or die('Restricted access');

class JUIdeiViewVotes extends JUIdeiView
{
    /**
     * @param null $tpl
     */
    function display($tpl = null)
    {
        $doc = JFactory::getDocument();
        $doc->addStyleSheet('components/com_mir/assets/css/mir.css');

        $title = $this->get('Title');

        $t_title = ($title) ? JText::_('COM_MIR_VOTES_FOR') . ': ' . $title : JText::_('COM_MIR_SELECT_idea');
        JToolBarHelper::title($t_title, 'mir');
        JToolBarHelper::deleteList(JText::_('COM_MIR_DELETE_CONFIRM'), "deleteVotes", JText::_('COM_MIR_DELETE'));
        JToolBarHelper::divider();
        JToolBarHelper::preferences('com_mir', 500);

        $this->mainframe = JFactory::getApplication();
        $this->option    = JRequest::getWord('option');

        $filter_order     = $this->mainframe->getUserStateFromRequest($this->option . '.votes.filter_order', 'filter_order', 'v.date', 'cmd');
        $filter_order_Dir = $this->mainframe->getUserStateFromRequest($this->option . '.votes.filter_order_Dir', 'filter_order_Dir', '', 'word');
        $search           = $this->mainframe->getUserStateFromRequest($this->option . '.votes.search', 'search', '', 'string');

        // Get data from the model
        $lists = $this->get('List');

        // table ordering
        $lists['order_Dir'] = $filter_order_Dir;
        $lists['order']     = $filter_order;

        // search filter
        $lists['search'] = $search;

        $this->title      = $title;
        $this->lists      = $lists;
        $this->votes      = $this->get('Data');
        $this->pagination = $this->get('Pagination');
        $this->idea_id    = JRequest::getInt('id', 0);

        parent::display($tpl);
    }
}