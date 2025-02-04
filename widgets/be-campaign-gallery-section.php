<?php
/**
* Element Campaign Gallery Section
*/

namespace ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Campaign_Gallery_Section extends Widget_Base {

    public function get_name() {
        return 'be-campaign-gallery-section';
    }

    public function get_title() {
        return __( 'Campaign Gallery Section', 'bearsthemes-addons' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
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
        $this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'bearsthemes-addons' ),
			]
		);

        $this->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Images', 'textdomain' ),
				'type' => Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

        $this->end_controls_section();
    }


    protected function register_style_image_controls() {
        
    }


    protected function register_style_content_section_controls() {

    }

    protected function register_controls() {
        $this->register_content_section_controls();
        $this->register_style_image_controls();
        $this->register_style_content_section_controls();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if(empty($settings['gallery'])) return;

        ?>
        <div class="bt-elements-elementor bt-campaign-gallery-section">
            <div class="bt-images-slider">
                <div class="swiper-container btSwiper2 swiper">
                    <div class="swiper-wrapper">
                        <?php foreach($settings['gallery'] as $image) { ?>
                            <div class="swiper-slide">
                                <a class="bt-expand-btn bt-image-popup" href="<?php echo $image['url']; ?>" title="<?php echo get_the_title($image['id']); ?>" data-elementor-open-lightbox="no">
                                    <?php echo __('Expand', 'bearsthemes-addons'); ?>
                                    <svg width="21px" height="21px" viewBox="0 0 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>Shape</title>
                                        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="ICA-Campaign-Landing---Limited-Docs" transform="translate(-1281, -3409)" fill="#000000" fill-rule="nonzero">
                                                <g id="Group" transform="translate(334, 2870)">
                                                    <g id="Group-3" transform="translate(0, 506)">
                                                        <g id="Expand" transform="translate(864, 25)">
                                                            <g id="expand-solid" transform="translate(83, 8)">
                                                                <path d="M1.5,0 C0.6703125,0 0,0.6703125 0,1.5 L0,6 C0,6.8296875 0.6703125,7.5 1.5,7.5 C2.3296875,7.5 3,6.8296875 3,6 L3,3 L6,3 C6.8296875,3 7.5,2.3296875 7.5,1.5 C7.5,0.6703125 6.8296875,0 6,0 L1.5,0 Z M3,15 C3,14.1703125 2.3296875,13.5 1.5,13.5 C0.6703125,13.5 0,14.1703125 0,15 L0,19.5 C0,20.3296875 0.6703125,21 1.5,21 L6,21 C6.8296875,21 7.5,20.3296875 7.5,19.5 C7.5,18.6703125 6.8296875,18 6,18 L3,18 L3,15 Z M15,0 C14.1703125,0 13.5,0.6703125 13.5,1.5 C13.5,2.3296875 14.1703125,3 15,3 L18,3 L18,6 C18,6.8296875 18.6703125,7.5 19.5,7.5 C20.3296875,7.5 21,6.8296875 21,6 L21,1.5 C21,0.6703125 20.3296875,0 19.5,0 L15,0 Z M21,15 C21,14.1703125 20.3296875,13.5 19.5,13.5 C18.6703125,13.5 18,14.1703125 18,15 L18,18 L15,18 C14.1703125,18 13.5,18.6703125 13.5,19.5 C13.5,20.3296875 14.1703125,21 15,21 L19.5,21 C20.3296875,21 21,20.3296875 21,19.5 L21,15 Z" id="Shape"></path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>

                                <div class="bt-cover-image">
                                    <?php echo wp_get_attachment_image( $image['id'], 'large' ); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                
                <div class="swiper-container btSwiper swiper">
                    <div class="swiper-wrapper">
                        <?php foreach($settings['gallery'] as $image) { ?>
                            <div class="swiper-slide">
                                <div class="bt-cover-image">
                                    <?php echo wp_get_attachment_image( $image['id'], 'thumbnail' ); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <?php
    }

    protected function _content_template() {

    }
}
