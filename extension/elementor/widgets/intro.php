<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class event_conference_widget_intro extends Widget_Base {

    public function get_categories() {
        return array( 'event_conference_widgets' );
    }

    public function get_name() {
        return 'event_conference_intro';
    }

    public function get_title() {
        return esc_html__( 'Intro Theme', 'event_conference' );
    }

    public function get_icon() {
        return 'fa fa-indent';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Intro', 'event_conference' ),
            ]
        );

        $this->add_control(
            'heading',
            [
                'label'         =>  esc_html__( 'Heading', 'event_conference' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Heading Text', 'event_conference' ),
                'label_block'   => true,
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label'         =>  esc_html__( 'Sub Heading', 'event_conference' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Sub Heading Text', 'event_conference' ),
                'label_block'   => true,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Title', 'event_conference' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title' , 'event_conference' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_sub_title', [
                'label' => esc_html__( 'Sub Title', 'event_conference' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Sub Title' , 'event_conference' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'event_conference' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Item content. Click the edit button to change this text.', 'event_conference' ),
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Repeater Intro', 'event_conference' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Title #1', 'event_conference' ),
                        'list_sub_title' => esc_html__( 'Sub Title #1', 'event_conference' ),
                        'description' => esc_html__( 'Item content. Click the edit button to change this text.', 'event_conference' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Title #2', 'event_conference' ),
                        'list_sub_title' => esc_html__( 'Sub Title #2', 'event_conference' ),
                        'description' => esc_html__( 'Item content. Click the edit button to change this text.', 'event_conference' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_intro',
            [
                'label' => esc_html__( 'Style Intro', 'event_conference' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Heading Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-intro .element-intro__heading' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'sub_heading_color',
            [
                'label' => esc_html__( 'Sub Heading Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-intro .element-intro__heading strong' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_list_color',
            [
                'label' => esc_html__( 'Title Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-intro .element-intro__list--title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'sub_title_list_color',
            [
                'label' => esc_html__( 'Sub Title Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-intro .element-intro__list--sub-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Description Color', 'event_conference' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .element-intro .element-intro__list--description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

    ?>

        <div class="element-intro">
            <h4 class="element-intro__heading">
                <?php echo esc_attr( $settings['heading'] ); ?>

                <strong>
                    <?php echo esc_attr( $settings['sub_heading'] ); ?>
                </strong>
            </h4>

            <?php if ( !empty( $settings['list'] ) ) : ?>

                <div class="element-intro__list">

                    <?php foreach ( $settings['list'] as $item ) : ?>

                        <div class="element-intro__list--item">
                            <h3 class="element-intro__list--title">
                                <?php echo esc_html( $item['list_title'] ); ?>
                            </h3>

                            <p class="element-intro__list--sub-title">
                                <?php echo esc_html( $item['list_sub_title'] ); ?>
                            </p>

                            <p class="element-intro__list--description">
                                <?php echo esc_html( $item['description'] ); ?>
                            </p>
                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>
        </div>

    <?php

    }

    protected function _content_template() {

    ?>

        <div class="element-intro">
            <h4 class="element-intro__heading">
                {{{ settings.heading }}}

                <strong>
                    {{{ settings.sub_heading }}}
                </strong>
            </h4>

            <# if ( settings.list.length ) { #>

                <div class="element-intro__list">
                    <# _.each( settings.list, function( item ) { #>

                        <div class="element-intro__list--item">
                            <h3 class="element-intro__list--title">
                                {{{ item.list_title }}}
                            </h3>

                            <p class="element-intro__list--sub-title">
                                {{{ item.list_sub_title }}}
                            </p>

                            <p class="element-intro__list--description">
                                {{{ item.description }}}
                            </p>
                        </div>

                    <# }); #>
                </div>

            <# } #>
        </div>

    <?php

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new event_conference_widget_intro );