<?php
/**
 * Archive template
 *
 * DISCLAIMER
 *
 * Do not edit or add directly to this file if you wish to upgrade Jigoshop to newer
 * versions in the future. If you wish to customise Jigoshop core for your needs,
 * please use our GitHub repository to publish essential changes for consideration.
 *
 * @package             Jigoshop
 * @category            Catalog
 * @author              Jigoshop
 * @copyright           Copyright © 2011-2014 Jigoshop.
 * @license             GNU General Public License v3
 */
?>

<?php get_header('shop'); ?>

<section>
    <div class="container">

        <style type="text/css">
            .btn {
                background: inherit;
                -webkit-transition: inherit;
                -moz-transition: inherit;
                transition: inherit;
                min-width: inherit;
            }
        </style>

        <?php if (is_search()) : ?>
            <h2><?php _e('Search Results:', 'jigoshop'); ?> &ldquo;<?php the_search_query(); ?>&rdquo; <?php if (get_query_var('paged')) echo ' &mdash; Page ' . get_query_var('paged'); ?></h2>
        <?php else : ?>
            <?php echo apply_filters('jigoshop_products_list_title', '<h2>' . __('Browse Our Gallery', 'jigoshop') . '</h2>'); ?>
        <?php endif; ?>

        <div>148 Products</div>

        <div id="shopCrateCanvas" class="row">
            <div id="filterColumn" class="col-md-3">
                <?php
                /* ------------------------------ +/
                  SIDEBAR WIDGET:
                  /+ ------------------------------ */
                ?>
                <div class="shopFilterWidget">
                    <h3>Canvas Type</h3>
                    <p>The categories listed in alphabetical order.</p>
                    <ul id="jigoshop_product_categories" class="">
                        <li><div class="checkbox"><label><input type="checkbox" value="">All (5)</label></div></li>
                        <li><div class="checkbox"><label><input type="checkbox" value="">Single (1)</label></div></li>
                        <li><div class="checkbox"><label><input type="checkbox" value="">Diptych (2)</label></div></li>
                        <li><div class="checkbox"><label><input type="checkbox" value="">Triptych (1)</label></div></li>
                        <li><div class="checkbox"><label><input type="checkbox" value="">Quad (0)</label></div></li>
                    </ul><!-- /filterColumn -->
                </div><!-- /shopFilterWidget -->




                <?php
                /* ------------------------------ +/
                  SIDEBAR WIDGET:
                  /+ ------------------------------ */
                ?>
                <div class="shopFilterWidget">
                    <h3>Subject</h3>
                    <p>The categories listed in alphabetical order.</p>
                    <ul id="jigoshop_product_categories" class="">
                        <li><div class="checkbox"><label><input type="checkbox" value="">All (5)</label></div></li>
                        <li><div class="checkbox"><label><input type="checkbox" value="">Tupac Shakur (1)</label></div></li>
                        <li><div class="checkbox"><label><input type="checkbox" value="">Christopher Wallace (2)</label></div></li>
                        <li><div class="checkbox"><label><input type="checkbox" value="">Brad Jordan (1)</label></div></li>
                        <li><div class="checkbox"><label><input type="checkbox" value="">Snoop Dogg (0)</label></div></li>
                        <li><div class="checkbox"><label><input type="checkbox" value="">Nicki Manaj (1)</label></div></li>
                    </ul><!-- /filterColumn -->
                </div><!-- /shopFilterWidget -->

                <?php do_action('jigoshop_sidebar'); ?>
                <?php do_action('jigoshop_after_sidebar'); ?>                

            </div><!-- /filterColumn -->

            <div id="productColumn" class="col-md-9">

                <?php
                /* ------------------------------ +/
                  SORTING BAR:
                  /+ ------------------------------ */
                ?>
                <div id="sortingBar" class="row">
                    <div class="col-md-6 sortingColumns">
                        <label>Sort By</label>
                        <select id="sortingSelect" class="form-control">
                            <option>Price - High</option>
                            <option>Price - Low</option>
                            <option>Width - Narrow</option>
                            <option>Width - Wide</option>
                            <option>Height - Short</option>
                            <option>Height - Tall</option>
                            <option>Newest</option>
                            <option>Oldest</option>
                        </select>
                    </div>
                    <div class="col-md-6 sortingColumns" style="text-align:right;">
                        <?php do_action('jigoshop_pagination'); ?>
                    </div>
                </div><!-- /sortingBar -->

                <?php // do_action('jigoshop_before_main_content'); ?>
                <?php
                $shop_page_id = jigoshop_get_page_id('shop');
                $shop_page = get_post($shop_page_id);
                echo apply_filters('the_content', $shop_page->post_content);
                ?>
                <?php
                ob_start();
                jigoshop_get_template_part('loop', 'shop');
                $products_list_html = ob_get_clean();
                echo apply_filters('jigoshop_products_list', $products_list_html);
                ?>

                <?php // do_action('jigoshop_after_main_content'); ?>
                <?php
                /* ------------------------------ +/
                  SORTING BAR:
                  /+ ------------------------------ */
                ?>
                <div id="sortingBar" class="row" style="border-top:1px solid #CCC; padding-top: 5px; padding-bottom: 5px; float: left; width: 100%;">
                    <div class="col-md-6 sortingColumns"><!-- EMPTY --></div>
                    <div class="col-md-6 sortingColumns" style="text-align:right;">
                        <?php do_action('jigoshop_pagination'); ?>
                    </div>
                </div><!-- /sortingBar -->

            </div><!-- /productColumn -->
        </div><!-- /shopCrateCanvas -->

    </div><!-- /container -->
</section>
<?php get_footer('shop'); ?>
