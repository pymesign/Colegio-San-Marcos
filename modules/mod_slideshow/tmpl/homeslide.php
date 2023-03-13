<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_slideshow
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

if (!$list) {
    return;
}

?>
<section class="home-slider">
    <div class="event-gallery">
        <?php foreach ($list as $item) : ?>
            <div class="mod-slideshow__item" itemscope itemtype="https://schema.org/Article">
                <?php require ModuleHelper::getLayoutPath('mod_slideshow', '_slide'); ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>