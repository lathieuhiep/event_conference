<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class event_conference_widget_video_html extends Widget_Base {

    public function get_categories() {
        return array( 'event_conference_widgets' );
    }

    public function get_name() {
        return 'event_conference_video_html';
    }

    public function get_title() {
        return esc_html__( 'Video HTML Theme', 'event_conference' );
    }

    public function get_icon() {
        return 'fa fa-video-camera';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_video',
            [
                'label' => esc_html__( 'Video', 'event_conference' ),
            ]
        );

        $this->add_control(
            'video_image_mobile',
            [
                'label'     =>  esc_html__( 'Image Video Show Mobile', 'logi' ),
                'type'      =>  Controls_Manager::MEDIA,
                'default'   =>  [
                    'url'   =>  Utils::get_placeholder_image_src(),
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-video__bk-mobile' => 'background-image: url({{URL}})',
                ],
            ]
        );

        $this->add_control(
            'video_html_url',
            [
                'label' => esc_html__( 'URL Video', 'event_conference' ),
                'type' => Controls_Manager::MEDIA,
                'media_type' => 'video',
            ]
        );

        $this->add_control(
            'video_options',
            [
                'label' => esc_html__( 'Video Options', 'event_conference' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'event_conference' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'mute',
            [
                'label' => esc_html__( 'Mute', 'event_conference' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => esc_html__( 'Loop', 'event_conference' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'controls',
            [
                'label' => esc_html__( 'Player Controls', 'event_conference' ),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Hide', 'event_conference' ),
                'label_on' => esc_html__( 'Show', 'event_conference' ),
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();
        $video_url      =   $settings['video_html_url']['url'];
        $autoplay       =   $settings['autoplay'] ? ' autoplay' : '';
        $mute           =   $settings['mute'] ? ' muted' : '';
        $loop           =   $settings['loop'] ? ' loop' : '';
        $controls       =   $settings['controls'] == 'yes' ? ' controls' : '';

        $video_params   =   $autoplay . $mute . $loop . $controls;

    ?>

        <div class="element-video">
            <div class="element-video__bk-mobile d-lg-none"></div>

            <video class="element-video__item" <?php echo esc_attr( $video_params ); ?>>
                <source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4">
            </video>
        </div>

    <?php

    }

    protected function _content_template() {

    ?>

        <#
        var video_url    =  settings.video_html_url.url,
         autoplay     =  settings.autoplay ? ' autoplay' : '',
         mute         =  settings.mute ? ' muted' : '',
         loop         =  settings.loop ? ' loop' : '',
         controls     =  settings.controls === 'yes' ? ' controls' : '';

        #>

        <div class="element-video">
            <div class="element-video__bk-mobile d-lg-none"></div>

            <video class="element-video__item" {{ autoplay }}{{ mute }}{{ loop }}{{ controls }}>
                <source src="{{ video_url }}" type="video/mp4">
            </video>
        </div>

    <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new event_conference_widget_video_html );