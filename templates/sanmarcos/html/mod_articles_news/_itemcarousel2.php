<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

$images = json_decode($item->images);

$db = JFactory::getDbo();
$query = $db->getQuery(true)
    ->select($db->quoteName('title'))
    ->from($db->quoteName('#__categories'))
    ->where($db->quoteName('id') . ' = ' . $item->catid);
$db->setQuery($query);
$category = $db->loadResult();
?>
<div class="single-feature">
    <div class="feature-head" style="background-image: url(<?php echo $images->image_intro; ?>);">
    </div>
    <div class="module-content">
        <?php if ($params->get('item_title')): ?>
            <?php $item_heading = $params->get('item_heading', 'h4'); ?>
            <<?php echo $item_heading; ?> class="newsflash-title">
                <?php if ($item->link !== '' && $params->get('link_titles')): ?>
                    <a href="<?php echo $item->link; ?>">
                        <?php echo $item->title; ?>
                    </a>
                <?php else: ?>
                    <?php echo $item->title; ?>
                <?php endif; ?>
            </<?php echo $item_heading; ?>>
        <?php endif; ?>

        <?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)): ?>
            <figure class="newsflash-image">
                <?php echo LayoutHelper::render(
                    'joomla.html.image',
                    [
                        'src' => $item->imageSrc,
                        'alt' => $item->imageAlt,
                    ]
                ); ?>
                <?php if (!empty($item->imageCaption)): ?>
                    <figcaption>
                        <?php echo $item->imageCaption; ?>
                    </figcaption>
                <?php endif; ?>
            </figure>
        <?php endif; ?>

        <?php if (!$params->get('intro_only')): ?>
            <?php echo $item->afterDisplayTitle; ?>
        <?php endif; ?>

        <?php echo $item->beforeDisplayContent; ?>

        <?php if ($params->get('show_introtext', 1)): ?>
            <?php $string = substr($item->introtext, 0, 100); ?>
            <?php echo '<p><a href="' . $item->link . '">' . strip_tags($string) . '...</a></p>'; ?>
        <?php endif; ?>

        <?php echo $item->afterDisplayContent; ?>

        <?php echo '<div class="button"><a class="btn" href="' . $item->link . '">' . $item->linkText . '<i class="fa fa-angle-double-right"></i></a></div>'; ?>
    </div>
</div>