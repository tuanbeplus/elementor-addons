<?php
/**
* Element Subhead Bodycopy
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
// use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Accordion_Navigation_Tabs extends Widget_Base {

    public function get_name() {
        return 'accordion-navigation-tabs';
    }

    public function get_title() {
        return __( 'Accordion Navigation Tabs', 'bearsthemes-addons' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'bearsthemes-addons' ];
    }

    public function get_script_depends() {
        return [ 'elementor-addons-custom-frontend' ];
    }

    public function get_style_depends() {
        return [ 'elementor-addons-custom-frontend' ];
    }


    protected function register_tabs_section_controls() {
        $this->start_controls_section(
            'section_tabs_layout',[
                'label' => __( 'Tabs', 'bearsthemes-addons' ),
             ]
        );

            $this->add_control(
                'title_accordion_navigation_tabs',
                    [
                        'label' => __( 'Title', 'bearsthemes-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Useful', 'bearsthemes-addons' ),
                        'label_block' => true,
                    ]
            );

            $litsItems = new \Elementor\Repeater();
            $litsItems->add_control(
                'title',
                [
                    'label' => __( 'Title', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );
            $litsItems->add_control(
                'post_ids_tabs',
                [
                    'label'       => __( 'Select Team', 'bears-elementor-extension' ),
                    'type'        => \Elementor\Controls_Manager::SELECT2,
                    'multiple'    => true,
                    'options'     => $this->bears_show_post_team_for_select(),
                    'default'     => [],
                    'description' => __( 'Select post to be included', 'bearsthemes-addons' ),
                    'condition' => [
            					'apply_search' => '',
            				]
                ]
            );
            $litsItems->add_control(
                'apply_search',
                [
                    'label' => __( 'Apply search this team?', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_off' => __( 'Yes', 'bearsthemes-addons' ),
            				'label_on' => __( 'No', 'bearsthemes-addons' ),
            				'return_value' => '1',
            				'default' => '',
                ]
            );
            $litsItems->add_control(
                'add_shortcode',
                [
                    'label' => __( 'Add shortcode Elementor:', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                    'condition' => [
            					'apply_search' => '1',
            				]
                ]
            );
            $this->add_control(
                'list_tabs_items',
                [
                    'label' => __( 'Tabs Items', 'plugin-domain' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $litsItems->get_controls(),
                    'default' => [
                        [
                            'title' => __( 'Our board', 'bearsthemes-addons' ),
                            'post_ids_tabs' => __( '', 'bearsthemes-addons' ),

                        ],
                        [
                            'title' => __( 'Our exec team ', 'bearsthemes-addons' ),
                            'post_ids_tabs' => __( '', 'bearsthemes-addons' ),

                        ],
                    ],
                    'title_field' => '{{{ title }}}',
                ]
            );

            $this->add_control(
                'order_tabs',
                [
                    'label' => __( 'Order', 'elementor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC' => __( 'DESC', 'elementor' ),
                        'ASC' => __( 'ASC', 'elementor' ),
                    ],
                ]
            );
        $this->end_controls_section();

    }

    protected function register_style_title_section_controls() {
        $this->start_controls_section(
            'style_title_section',[
                'label' => __( 'Title', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_ant_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .accordion-navigation-tabs-elements > .content-elements > .heading',
                ]
            );

            $this->add_control(
                'title_ant_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2F2F39',
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-elements > .content-elements > .heading' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_ant_alignment',
                [
                    'label' => __( 'Alignment', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-elements > .content-elements > .heading' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_ant_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 10,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-elements > .content-elements > .heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    protected function register_style_tabs_title_section_controls(){
        $this->start_controls_section(
            'style_tabs_title_section',[
                'label' => __( 'Tabs Title', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tab_title_ant_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .accordion-navigation-tabs-container .accordion-navigation-tabs-title .item-tabs-title',
                ]
            );

            $this->start_controls_tabs('tabs_title_tab');
                $this->start_controls_tab(
                    'title_tab_normal',
                    [
                        'label' => __( 'Normal', 'bearsthemes-addons' ),
                    ]
                );

                    $this->add_control(
                        'title_tab_normal_color',
                        [
                            'label' => __( 'Color', 'bearsthemes-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#2F2F39',
                            'selectors' => [
                                '{{WRAPPER}} .accordion-navigation-tabs-container .accordion-navigation-tabs-title .item-tabs-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .accordion-navigation-tabs-title .item-tabs-title:not(:first-child)::before' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );


                $this->end_controls_tab();
                $this->start_controls_tab(
                    'title_tab_acitve',
                    [
                        'label' => __( 'Active', 'bearsthemes-addons' ),
                    ]
                );

                    $this->add_control(
                        'title_tab_acitve_color',
                        [
                            'label' => __( 'Color', 'bearsthemes-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#2a8164',
                            'selectors' => [
                                '{{WRAPPER}} .accordion-navigation-tabs-container .accordion-navigation-tabs-title .item-tabs-title.active' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->add_responsive_control(
                'title_tab_ant_gap',
                [
                    'label' => __( 'Gap', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 20,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-container .accordion-navigation-tabs-title .item-tabs-title' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_tab_ant_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 38,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-container .accordion-navigation-tabs-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


        $this->end_controls_section();
    }


    protected function register_style_tabs_content_section_controls() {
        $this->start_controls_section(
            'style_tabs_content_section',[
                'label' => __( 'Tabs Content', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

            $this->add_responsive_control(
                'Padding Items',
                [
                    'label' => __( 'Padding', 'elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-container .accordion-navigation-tabs-content .item-tabs-content > .item-team' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'border_item_ant_color',
                [
                    'label' => __( 'Border Color Items', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#979797',
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-container .accordion-navigation-tabs-content .item-tabs-content > .item-team' => 'border-bottom-color: {{VALUE}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'border_item_ant_width',
                [
                    'label' => __( 'Border Width Items', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 2,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-container .accordion-navigation-tabs-content .item-tabs-content > .item-team' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // style images tabs
            $this->add_control(
                'image_ant_heading',
                [
                    'label' => __( 'Images', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'width_image_ant',
                [
                    'label' => __( 'Width (px)', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 800,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .content-team .thumbnail-team' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .content-team .meta-team' => 'width: calc(100% - {{SIZE}}{{UNIT}})',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_ant_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 0,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .content-team .thumbnail-team' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            // style name tabs
            $this->add_control(
                'name_ant_heading',
                [
                    'label' => __( 'Name', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'name_ant_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team .name',
                ]
            );

            $this->add_control(
                'name_ant_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2F2F39',
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team .name' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'name_ant_alignment',
                [
                    'label' => __( 'Alignment', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team .name' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'name_ant_spacing',
                [
                    'label' => __( 'Spacing', 'elementor' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 11,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team .name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team .list-social-team' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


            // style info team tabs
            $this->add_control(
                'info_team_ant_heading',
                [
                    'label' => __( 'Info Items', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'info_team_ant_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team p._item-info',
                ]
            );

            $this->add_control(
                'info_team_ant_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2F2F39',
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team p._item-info' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'info_team_ant_alignment',
                [
                    'label' => __( 'Alignment', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team p._item-info' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            // style description tabs
            $this->add_control(
                'description_ant_heading',
                [
                    'label' => __( 'Description', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'description_ant_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team .description',
                ]
            );

            $this->add_control(
                'description_ant_color',
                [
                    'label' => __( 'Color', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#2F2F39',
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team .description' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'description_ant_alignment',
                [
                    'label' => __( 'Alignment', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'bearsthemes-addons' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team .description' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'description_ant_padding',
                [
                    'label' => __( 'Padding', 'elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .meta-team .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );


            // style CTA tabs
            $this->add_control(
                'cta_ant_heading',
                [
                    'label' => __( 'Button', 'bearsthemes-addons' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'cta_ant_typography',
                    'default' => '',
                    'selector' => '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .cta span',
                ]
            );

            $this->start_controls_tabs('tab_cta_tab');
                $this->start_controls_tab(
                    'cta_tab_normal',
                    [
                        'label' => __( 'Normal', 'bearsthemes-addons' ),
                    ]
                );

                    $this->add_control(
                        'cta_normal_color',
                        [
                            'label' => __( 'Color', 'bearsthemes-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#2F2F39',
                            'selectors' => [
                                '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .cta span' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .cta span i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'cta_normal_background_color',
                        [
                            'label' => __( 'Background Color', 'bearsthemes-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => 'transparent',
                            'selectors' => [
                                '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .cta span' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'cta_ant_border_radius',
                        [
                            'label' => __( 'Border Radius', 'elementor' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .cta span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'cta_tab_hover',
                    [
                        'label' => __( 'Hover', 'bearsthemes-addons' ),
                    ]
                );

                    $this->add_control(
                        'cta_normal_color_hover',
                        [
                            'label' => __( 'Color', 'bearsthemes-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#2F2F39',
                            'selectors' => [
                                '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .cta span:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .cta span:hover i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'cta_normal_background_color_hover',
                        [
                            'label' => __( 'Background Color', 'bearsthemes-addons' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => 'transparent',
                            'selectors' => [
                                '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .cta span:hover' => 'background-color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'cta_ant_border_radius_hover',
                        [
                            'label' => __( 'Border Radius', 'elementor' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .cta span:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();


            $this->add_responsive_control(
                'cta_ant_padding',
                [
                    'label' => __( 'Padding', 'elementor' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .accordion-navigation-tabs-content .item-team .cta span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    protected function register_style_tabs_social_section_controls() {
        $this->start_controls_section(
            'style_tabs_social_section',[
                'label' => __( 'Social', 'bearsthemes-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
             ]
        );

        $this->add_responsive_control(
            'width_social_ant',
            [
                'label' => __( 'Width', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-navigation-tabs-content .meta-team .list-social-team > a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'height_social_ant',
            [
                'label' => __( 'Height', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-navigation-tabs-content .meta-team .list-social-team > a' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'font_size_social_ant',
            [
                'label' => __( 'Font Size', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 25,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-navigation-tabs-content .meta-team .list-social-team > a i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );


        $this->add_responsive_control(
            'spacing_social_ant',
            [
                'label' => __( 'Spacing', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 5,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-navigation-tabs-content .meta-team .list-social-team > a' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'social_background_color_ant',
            [
                'label' => __( 'Background Color', 'bearsthemes-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .accordion-navigation-tabs-content .meta-team .list-social-team > a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_color_ant',
            [
                'label' => __( 'Color', 'bearsthemes-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .accordion-navigation-tabs-content .meta-team .list-social-team > a i' => 'color: {{VALUE}};',
                ],
            ]
        );



        $this->end_controls_section();
    }

    // function query post type team
    protected function bears_show_post_team_for_select(){
        $supported_ids = [];

        $wp_query = new \WP_Query( array(
            'post_type' => 'team',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'DESC',
        ) );

        if ( $wp_query->have_posts() ) {
            while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                $supported_ids[get_the_ID()] = get_the_title();
            }
        }



        return $supported_ids;
    }



    protected function register_controls() {
        $this->register_tabs_section_controls();
        $this->register_style_title_section_controls();
        $this->register_style_tabs_title_section_controls();
        $this->register_style_tabs_content_section_controls();
        $this->register_style_tabs_social_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $heading  = $settings['title_accordion_navigation_tabs'];
        $items = $settings['list_tabs_items'];
        $order = $settings['order_tabs'] ? $settings['order_tabs'] : 'DESC';


        ?>
        <div class="bt-elements-elementor accordion-navigation-tabs-elements">

            <div class="content-elements">
                <?php if ($heading): ?>
                    <h2 class="heading"> <?php echo $heading ?> </h2>
                <?php endif; ?>
                <?php if ($items): ?>
                    <div class="accordion-navigation-tabs-container">
                        <div class="accordion-navigation-tabs-warp">
                            <div class="accordion-navigation-tabs-title">
                                <?php foreach ($items as $key => $item): ?>
                                    <?php $activeTitle = ($key == 0) ? "active" : " " ;?>
                                    <?php if ($item['title']): ?>
                                        <?php
                                        $slug=preg_replace('/[^A-Za-z0-9-]+/', '-',strtolower($item['title']));

                                        ?>
                                        <div class="items item-tabs-title <?php echo $activeTitle; ?>" data-tab="bears-tab-<?php echo $key ?>" data-active="active_tab=<?php echo $slug ?>">
                                            <?php echo $item['title'];  ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="accordion-navigation-tabs-content">
                                <?php foreach ($items as $key => $item): ?>
                                    <?php $activeContent = ($key == 0) ? "active" : " " ;?>
                                    <?php $ids = $item['post_ids_tabs'] ?>
                                    <?php $apply_search = $item['apply_search'] ?>
                                    <?php //if ($ids): ?>
                                        <div class="items item-tabs-content bears-tab-<?php echo $key ?> <?php echo $activeContent; ?>">
                                            <?php $this->get_team_template($ids, $order, $item); ?>
                                        </div>
                                    <?php //endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    protected function get_team_template($id, $order, $item = array()) {
        if($item['apply_search']){
          echo do_shortcode($item['add_shortcode']);
        }else{
          $loop = new \WP_Query( array(
              'post_type' => 'team',
              'post_status' => 'publish',
              'post__in' => $id,
              'orderby' => 'menu_order',
              'order' =>  $order,
              'posts_per_page'=>-1,
          ) ); ?>

          <?php
          while ( $loop->have_posts() ) : $loop->the_post();
            include(ELEMENT_ADDON_TEMPLATE.'team/item-team.php');
          endwhile;
          wp_reset_postdata();
        }
    }

    protected function _content_template() {

    }
}
