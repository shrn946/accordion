<?php
/**
 * Elementor Dropdown New Menu widget.
 *
 * @package WPDNM
 */

namespace WPDNM;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WordPress menu-powered accordion widget.
 */
class Dropdown_New_Widget extends Widget_Base {

	/**
	 * Widget slug.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'wp-dropdown-new-menu';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'Flex Accordion', 'wp-dropdown-new-menu' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Elementor categories.
	 *
	 * @return array<int,string>
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Search keywords.
	 *
	 * @return array<int,string>
	 */
	public function get_keywords() {
		return array( 'menu', 'accordion', 'dropdown', 'navigation' );
	}

	/**
	 * Add a stable scope class to Elementor's widget wrapper.
	 *
	 * @return string
	 */
	public function get_html_wrapper_class() {
		return parent::get_html_wrapper_class() . ' wp-dropdown-new-widget';
	}

	/**
	 * Widget stylesheet dependency.
	 *
	 * @return array<int,string>
	 */
	public function get_style_depends() {
		return array( 'wp-dropdown-new-menu' );
	}

	/**
	 * Widget script dependency.
	 *
	 * @return array<int,string>
	 */
	public function get_script_depends() {
		return array( 'wp-dropdown-new-menu' );
	}

	/**
	 * Register Elementor controls.
	 */
	protected function register_controls() {
		$this->register_content_controls();
		$this->register_container_controls();
		$this->register_parent_controls();
		$this->register_child_controls();
		$this->register_arrow_controls();
		$this->register_accent_controls();
		$this->register_spacing_controls();
		$this->register_preloaded_styles();
	}

