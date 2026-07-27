<?php
/**
 * Element Submissions
 */

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Submissions extends Widget_Base {

    public function get_name() {
        return 'submissions';
    }

    public function get_title() {
        return __( 'Submissions', 'bearsthemes-addons' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'bearsthemes-addons' ];
    }

    public function get_script_depends() {
        return [ 'submissions-js' ];
    }

    public function get_style_depends() {
        return [ 'submissions-css' ];
    }

    protected function register_content_section_controls() {
        $this->start_controls_section(
            'section_content', [
                'label' => __( 'Content', 'bearsthemes-addons' ),
            ]
        );

        $this->add_control(
            'submissions_source_notice',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw'  => __( 'Submissions data is managed via the ACF Options page. <a href="/wp-admin/admin.php?page=submissions" target="_blank"><strong>Manage Submissions →</strong></a>', 'bearsthemes-addons' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $this->add_control(
            'items_per_page',
            [
                'label'   => __( 'Items Per Page', 'bearsthemes-addons' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 9,
                'min'     => 1,
                'max'     => 50,
            ]
        );

        $columns = range( 1, 4 );
        $columns = array_combine( $columns, $columns );

        $this->add_responsive_control(
            'columns',
            [
                'label'   => __( 'Columns', 'bearsthemes-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'options' => $columns,
            ]
        );

        $this->add_control(
            'show_more_text',
            [
                'label'   => __( 'Show More Button Text', 'bearsthemes-addons' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Show More', 'bearsthemes-addons' ),
            ]
        );

        $this->add_control(
            'download_text',
            [
                'label'   => __( 'Download Link Text', 'bearsthemes-addons' ),
                'type'    => Controls_Manager::TEXT,
                'default' => __( 'Download PDF', 'bearsthemes-addons' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_card_section_controls() {
        $this->start_controls_section(
            'section_style_card', [
                'label' => __( 'Card', 'bearsthemes-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label'      => __( 'Padding', 'bearsthemes-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bt-submissions__card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_bg_color',
            [
                'label'     => __( 'Background Color', 'bearsthemes-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bt-submissions__card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_border_radius',
            [
                'label'      => __( 'Border Radius', 'bearsthemes-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [ 'min' => 0, 'max' => 30 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bt-submissions__card' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_gap',
            [
                'label'      => __( 'Gap', 'bearsthemes-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [ 'min' => 0, 'max' => 60 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bt-submissions__grid' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_name_section_controls() {
        $this->start_controls_section(
            'section_style_name', [
                'label' => __( 'Organisation Name', 'bearsthemes-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .bt-submissions__name',
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => __( 'Color', 'bearsthemes-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bt-submissions__name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_download_section_controls() {
        $this->start_controls_section(
            'section_style_download', [
                'label' => __( 'Download Link', 'bearsthemes-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'download_typography',
                'selector' => '{{WRAPPER}} .bt-submissions__download-text',
            ]
        );

        $this->add_control(
            'download_color',
            [
                'label'     => __( 'Color', 'bearsthemes-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bt-submissions__download-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bt-submissions__download-icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .bt-submissions__download-icon svg text' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'download_hover_color',
            [
                'label'     => __( 'Hover Color', 'bearsthemes-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bt-submissions__download:hover .bt-submissions__download-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bt-submissions__download:hover .bt-submissions__download-icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .bt-submissions__download:hover .bt-submissions__download-icon svg text' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_button_section_controls() {
        $this->start_controls_section(
            'section_style_button', [
                'label' => __( 'Show More Button', 'bearsthemes-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .bt-submissions__load-more',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => __( 'Text Color', 'bearsthemes-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bt-submissions__load-more' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg',
            [
                'label'     => __( 'Hover Background', 'bearsthemes-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bt-submissions__load-more:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label'     => __( 'Hover Text Color', 'bearsthemes-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bt-submissions__load-more:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_controls() {
        $this->register_content_section_controls();
        $this->register_style_card_section_controls();
        $this->register_style_name_section_controls();
        $this->register_style_download_section_controls();
        $this->register_style_button_section_controls();
    }


    protected function render() {
        $settings       = $this->get_settings_for_display();
        $items_per_page = isset( $settings['items_per_page'] ) ? (int) $settings['items_per_page'] : 9;
        $download_text  = ! empty( $settings['download_text'] ) ? $settings['download_text'] : 'Download PDF';
        $show_more_text = ! empty( $settings['show_more_text'] ) ? $settings['show_more_text'] : 'Show More';

        // Columns
        $col_desktop = isset( $settings['columns'] ) ? $settings['columns'] : 3;
        $col_tablet  = isset( $settings['columns_tablet'] ) ? $settings['columns_tablet'] : 2;
        $col_mobile  = isset( $settings['columns_mobile'] ) ? $settings['columns_mobile'] : 1;

        // Get ACF repeater data from options page
        $submissions = get_field( 'submissions_list', 'option' );

        if ( empty( $submissions ) || ! is_array( $submissions ) ) {
            echo '<p>' . __( 'No submissions found.', 'bearsthemes-addons' ) . '</p>';
            return;
        }

        $total_items = count( $submissions );
        $has_more    = $total_items > $items_per_page;

        ?>
        <div class="bt-elements-elementor bt-submissions"
             data-per-page="<?php echo esc_attr( $items_per_page ); ?>">

            <div class="bt-submissions__grid"
                 style="--columns-desktop: <?php echo esc_attr( $col_desktop ); ?>;
                        --columns-tablet: <?php echo esc_attr( $col_tablet ); ?>;
                        --columns-mobile: <?php echo esc_attr( $col_mobile ); ?>;">

                <?php foreach ( $submissions as $index => $item ) :
                    $name    = isset( $item['organisation_name'] ) ? $item['organisation_name'] : '';
                    $pdf_url = isset( $item['pdf_file'] ) ? $item['pdf_file'] : '';

                    if ( empty( $name ) && empty( $pdf_url ) ) continue;

                    $hidden_class = $index >= $items_per_page ? 'bt-submissions__card--hidden' : '';
                ?>
                    <div class="bt-submissions__card <?php echo esc_attr( $hidden_class ); ?>" data-index="<?php echo esc_attr( $index ); ?>">
                        <h3 class="bt-submissions__name"><?php echo esc_html( $name ); ?></h3>
                        <?php if ( ! empty( $pdf_url ) ) : ?>
                            <a href="<?php echo esc_url( $pdf_url ); ?>" class="bt-submissions__download" target="_blank" rel="noopener noreferrer">
                                <span class="bt-submissions__download-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                        <path d="M4 4C4 2.89543 4.89543 2 6 2H19L28 11V28C28 29.1046 27.1046 30 26 30H6C4.89543 30 4 29.1046 4 28V4Z" fill="#2a8164" opacity="0.15"/>
                                        <path d="M19 2L28 11H21C19.8954 11 19 10.1046 19 9V2Z" fill="#2a8164" opacity="0.3"/>
                                        <path d="M4 4C4 2.89543 4.89543 2 6 2H19L28 11V28C28 29.1046 27.1046 30 26 30H6C4.89543 30 4 29.1046 4 28V4Z" stroke="#2a8164" stroke-width="1.5" fill="none"/>
                                        <text x="16" y="23" text-anchor="middle" font-size="7" font-weight="bold" fill="#2a8164" font-family="Arial, sans-serif">PDF</text>
                                    </svg>
                                </span>
                                <span class="bt-submissions__download-text"><?php echo esc_html( $download_text ); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ( $has_more ) : ?>
                <div class="bt-submissions__load-more-wrap">
                    <button type="button" class="bt-submissions__load-more">
                        <?php echo esc_html( $show_more_text ); ?>
                    </button>
                </div>
            <?php endif; ?>

        </div>
        <?php
    }

    protected function _content_template() {

    }
}
