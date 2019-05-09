<?php
/**
 * Display all Cappuccino functions and definitions
 *
 * @package Theme Freesia
 * @subpackage Cappuccino
 * @since Cappuccino 1.0
 */

add_action( 'wp_enqueue_scripts', 'cappuccino_enqueue_styles' );

function cappuccino_enqueue_styles() {
	$cappuccino_color_styles = get_theme_mod('cappuccino_colors','brown-color');

	wp_enqueue_style( 'cappuccino-parent-style', trailingslashit(get_template_directory_uri() ) . 'style.css');

	if($cappuccino_color_styles == 'brown-color'){
		wp_enqueue_style( 'cappuccino-red', trailingslashit(get_stylesheet_directory_uri() ) . 'css/brown-color-style.css');
	} elseif($cappuccino_color_styles == 'orange-color'){
		wp_enqueue_style( 'cappuccino-blue', trailingslashit(get_stylesheet_directory_uri() ) . 'css/orange-color-style.css');
	} elseif($cappuccino_color_styles == 'green-color'){
		wp_enqueue_style( 'cappuccino-green', trailingslashit(get_stylesheet_directory_uri() ) . 'css/green-color-style.css');
	} else {
		wp_enqueue_style( 'cappuccino-purple', trailingslashit(get_stylesheet_directory_uri() ) . 'css/chocolate-color-style.css');
	}

}


function cappuccino_customize_register( $wp_customize ) {
	if(!class_exists('Cocktail_Plus_Features')){
		class Cappuccino_Customize_upgrade extends WP_Customize_Control {
			public function render_content() { ?>
				<a title="<?php esc_attr_e( 'Review Cappuccino', 'cappuccino' ); ?>" href="<?php echo esc_url( 'https://wordpress.org/support/view/theme-reviews/cappuccino/' ); ?>" target="_blank" id="about-cappuccino">
				<?php esc_html_e( 'Review Cappuccino', 'cappuccino' ); ?>
				</a><br/>
				<a href="<?php echo esc_url( 'https://themefreesia.com/theme-instruction/cappuccino/' ); ?>" title="<?php esc_attr_e( 'Theme Instructions', 'cappuccino' ); ?>" target="_blank" id="about-cappuccino">
				<?php esc_html_e( 'Theme Instructions', 'cappuccino' ); ?>
				</a><br/>
				<a href="<?php echo esc_url( 'https://tickets.themefreesia.com' ); ?>" title="<?php esc_attr_e( 'Support Ticket', 'cappuccino' ); ?>" target="_blank" id="about-cappuccino">
				<?php esc_html_e( 'Tickets', 'cappuccino' ); ?>
				</a><br/>
			<?php
			}
		}

		$wp_customize->add_section('cappuccino_upgrade_links', array(
			'title'					=> __('About Cappuccino', 'cappuccino'),
			'priority'				=> 1000,
		));
		$wp_customize->add_setting( 'cappuccino_upgrade_links', array(
			'default'				=> false,
			'capability'			=> 'edit_theme_options',
			'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		));
		$wp_customize->add_control(
			new Cappuccino_Customize_upgrade(
			$wp_customize,
			'cappuccino_upgrade_links',
				array(
					'section'				=> 'cappuccino_upgrade_links',
					'settings'				=> 'cappuccino_upgrade_links',
				)
			)
		);
	}

	$wp_customize->add_setting( 'cappuccino_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability'            => 'manage_options'
		)
	);
	$wp_customize->add_control( 'cappuccino_title', array(
		'label' => __('Title','cappuccino'),
		'section' => 'cocktail_frontpage_features',
		'type'     => 'text',
		'priority'	=> 20,
		)
	);

	$wp_customize->add_setting( 'cappuccino_description', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability'            => 'manage_options'
		)
	);
	$wp_customize->add_control( 'cappuccino_description', array(
		'label' => __('Description','cappuccino'),
		'section' => 'cocktail_frontpage_features',
		'type'     => 'text',
		'priority'	=> 30,
		)
	);

	//Featured Background Post

	$wp_customize->add_section( 'cappuccino_featured_bg_post', array(
		'title' => __('Frontpage Featured Background Post','cocktail'),
		'priority' => 20,
		'panel' =>'cocktail_frontpage_features_panel'
	));


	$cocktail_settings = cocktail_get_theme_options();
	$cocktail_categories_lists = cocktail_categories_lists();

	$wp_customize->add_setting(
		'cappuccino_featured_bg_post', array(
			'default'				=>'',
			'capability'			=> 'manage_options',
			'sanitize_callback'	=> 'cocktail_sanitize_category_select',
		)
	);
	$wp_customize->add_control( 'cappuccino_featured_bg_post',
			array(
				'priority' => 10,
				'label'       => __( 'Front Page Features', 'cocktail' ),
				'section'     => 'cappuccino_featured_bg_post',
				'type'        => 'select',
				'choices'	=>  $cocktail_categories_lists 
			)
	);


}

add_action( 'customize_register', 'cappuccino_customize_register' );

