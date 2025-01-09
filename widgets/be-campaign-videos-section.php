<?php
/**
* Element Campaign Videos Section
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Campaign_Videos_Section extends Widget_Base {

    public function get_name() {
        return 'be-campaign-videos-section';
    }

    public function get_title() {
        return __( 'Campaign Videos Section', 'bearsthemes-addons' );
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
					'{{WRAPPER}} .bt-video__title a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bt-video__title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-video__title a',
			]
		);

        $this->add_control(
			'links_style',
			[
				'label' => __( 'Links', 'bearsthemes-addons' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'links_color',
			[
				'label' => __( 'Color', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-video__share-links a' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_control(
			'links_color_hover',
			[
				'label' => __( 'Color Hover', 'bearsthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bt-video__share-links a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'links_typography',
				'default' => '',
				'selector' => '{{WRAPPER}} .bt-video__share-links a',
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
        
        $heading = get_field('vs_heading');
        $videos = get_field('vs_videos');
        
        ?>
        <div class="bt-elements-elementor bt-campaign-videos-section">
            <?php 
                if(!empty($heading)) {
                    echo '<h2 class="bt-heading">' . $heading . '</h2>';
                }
            ?>
            
            <?php if(!empty($videos)){ ?>
                <div class="bt-videos <?php if(count($videos) < 3) echo 'bt-align-center'; ?>">
                    <?php foreach($videos as $key => $video) { ?>
                        <div class="bt-video bt-item" style="<?php if($key > 2) echo 'display: none;'; ?>">
                            <div class="bt-video__media">
                                <?php if(!empty($video['video_link'])) { ?>
                                    <a class="bt-video__link bt-video-popup" href="<?php echo esc_url($video['video_link']); ?>">
                                        <div class="bt-cover-image">
                                        <?php 
                                            if(!empty($video['poster'])) {
                                                echo '<img src="' . $video['poster']['url'] . '" alt="' . $video['poster']['title'] . '" />'; 
                                            }
                                        ?>
                                        <span class="bt-video__play">
                                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 494.942 494.942" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                                                <path d="m35.353 0 424.236 247.471L35.353 494.942z" fill="currentColor" opacity="1" data-original="currentColor" class=""></path>
                                            </svg>
                                        </span>
                                    </div>
                                    </a>
                                <?php } ?>
                                
                                
                            </div>
                            <?php if(!empty($video['title'])) { ?>
                                <h3 class="bt-video__title">
                                    <?php 
                                        if(!empty($video['video_link'])) {
                                            echo '<a class="bt-video__link bt-video-popup" href="' . esc_url($video['video_link']) . '">' . $video['title'] . '</a>'; 
                                        } else {
                                            echo $video['title']; 
                                        }
                                    ?>
                                </h3>
                            <?php } ?>

                            <?php if(!empty($video['share_link']) || !empty($video['subscribe_on_youtube_link'])) { ?>
                                <div class="bt-video__share-links">
                                    <?php if(!empty($video['share_link'])) { ?>
                                        <a href="<?php echo $video['share_link']; ?>">
                                            <?php echo __('Share', 'bearsthemes-addons'); ?>
                                        </a>
                                    <?php } ?>

                                    <?php if(!empty($video['subscribe_on_youtube_link'])) { ?>
                                        <a href="<?php echo $video['subscribe_on_youtube_link']; ?>">
                                            <?php echo __('Subscribe on Youtube', 'bearsthemes-addons'); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

                <?php if(count($videos) > 3) { ?>
                    <div class="bt-loadmore">
                        <div class="bt-loadmore__text">
                            <?php echo '3 of ' . count($videos) . '.  Show more'; ?>
                        </div>
                        <a href="#" class="bt-loadmore__btn">
                            <?php echo file_get_contents(ELEMENT_ADDON_IMG_DIR . 'green-chevron-in-circle.svg'); ?>
                        </a>   
                    </div>
                <?php } ?>  

            <?php } ?>
        </div>
        <?php
    }

    protected function _content_template() {

    }
}
