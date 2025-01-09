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
        wp_localize_script( 'elementor-addons', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
		return [ 'elementor-addons' ];
	}

    public function get_style_depends() {
		return [ 'elementor-addons' ];
	}

    protected function register_content_section_controls() {
        // Start Content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'your-plugin' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Add the post type select control
        $this->add_control(
            'documents_source',
            [
                'label' => __( 'Select Documents Source', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ica_reports' => __('ICA Reports (Resources)'),
                    'acf_uploaded_documents' => __('ACF Uploaded Documents'),
                ],
                'default' => 'ica_reports',  // Default post type
            ]
        );

        // Add Heading textarea control
        $this->add_control(
            'heading',
            [
                'label' => __( 'Section Heading', 'bearsthemes-addons' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Related reports', 'bearsthemes-addons' ),
                'placeholder' => __( 'Enter your heading', 'bearsthemes-addons' ),
                'condition' => [
                    'documents_source' => 'ica_reports',
                ],
            ]
        );

        // Add Number Reports control
        $this->add_control(
			'number_posts',
			[
				'label' => __( 'Number Reports', 'bearsthemes-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3,
                'condition' => [
                    'documents_source' => 'ica_reports',
                ],
			]
		);

        // Add Order Reports control
        $this->add_control(
            'order_by',
            [
                'label' => __( 'Order By', 'bearsthemes-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => __('Date Ascending'),
                    'DESC' => __('Date Descending'),
                ],
                'default' => 'DESC',
                'condition' => [
                    'documents_source' => 'ica_reports',
                ],
            ]
        );

        // End Content section
        $this->end_controls_section();
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

    /**
	 * Get ICA Reports Campaign Documents
	 */
	function ica_get_reports_campaign_documents($number_posts, $page, $order_by) {

		$reports = get_posts( array(
			'post_type' => 'resources',
			'posts_per_page' => $number_posts,
			'paged' => $page,
			'post_status' => 'publish',
			'order_by' => 'date',
			'order' => $order_by,
			'tax_query' => array(
				array(
					'taxonomy' => 'ins-type',
					'field' => 'term_id',
					'terms' => 18, // ICA reports term ID
					'operator' => 'IN'
				)
			)
		));

		wp_reset_postdata();

		if (!empty($reports)) return $reports;
	}

    protected function render() {
        $settings = $this->get_settings_for_display();

        $documents_source = $settings['documents_source'];
        $heading = get_field('ds_heading');
        $documents = get_field('ds_documents');
        ?>
        <?php if ($documents_source == 'ica_reports'): 
            $section_heading = $settings['heading'];
            $number_posts = $settings['number_posts'];
            $order_by = $settings['order_by'];
            $all_resources = $this->ica_get_reports_campaign_documents('-1', '1', $order_by);
            $resources = $this->ica_get_reports_campaign_documents($number_posts, '1', $order_by);
            ?>
            <!-- ICA Rreports -->
            <div class="bt-elements-elementor bt-campaign-documents-section ica-reports"
                data-number-posts="<?php echo $number_posts; ?>"
                data-total-posts="<?php echo count($all_resources); ?>"
                data-order-by="<?php echo $order_by; ?>">
                <?php 
                if(!empty($section_heading)) {
                    echo '<h2 class="bt-heading">' . $section_heading . '</h2>';
                } ?>
                <?php if (!empty($resources)): ?>
                    <div class="bt-documents reports">
                    <?php foreach ($resources as $resource): 
                        $file_type = get_field('select_type_resources', $resource->ID);
                        $file_upload = get_field('upload_file', $resource->ID);
                        ?>
                        <div id="<?php echo $resource->ID; ?>" class="bt-document bt-item">
                            <a href="<?php echo get_the_permalink($resource->ID); ?>">
                                <div class="bt-document__image">
                                    <?php echo get_the_post_thumbnail($resource->ID, 'large'); ?>
                                </div>
                                <h3 class="bt-document__title">
                                    <?php echo get_the_title($resource->ID); ?>
                                </h3>
                            </a>
                            <?php if ($file_type == 'PDF' && !empty($file_upload['url'])): ?>
                                <a class="bt-document__pdf" href="<?php echo esc_url($file_upload['url']); ?>" download>
                                    <?php echo __('Download PDF', 'elementor-addons'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <?php if (count($all_resources) > count($resources)): ?>
                        <div class="bt-loadmore">
                            <div class="spinner-wrapper">
                                <div class="spinner"></div>
                            </div>
                            <div class="bt-loadmore__text">
                                <?php echo count($resources) .' of '. count($all_resources) . '.  Show more'; ?>
                            </div>
                            <button class="bt-loadmore__btn btn-load-more-reports" data-next-page="2">
                                <?php echo file_get_contents(ELEMENT_ADDON_IMG_DIR . 'green-chevron-in-circle.svg'); ?>
                            </button>   
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <!-- /ICA Rreports -->
        <?php else: ?>
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
                                $thumb_default_url = ELEMENT_ADDON_IMG_DIR . 'card-thumbnail-default.png';
                                if (!empty($document['download_link'])) {
                                    $attachment_id = $document['download_link']['id'] ?? null;
                                    $att_thumb_url = wp_get_attachment_image_url($attachment_id, 'medium_large');
                                    $att_thumb_url = !empty($att_thumb_url) ? $att_thumb_url : $thumb_default_url;
                                    if(!empty($document['image']['url'])) {
                                        echo '<a class="bt-document__pdf" href="' . $document['download_link']['url'] . '">
                                                <img src="' . $document['image']['url'] . '" alt="' . $document['image']['title'] . '" />
                                            </a>'; 
                                    } else {
                                        echo '<a class="bt-document__pdf" href="' . $document['download_link']['url'] . '">
                                                <img src="' . esc_attr($att_thumb_url) . '" alt="" />
                                            </a>';
                                    }
                                }
                                else {
                                    if (!empty($document['image']['url'])) {
                                        echo '<img src="' . $document['image']['url'] . '" alt="' . $document['image']['title'] . '" />'; 
                                    } else {
                                        echo '<img src="' . esc_attr($att_thumb_url) . '" alt="" />'; 
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
                                <a class="bt-document__pdf" href="<?php echo $document['download_link']['url']; ?>" download>
                                    <?php echo __('Download PDF', 'elementor-addons'); ?>
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
                        <a href="#" class="bt-loadmore__btn">
                            <?php echo file_get_contents(ELEMENT_ADDON_IMG_DIR . 'green-chevron-in-circle.svg'); ?>
                        </a>   
                    </div>
                <?php } ?>  

            <?php } ?>
        </div>
        <?php endif; ?>
        <?php
    }

    protected function _content_template() {

    }
}
