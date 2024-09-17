<?php
/**
* Element Campaign Documents Section
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Campaign_Documents_Section extends Widget_Base {

    public function get_name() {
        return 'be-campaign-documents-section';
    }

    public function get_title() {
        return __( 'Campaign Documents Section', 'bearsthemes-addons' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'bearsthemes-addons' ];
    }

    public function get_script_depends() {
		return [ 'elementor-addons' ];
	}

    public function get_style_depends() {
		return [ 'elementor-addons' ];
	}

    protected function register_content_section_controls() {
        
    }


    protected function register_style_image_controls() {
        
    }


    protected function register_style_content_section_controls() {
        $this->start_controls_section(
			'section_design_content',
			[
				'label' => __( 'Content', 'bearsthemes-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'heading_style',
			[
				'label' => __( 'Heading', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-heading',
			]
		);

        $this->add_responsive_control(
            'heading_max_width',
            [
                'type' => Controls_Manager::SLIDER,
                'label' => __( 'Max Width', 'bearsthemes-addons' ),
                'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 1000,
                                'step' => 5,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                'default' => [
                            'unit' => '%',
                            'size' => 100,
                        ],
                'selectors' => [
                    '{{WRAPPER}} .bt-heading' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
			'title_style',
			[
				'label' => __( 'Title', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-document__title a' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-document__title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-document__title a',
			]
		);

        $this->add_control(
			'link_style',
			[
				'label' => __( 'Link', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-document__pdf' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'link_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-document__pdf:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-document__pdf',
			]
		);

        $this->end_controls_section();
    }

    protected function register_controls() {
        $this->register_content_section_controls();
        $this->register_style_image_controls();
        $this->register_style_content_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $heading = get_field('ds_heading');
        $documents = get_field('ds_documents');
        
        ?>
        <div class="bt-elements-elementor bt-campaign-documents-section">
            <?php 
                if(!empty($heading)) {
                    echo '<h2 class="bt-heading">' . $heading . '</h2>';
                }
            ?>
            
            <?php if(!empty($documents)){ ?>
                <div class="bt-documents <?php if(count($documents) < 3) echo 'bt-align-center'; ?>">
                    <?php foreach($documents as $key => $document) { ?>
                        <div class="bt-document bt-item" style="<?php if($key > 2) echo 'display: none;'; ?>">
                            <div class="bt-document__image">
                                <?php 
                                if(!empty($document['download_link'])) {
                                    if(!empty($document['image']['url'])) {
                                        echo '<a class="bt-document__pdf" href="' . $document['download_link']['url'] . '">
                                                <img src="' . $document['image']['url'] . '" alt="' . $document['image']['title'] . '" />
                                            </a>'; 
                                    } else {
                                        echo '<a class="bt-document__pdf" href="' . $document['download_link']['url'] . '">
                                                <img src="' . plugins_url( '/images/document.png', __FILE__ ) . '" alt="" />
                                            </a>';
                                    }
                                }else {
                                    if(!empty($document['image']['url'])) {
                                        echo '<img src="' . $document['image']['url'] . '" alt="' . $document['image']['title'] . '" />'; 
                                    } else {
                                        echo '<img src="' . plugins_url( '/images/document.png', __FILE__ ) . '" alt="" />'; 
                                    }
                                }
                                ?>
                            </div>
                            <?php if(!empty($document['title'])) { ?>
                                <h3 class="bt-document__title">
                                    <?php 
                                        if(!empty($document['download_link'])) {
                                            echo '<a href="' . esc_url($document['download_link']['url']) . '">' . $document['title'] . '</a>'; 
                                        } else {
                                            echo $document['title']; 
                                        }
                                    ?>
                                </h3>
                            <?php } ?>

                            <?php if(!empty($document['download_link'])) { ?>
                                <a class="bt-document__pdf" href="<?php echo $document['download_link']['url']; ?>">
                                    <?php echo __('Download PDF', 'bearsthemes-addons'); ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

                <?php if(count($documents) > 3) { ?>
                    <div class="bt-loadmore">
                        <div class="bt-loadmore__text">
                            <?php echo '3 of ' . count($documents) . '.  Show more'; ?>
                        </div>
                        <a href="#" class="bt-loadmore__btn">Load more</a>   
                    </div>
                <?php } ?>  

            <?php } ?>
        </div>
        <?php
    }

    protected function _content_template() {

    }
}
