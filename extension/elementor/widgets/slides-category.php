<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class event_conference_slides_category extends Widget_Base {

    public function get_categories() {
        return array( 'event_conference_widgets' );
    }

    public function get_name() {
        return 'event_conference_slides_category';
    }

    public function get_title() {
        return esc_html__( 'Slides Category Theme', 'event_conference' );
    }

    public function get_icon() {
        return 'fa fa-book';
    }

    public function get_script_depends() {
        return ['event_conference-elementor-custom'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_get_cat',
            [
                'label' =>  esc_html__( 'Category', 'event_conference' )
            ]
        );

        $this->add_control(
            'slides_category_select',
            [
                'label'         =>  esc_html__( 'Select Category Post', 'event_conference' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  event_conference_check_get_cat( 'category' ),
                'multiple'      =>  true,
                'label_block'   =>  true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slides_category_options',
            [
                'label' => esc_html__( 'Slides Category Options', 'event_conference' ),
                'tab' => Controls_Manager::SECTION
            ]
        );

        $this->add_control(
            'slides_category_item',
            [
                'label'     =>  esc_html__( 'Number of Item', 'event_conference' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  3,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'loop',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__('Loop Slider ?', 'event_conference'),
                'label_off'     =>  esc_html__('No', 'event_conference'),
                'label_on'      =>  esc_html__('Yes', 'event_conference'),
                'return_value'  =>  'yes',
                'default'       =>  'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__('Autoplay?', 'event_conference'),
                'type'          => Controls_Manager::SWITCHER,
                'label_off'     => esc_html__('No', 'event_conference'),
                'label_on'      => esc_html__('Yes', 'event_conference'),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label'         => esc_html__('Dots Slider', 'event_conference'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Yes', 'event_conference'),
                'label_off'     => esc_html__('No', 'event_conference'),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__( 'Style', 'event_conference' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides-cat .element-slides-cat__item--content .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Description Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-slides-cat .element-slides-cat__item--content .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();

        if ( !empty( $settings['slides_category_select'] ) ) :

            $event_conference_slides_cat_settings     =   [
                'number_item'   =>  $settings['slides_category_item'],
                'loop'          =>  ( 'yes' === $settings['loop'] ),
                'autoplay'      =>  ( 'yes' === $settings['autoplay'] ),
                'dots'          =>  ( 'yes' === $settings['dots'] ),
            ];

    ?>

        <div class="element-slides-cat owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $event_conference_slides_cat_settings ) ); ?>'>
            <?php
            foreach ( $settings['slides_category_select'] as $item ) :
                $term = get_term( $item, 'category' );

            ?>

                <div class="element-slides-cat__item">
                    <a class="link-item" href="<?php echo esc_url( get_category_link( $term ) ); ?>" title="<?php echo esc_attr( $term->name ); ?>"></a>

                    <figure class="element-slides-cat__item--image">
                        <?php if (function_exists('z_taxonomy_image')) : ?>
                            <?php z_taxonomy_image( $term->term_id, 'medium_large' ); ?>
                        <?php endif; ?>
                    </figure>

                    <div class="element-slides-cat__item--content text-center">
                        <h3 class="title">
                            <?php echo esc_html( $term->name ); ?>
                        </h3>

                        <p class="description">
                            <?php echo esc_html( $term->description ); ?>
                        </p>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    <?php
        endif;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new event_conference_slides_category );