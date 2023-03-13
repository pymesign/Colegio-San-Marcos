<?php

/**
 * @package     Joomla.Site
 * @subpackage  Templates.sanmarcos
 *
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

// Get params for slideshow homepage
// Get a db connection.
$db = JFactory::getDbo();

// Create a new query object.
$query = $db->getQuery(true);

// Select all records from the user profile table where key begins with "custom.".
// Order it by the ordering field.
$query->select($db->quoteName(array('params')));
$query->from($db->quoteName('#__modules'));
$query->where($db->quoteName('params') . ' LIKE ' . $db->quote('%homeslide%'));

// Reset the query using our newly populated query object.
$db->setQuery($query);

// Load the results as a list of stdClass objects (see later for more options on retrieving data).
$results = $db->loadObject();

//print_r($results);

foreach ($results as $item) {

    $manage = json_decode($item, true);
    $autoplaySlideshow = $manage['autoplay'];

}

// Get params for Carousel Homepage

$displayImages = $this->params->get('displayCarouselHomepage');
$autoplayCarousel = $this->params->get('autoplayCarouselHomepage');

?>

<script>
    (function ($) {
        "use strict";
        $(document).on('ready', function () {

        /*=====================================
            Preloader JS
        ======================================*/
        $('.blog-slider').owlCarousel({
            items: 2,
            autoplay: <?php echo $autoplayCarousel; ?>,
            autoplayTimeout: 3500,
            smartSpeed: 600,
            autoplayHoverPause: true,
            margin: 15,
            loop: true,
            merge: true,
            nav: true,
            navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
            dots: true,
            responsive: {
                300: {
                    items: 1,
                    nav: false,
                },
                480: {
                    items: 2,
                    nav: false,
                },
                768: {
                    items: 2,
                    nav: false,
                },
                1170: {
                    items:<?php echo $displayImages; ?>,
            },
        }
        });

        /*====================================
			Event Gallery JS
		======================================*/ 
		$('.event-gallery').owlCarousel({
			items:1,
			autoplay:<?php echo $autoplaySlideshow; ?>,
			autoplayTimeout:3500,
			smartSpeed: 600,
			autoplayHoverPause:true,
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			margin:0,
			loop:true,
			merge:true,
			nav:true,
			navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
			dots:false,
		});	
    });
}) (jQuery);
</script>