	/**
	 * Register preloaded style controls.
	 */
	private function register_preloaded_styles() {
		$this->start_controls_section(
			'section_preloaded_styles',
			array(
				'label' => esc_html__( 'Preloaded Styles', 'wp-dropdown-new-menu' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'preloaded_style',
			array(
				'label'        => esc_html__( 'Select Style', 'wp-dropdown-new-menu' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'default' => esc_html__( 'Default (Dark)', 'wp-dropdown-new-menu' ),
					'style-1' => esc_html__( 'Clean Light', 'wp-dropdown-new-menu' ),
					'style-2' => esc_html__( 'Royal Blue', 'wp-dropdown-new-menu' ),
					'style-3' => esc_html__( 'Sunset Glow', 'wp-dropdown-new-menu' ),
					'style-4' => esc_html__( 'Forest Green', 'wp-dropdown-new-menu' ),
					'style-5' => esc_html__( 'Midnight Purple', 'wp-dropdown-new-menu' ),
					'style-6' => esc_html__( 'Minimalist Grey', 'wp-dropdown-new-menu' ),
				),
				'default'      => 'default',
				'prefix_class' => 'wpdnm-',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register content controls.
	 */
	private function register_content_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'wp-dropdown-new-menu' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'menu_id',
			array(
				'label'   => esc_html__( 'Select WordPress Menu', 'wp-dropdown-new-menu' ),
				'type'    => Controls_Manager::SELECT,
				'options' => \WPDNM\get_menu_options(),
				'default' => '',
			)
		);

		$this->add_control(
			'open_first',
			array(
				'label'        => esc_html__( 'Open First Item', 'wp-dropdown-new-menu' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'wp-dropdown-new-menu' ),
				'label_off'    => esc_html__( 'No', 'wp-dropdown-new-menu' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_control(
			'single_open',
			array(
				'label'        => esc_html__( 'Enable Single Open Mode', 'wp-dropdown-new-menu' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'wp-dropdown-new-menu' ),
				'label_off'    => esc_html__( 'No', 'wp-dropdown-new-menu' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_responsive_control(
			'widget_width',
			array(
				'label'      => esc_html__( 'Widget Width', 'wp-dropdown-new-menu' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 180,
						'max' => 1000,
					),
					'%'  => array(
						'min' => 10,
						'max' => 100,
					),
					'vw' => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'default'   => array(),
				'selectors'  => array(
					'{{WRAPPER}} .wp-dropdown-new' => 'width: {{SIZE}}{{UNIT}}; max-width: 100%;',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register container style controls.
	 */
	private function register_container_controls() {
		$this->start_controls_section(
			'section_container_style',
			array(
				'label' => esc_html__( 'Container', 'wp-dropdown-new-menu' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'container_background',
			array(
				'label'     => esc_html__( 'Background Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_wrapper' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'container_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_wrapper' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'container_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'wp-dropdown-new-menu' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'   => array(),
				'selectors'  => array(
					'{{WRAPPER}} .wp-dropdown-new_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'container_box_shadow',
				'selector' => '{{WRAPPER}} .wp-dropdown-new_wrapper',
			)
		);

		$this->add_responsive_control(
			'container_padding',
			array(
				'label'      => esc_html__( 'Padding', 'wp-dropdown-new-menu' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wp-dropdown-new_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register parent item controls.
	 */
	private function register_parent_controls() {
		$this->start_controls_section(
			'section_parent_style',
			array(
				'label' => esc_html__( 'Parent Menu Items', 'wp-dropdown-new-menu' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'parent_typography',
				'selector' => '{{WRAPPER}} .wp-dropdown-new_parent',
			)
		);

		$this->add_control(
			'parent_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_parent' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'parent_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_parent:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'parent_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_item.is-open > .wp-dropdown-new_parent' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'parent_background',
			array(
				'label'     => esc_html__( 'Background Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_parent' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'parent_hover_background',
			array(
				'label'     => esc_html__( 'Hover Background', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_parent:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'parent_active_background',
			array(
				'label'     => esc_html__( 'Active Background', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_item.is-open > .wp-dropdown-new_parent' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'parent_item_height',
			array(
				'label'      => esc_html__( 'Item Height', 'wp-dropdown-new-menu' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => 30,
						'max' => 180,
					),
				),
				'default'   => array(),
				'selectors'  => array(
					'{{WRAPPER}} .wp-dropdown-new_parent' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'parent_item_padding',
			array(
				'label'      => esc_html__( 'Item Padding', 'wp-dropdown-new-menu' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'   => array(),
				'selectors'  => array(
					'{{WRAPPER}} .wp-dropdown-new_parent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register child item controls.
	 */
	private function register_child_controls() {
		$this->start_controls_section(
			'section_child_style',
			array(
				'label' => esc_html__( 'Child Menu Items', 'wp-dropdown-new-menu' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'child_typography',
				'selector' => '{{WRAPPER}} .wp-dropdown-new_child-link',
			)
		);

		$this->add_control(
			'child_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_child-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'child_hover_color',
			array(
				'label'     => esc_html__( 'Hover Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_child-link:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'child_background',
			array(
				'label'     => esc_html__( 'Background Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_child-link' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'child_hover_background',
			array(
				'label'     => esc_html__( 'Hover Background', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_child-link:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'child_padding',
			array(
				'label'      => esc_html__( 'Padding', 'wp-dropdown-new-menu' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'   => array(),
				'selectors'  => array(
					'{{WRAPPER}} .wp-dropdown-new_child-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} calc({{LEFT}}{{UNIT}} + (var(--wp-dropdown-depth) * 20px));',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register arrow controls.
	 */
	private function register_arrow_controls() {
		$this->start_controls_section(
			'section_arrow_style',
			array(
				'label' => esc_html__( 'Arrow', 'wp-dropdown-new-menu' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'arrow_size',
			array(
				'label'      => esc_html__( 'Arrow Size', 'wp-dropdown-new-menu' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 4,
						'max' => 30,
					),
				),
				'default'   => array(),
				'selectors'  => array(
					'{{WRAPPER}} .lil_arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'arrow_color',
			array(
				'label'     => esc_html__( 'Arrow Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .lil_arrow' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrow_active_color',
			array(
				'label'     => esc_html__( 'Active Arrow Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .wp-dropdown-new_item.is-open > .wp-dropdown-new_parent .lil_arrow' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register accent bar controls.
	 */
	private function register_accent_controls() {
		$this->start_controls_section(
			'section_accent_style',
			array(
				'label' => esc_html__( 'Accent Bar', 'wp-dropdown-new-menu' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'accent_enabled',
			array(
				'label'        => esc_html__( 'Enable Accent Bar', 'wp-dropdown-new-menu' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'wp-dropdown-new-menu' ),
				'label_off'    => esc_html__( 'No', 'wp-dropdown-new-menu' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'accent_color',
			array(
				'label'     => esc_html__( 'Color', 'wp-dropdown-new-menu' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'accent_enabled' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .bar' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'accent_height',
			array(
				'label'      => esc_html__( 'Height', 'wp-dropdown-new-menu' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 12,
					),
				),
				'default'   => array(),
				'condition'  => array(
					'accent_enabled' => 'yes',
				),
				'selectors'  => array(
					'{{WRAPPER}} .bar' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register spacing controls.
	 */
	private function register_spacing_controls() {
		$this->start_controls_section(
			'section_spacing_style',
			array(
				'label' => esc_html__( 'Spacing', 'wp-dropdown-new-menu' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'item_gap',
			array(
				'label'      => esc_html__( 'Item Gap', 'wp-dropdown-new-menu' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 60,
					),
				),
				'default'   => array(),
				'selectors'  => array(
					'{{WRAPPER}} .wp-dropdown-new_item + .wp-dropdown-new_item' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'inner_padding',
			array(
				'label'      => esc_html__( 'Inner Padding', 'wp-dropdown-new-menu' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wp-dropdown-new_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'dropdown_padding',
			array(
				'label'      => esc_html__( 'Dropdown Padding', 'wp-dropdown-new-menu' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .wp-dropdown-new_wrapper__content-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$menu_id  = isset( $settings['menu_id'] ) ? absint( $settings['menu_id'] ) : 0;

		wp_enqueue_style( 'wp-dropdown-new-menu' );
		wp_enqueue_script( 'wp-dropdown-new-menu' );

		if ( ! $menu_id ) {
			$this->render_editor_notice( esc_html__( 'Choose a WordPress menu in the widget settings.', 'wp-dropdown-new-menu' ) );
			return;
		}

		$menu_tree = \WPDNM\get_menu_tree( $menu_id );

		if ( empty( $menu_tree ) ) {
			$this->render_editor_notice( esc_html__( 'The selected menu has no items.', 'wp-dropdown-new-menu' ) );
			return;
		}

		$single_open     = 'yes' === $settings['single_open'];
		$open_first      = 'yes' === $settings['open_first'];
		$accent_enabled  = 'yes' === $settings['accent_enabled'];
		$preloaded_style = isset( $settings['preloaded_style'] ) ? $settings['preloaded_style'] : 'default';
		$instance_id     = 'wpdnm-' . $this->get_id();

		$this->add_render_attribute(
			'menu',
			array(
				'id'               => $instance_id,
				'class'            => 'wp-dropdown-new',
				'data-single-open' => $single_open ? 'true' : 'false',
				'data-open-first'  => $open_first ? 'true' : 'false',
			)
		);
		?>
		<div <?php echo $this->get_render_attribute_string( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<div class="wp-dropdown-new_wrapper">
				<?php
				foreach ( $menu_tree as $index => $node ) {
					$this->render_top_level_item( $node, $instance_id, $index, $accent_enabled );
				}
				?>
			</div>
		</div>
		<?php
	}

	/**
	 * Render a top-level accordion item.
	 *
	 * @param array<string,mixed> $node           Menu node.
	 * @param string              $instance_id    Widget instance ID.
	 * @param int                 $index          Item index.
	 * @param bool                $accent_enabled Whether the accent bar is enabled.
	 */
	private function render_top_level_item( $node, $instance_id, $index, $accent_enabled ) {
		$item         = $node['item'];
		$children     = $node['children'];
		$has_children = ! empty( $children );
		$content_id   = $instance_id . '-panel-' . absint( $item->ID ) . '-' . absint( $index );
		$title        = apply_filters( 'the_title', $item->title, $item->ID );
		?>
		<div class="wp-dropdown-new_item<?php echo $has_children ? ' has-children' : ''; ?>">
			<?php if ( $has_children ) : ?>
				<button
					class="wp-dropdown-new_parent"
					type="button"
					aria-expanded="false"
					aria-controls="<?php echo esc_attr( $content_id ); ?>"
				>
					<span class="wp-dropdown-new_parent-title"><?php echo esc_html( $title ); ?></span>
					<span class="lil_arrow" aria-hidden="true"></span>
					<?php if ( $accent_enabled ) : ?>
						<span class="bar" aria-hidden="true"></span>
					<?php endif; ?>
				</button>
				<div
					id="<?php echo esc_attr( $content_id ); ?>"
					class="wp-dropdown-new_wrapper__content"
					role="region"
					aria-label="<?php echo esc_attr( $title ); ?>"
				>
					<div class="wp-dropdown-new_wrapper__content-inner">
						<?php $this->render_child_items( $children, 1 ); ?>
					</div>
				</div>
			<?php else : ?>
				<?php $this->render_parent_link( $item, $title, $accent_enabled ); ?>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Render a linked top-level item.
	 *
	 * @param object $item           WordPress menu item.
	 * @param string $title          Filtered menu title.
	 * @param bool   $accent_enabled Whether the accent bar is enabled.
	 */
	private function render_parent_link( $item, $title, $accent_enabled ) {
		$attributes = $this->get_link_attributes( $item );
		?>
		<a class="wp-dropdown-new_parent" <?php echo $attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<span class="wp-dropdown-new_parent-title"><?php echo esc_html( $title ); ?></span>
			<?php if ( $accent_enabled ) : ?>
				<span class="bar" aria-hidden="true"></span>
			<?php endif; ?>
		</a>
		<?php
	}

	/**
	 * Render child menu levels recursively.
	 *
	 * @param array<int,array<string,mixed>> $nodes Child nodes.
	 * @param int                            $depth Current depth.
	 */
	private function render_child_items( $nodes, $depth ) {
		?>
		<ul class="wp-dropdown-new_children wp-dropdown-new_children--depth-<?php echo esc_attr( $depth ); ?>">
			<?php foreach ( $nodes as $node ) : ?>
				<?php
				$item     = $node['item'];
				$children = $node['children'];
				$title    = apply_filters( 'the_title', $item->title, $item->ID );
				?>
				<li class="wp-dropdown-new_child-item<?php echo ! empty( $children ) ? ' has-children' : ''; ?>">
					<a
						class="wp-dropdown-new_child-link"
						style="--wp-dropdown-depth: <?php echo esc_attr( $depth ); ?>;"
						<?php echo $this->get_link_attributes( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					>
						<?php echo esc_html( $title ); ?>
					</a>
					<?php
					if ( ! empty( $children ) ) {
						$this->render_child_items( $children, $depth + 1 );
					}
					?>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php
	}

	/**
	 * Build escaped HTML attributes for a menu link.
	 *
	 * @param object $item WordPress menu item.
	 * @return string
	 */
	private function get_link_attributes( $item ) {
		$attributes = array(
			'href' => ! empty( $item->url ) ? esc_url( $item->url ) : '#',
		);

		if ( ! empty( $item->target ) ) {
			$attributes['target'] = esc_attr( $item->target );
		}

		if ( ! empty( $item->xfn ) ) {
			$attributes['rel'] = esc_attr( $item->xfn );
		}

		if ( ! empty( $item->attr_title ) ) {
			$attributes['title'] = esc_attr( $item->attr_title );
		}

		if ( is_array( $item->classes ) && in_array( 'current-menu-item', $item->classes, true ) ) {
			$attributes['aria-current'] = 'page';
		}

		$html = '';

		foreach ( $attributes as $name => $value ) {
			$html .= sprintf( ' %s="%s"', esc_attr( $name ), esc_attr( $value ) );
		}

		return trim( $html );
	}

	/**
	 * Show configuration feedback only in Elementor edit mode.
	 *
	 * @param string $message Notice text.
	 */
	private function render_editor_notice( $message ) {
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			printf(
				'<div class="wp-dropdown-new_notice">%s</div>',
				esc_html( $message )
			);
		}
	}
}