add_action( 'customize_register', 'cappuccino_customize_register_color_styles' );
function cappuccino_customize_register_color_styles( $wp_customize ) {

	$wp_customize->add_section( 'custom_color_styles', array(
		'title' 						=> __('Custom Color Styles','cappuccino'),
		'priority'					=> 100,
		'panel'					=>'colors'
	));


	$wp_customize->add_setting('cappuccino_colors', array(
		'default' => 'brown-color',
		'sanitize_callback' => 'cocktail_sanitize_select',
		));
	$wp_customize->add_control('cappuccino_colors', array(
		'priority' =>10,
		'label' => __('Custom Color Styles', 'cappuccino'),
		'description' => __('Change Color Styles into Brown, Green, Orange and Chocolate Color. If Plus version used, this feature is Optional', 'cappuccino'),
		'section' => 'custom_color_styles',
		'settings' => 'cappuccino_colors',
		'type' => 'select',
		'checked' => 'checked',
		'choices' => array(
			'brown-color' => __('Brown ','cappuccino'),
			'green-color' => __('Green','cappuccino'),
			'orange-color' => __('Orange','cappuccino'),
			'chocolate-color' => __('Chocolate','cappuccino'),
		),
	));
}

if(!class_exists('Cocktail_Plus_Features')){
	// Add Upgrade to Plus Button.
	require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/upgrade-plus/class-customize.php' );
}

function cappuccino_frontpage_features(){ 
$cocktail_settings = cocktail_get_theme_options();
$cocktail_disable_frontpage_features = $cocktail_settings['cocktail_disable_frontpage_features'];
$cocktail_no_of_frontpage = $cocktail_settings['cocktail_no_of_frontpage'];
$cappuccino_title = get_theme_mod('cappuccino_title','');
$cappuccino_description = get_theme_mod('cappuccino_description','');
$query = new WP_Query(array(
			'posts_per_page' =>  intval($cocktail_settings['cocktail_no_of_frontpage']),
			'post_type'					=> 'post',
			'category_name' => esc_attr($cocktail_settings['cocktail_frontpage_features']),
	));
	if(($cocktail_disable_frontpage_features !=1) && ($cocktail_settings['cocktail_frontpage_features'] !='')){ ?>
	<div class="our-feature-box">
		<div class="wrap">
			<div class="inner-wrap">
				<?php if ($cappuccino_title !='' || $cappuccino_description !='') { ?>
					<div class="our-feature-box-header">
						<?php if ($cappuccino_title !='') { ?>
							<h2 class="feature-box-title"><?php echo esc_html($cappuccino_title);?></h2>
						<?php }
						if ($cappuccino_title !='') { ?>
							<div class="feature-box-description"><?php echo esc_attr($cappuccino_description);?></div>
					<?php } ?>
					</div>
				<?php } ?>
				<div class="column clearfix">
					<?php while ($query->have_posts()):$query->the_post(); ?>
					<div class="four-column">
						<div class="feature-content-wrap clearfix">
							<?php if(has_post_thumbnail() ){ ?>
								<a class="feature-icon" href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
							<?php } ?>
							<div class="feature-content">
								<h2 class="feature-title"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>	
							</div> <!-- end .feature-content -->
						</div> <!-- end .feature-content-wrap -->
					</div> <!-- end .four-column -->
					<?php endwhile;
					wp_reset_postdata(); ?>
				</div> <!-- end .column -->
			</div> <!-- end .inner-wrap -->
		</div> <!-- end .wrap -->
	</div> <!-- end .our-feature-box -->
	<?php } ?>

<?php }
add_action('cappuccino_display_frontpage_features','cappuccino_frontpage_features');

if(!class_exists('Cocktail_Plus_Features')){

	/**
	 * TGM plugin Activation
	 */
	require_once( trailingslashit( get_stylesheet_directory() ) . '/inc/tgm/tgm.php' );

}

/***************** USED CLASS FOR BODY ******************************/
function cappuccino_body_class($cappuccino_class) {

		$cappuccino_class[] = 'cappuccino-color';

	return $cappuccino_class;
}
add_filter('body_class', 'cappuccino_body_class');

/***************** FrontPage featured background Post ******************************/

function cappuccino_frontpage_featured_bg_post(){ 
$cocktail_settings = cocktail_get_theme_options();
$cappuccino_featured_bg_post = get_theme_mod ('cappuccino_featured_bg_post','');

	if ($cappuccino_featured_bg_post !='') {
	$query = new WP_Query(array(
				'posts_per_page' =>  1,
				'post_type'					=> 'post',
				'category_name' => esc_attr($cappuccino_featured_bg_post),
		)); ?>
		
						<?php while ($query->have_posts()):$query->the_post();
							$attachment_id = get_post_thumbnail_id();
							$image_attributes = wp_get_attachment_image_src($attachment_id,'full');

							if(has_post_thumbnail() ){ ?>

								<div class="feature-background-post" style="background-image:url('<?php echo esc_url($image_attributes[0]); ?>');">
									<div class="feature-background-content">
										<h2 class="feature-background-title"><?php the_title(); ?></h2>
										<span class="feature-background-text"><?php the_content(); ?></span>
									</div>
								</div>

							<?php }

						endwhile;

						wp_reset_postdata(); ?>

	<?php }
}
add_action('cappuccino_display_featured_bg_post','cappuccino_frontpage_featured_bg_post');