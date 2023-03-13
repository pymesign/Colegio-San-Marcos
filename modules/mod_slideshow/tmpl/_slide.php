<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_slideshow
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

// Get the images
$images = json_decode($item->images);
?>
<div class="single-slider overlay" style="background-image:url(<?php echo $images->image_intro; ?>)">
    <div class="row slide" style="justify-content: <?php echo $params->get('eje-horizontal'); ?>">
        <div class="col-lg-<?php echo $params->get('ancho'); ?>" style="align-items
        : <?php echo $params->get('eje-vertical'); ?>">
            <div class="slider-text text-<?php echo $params->get('alineacion'); ?>">
                <div class="wrapper">
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
                        <?php //echo $item->introtext; ?>
                        <?php echo '<p>' . strip_tags($item->introtext) . '</p>'; ?>
                    <?php endif; ?>

                    <?php echo $item->afterDisplayContent; ?>

                    <?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')): ?>
                        <?php echo LayoutHelper::render('joomla.content.readmore', array('item' => $item, 'params' => $item->params, 'link' => $item->link)); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>