<?php
/**
 * Function describe for FashStore * 
 * 
 * @package FashStore
 */

$fashstore_theme = wp_get_theme();
$fashstore_version = $fashstore_theme->get( 'Version' );

/**
 * Enequeue script for child theme
 */ 
function fashstore_styles_scripts() {
    global $fashstore_version;
    $fashstore_font_args = array(
        'family' => 'Josefin+Sans:400,300,700|Playfair+Display:400,700,900',
    );
    wp_enqueue_style( 'fashstore-google-fonts', add_query_arg( $fashstore_font_args, "//fonts.googleapis.com/css" ) );
    wp_enqueue_style( 'fashstore-parent-styles', get_template_directory_uri() . '/style.css'); 
    wp_enqueue_style( 'fashstore-parent-styles-dynamic', get_stylesheet_directory_uri() . '/css/style-dynamic.css',array('accesspress-store-style', 'accesspress-store-minify-style'));    

    wp_enqueue_script( 'fash-custom-script', get_stylesheet_directory_uri() . '/js/fash-custom.js', array('jquery'), esc_attr( $fashstore_version ) );
}
add_action( 'wp_enqueue_scripts', 'fashstore_styles_scripts' );

/*=======================================================================================================================*/  
/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.

 
 */
function fashstore_theme_setup() {
    
    load_child_theme_textdomain( 'fashstore', get_stylesheet_directory() . '/languages' );

    /*Fashstore image size*/
    add_image_size( 'fashstore-banner-big', 298, 498, true );
    add_image_size( 'fashstore-banner-small', 280, 358, true );

}
add_action( 'after_setup_theme', 'fashstore_theme_setup' );

/*=======================================================================================================================*/  
/**
 * Changed cart fragment
 */	
add_filter( 'add_to_cart_fragments', 'fashstore_woocommerce_header_add_to_cart_fragment', 15 );
function fashstore_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();
	$cart_url = $woocommerce->cart->get_cart_url();  
	?>
	<div class="view-cart"><a title="<?php esc_html_e( 'View your shopping cart' ,'fashstore' ); ?>" href="<?php echo esc_url($cart_url); ?>" class="wcmenucart-contents"><i class="fa fa-shopping-cart"></i> ( <?php echo absint($woocommerce->cart->cart_contents_count); ?> )</a>
	
	</div>
	<?php
	$fragments['div.view-cart'] = ob_get_clean();
	return $fragments;
}

/*=======================================================================================================================*/
/**
 * Load FashStore widget
*/
require get_stylesheet_directory() . '/inc/customizer/fashstore-customizer.php';
require get_stylesheet_directory() . '/inc/widgets/fashstore-products-slider.php';
require get_stylesheet_directory() . '/inc/widgets/fashstore-category-banner.php';


/**
 * Load Dynamic Styles
*/
//require get_stylesheet_directory() . '/css/style.php';

/*=======================================================================================================================*/

/*Add class at add to card button*/
add_filter("woocommerce_loop_add_to_cart_link", 'fashstore_woo_callback_function');

function fashstore_woo_callback_function($product){
    global $product;
    return sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s"><span class="cart-caption">%s</span></a><div class="clearfix"></div>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->get_id() ),
        esc_attr( $product->get_sku() ),
        esc_attr( isset( $quantity ) ? $quantity : 1 ),
        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
        esc_attr( $product->get_type() ), //$product->product_type
        esc_html( $product->add_to_cart_text() )
    );
}

/*=======================================================================================================================*/
/*fallback function for menu class*/
function fashstore_custom_fallback_menu(){
    $args = array(
        'menu_class'  => 'fashstore-menu',
        'echo'        => true,
    );
    wp_page_menu( $args );
}

/**
 * Woo Commerce Related product
*/
add_filter( 'woocommerce_output_related_products_args', 'fashstore_related_products_args' );
function fashstore_related_products_args( $args ) {
    $args['posts_per_page']     = 6;
    $args['columns']            = 3;
    return $args;
}

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'fashstore_woocommerce_output_upsells', 15 );

if ( ! function_exists( 'fashstore_woocommerce_output_upsells' ) ) {
    function fashstore_woocommerce_output_upsells() {
        woocommerce_upsell_display( 3,3 ); 
    }
}


if ( ! function_exists( 'fashstore_store_cart_link' ) ) {
    function fashstore_store_cart_link() { ?>         
            <a class="cart-contents wcmenucart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'fashstore' ); ?>">
                <i class="fa fa-shopping-cart"></i> ( <?php echo wp_kses_data( sprintf(  WC()->cart->get_cart_contents_count() ) ); ?> )
            </a>
        <?php
    }
}

if ( ! function_exists( 'fashstore_store_cart_link_fragment' ) ) {

    function fashstore_store_cart_link_fragment( $fragments ) {
        global $woocommerce;

        ob_start();
        fashstore_store_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter( 'add_to_cart_fragments', 'fashstore_store_cart_link_fragment' );
    

function fashstore_dynamic_styles(){
   $tpl_color = get_theme_mod( 'tpl_color', '#d4054f' );
   if( $tpl_color ) {
    $custom_css ='';
    $custom_css .= "
                .feature-cat-image.right_align .product-cat-desc,
                .caption-read-more1,
                .woocommerce .gridlist-buttonwrap a.add_to_cart_button,
                .woocommerce ul.products li.product a.item-wishlist:hover,
                .woocommerce .gridlist-buttonwrap .add_to_cart_button:hover,
                .woocommerce.single.single-product .upsells.products ul.products li .add_to_cart_button:hover,
                .woocommerce.single.single-product .upsells.products ul.products li .add_to_cart_button,
                .woocommerce a.product_type_grouped:hover, .slick-track li a:first-child:hover,
                .cart-wish-wrapper a:first-child:hover, .cart-wish-wrapper .item-wishlist:hover,
                .woocommerce a.product_type_variable:hover, .woocommerce a.product_type_external:hover,
                .page-template .cart-wish-wrapper a.product_type_external:hover,
                .cart-wish-wrapper .item-wishlist,
                .page-template .cart-wish-wrapper .add_to_cart_button:hover
                {
                    background: {$tpl_color};
                }"; 
    $custom_css .= "
                .single-product.woocommerce .star-rating span::before,
                .single-product.woocommerce .star-rating::before,
                .slider-caption .caption-title,
                .promo-image .caption h4,
                .login-woocommerce a.quick-wishlist i,
                .login-woocommerce .view-cart a.wcmenucart-contents i,
                .footer-bottom .site-info a,
                .woocommerce.single.single-product .entry-summary .show a:hover,
                .top-footer-block ul.menu li a:hover,
                .woocommerce p.stars a.star-1,
                .woocommerce p.stars a.star-2,
                .woocommerce p.stars a.star-3,
                .woocommerce p.stars a.star-4,
                .woocommerce p.stars a.star-5,
                .promo-image:hover .caption h4{
                    color: {$tpl_color};
                }";         
    $custom_css .= "
                #secondary.sidebar ul li:hover>a,
                #secondary.sidebar ul li:hover,
                .ticker-title span,
                .fashstore-menu .current-menu-item a{
                    border-color: {$tpl_color};
                }"; 

    wp_add_inline_style( 'fashstore-parent-styles-dynamic', $custom_css );       
}
}
add_action( 'wp_enqueue_scripts', 'fashstore_dynamic_styles' );


