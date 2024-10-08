<?php

namespace ElementPack\Modules\CircleInfo\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit();
}

// Exit if accessed directly
class Circle_Info extends Widget_Base
{

    public function get_name()
    {
        return 'bdt-circle-info';
    }

    public function get_title()
    {
        return BDTEP . esc_html__('Circle Info', 'bdthemes-element-pack');
    }

    public function get_icon()
    {
        return 'bdt-wi-circle-info';
    }

    public function get_categories()
    {
        return [
            'element-pack',
        ];
    }

    public function get_style_depends()
    {
        return ['ep-circle-info'];
    }

    public function get_keywords()
    {
        return ['circle', 'info'];
    }

    public function get_script_depends()
    {
        return ['bdt-uikit-icons', 'ep-circle-info'];
    }

    public function get_custom_help_url()
    {
        return 'https://youtu.be/PIQ6BJtNpNU';
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_layouts',
            [
                'label' => esc_html__('Circle Info', 'element-pack'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'circle_info_item_title',
            [
                'label'       => __('Title', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Title Item', 'bdthemes-element-pack'),
                'default'     => __('Title Item', 'bdthemes-element-pack'),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'circle_info_item_details',
            [
                'label'       => __('Details', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => __("Default description. Lorem Ipsum is simply dummy text of the printing and typesetting industry.   ", 'bdthemes-element-pack'),
                'placeholder' => __('Type your description here', 'bdthemes-element-pack'),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'circle_info_item_icon',
            [
                'label'       => __('Icon', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
                'default'     => [
                    'value'   => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'circle_info_title_link',
            [
                'label'       => __('Link', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'label_block' => true,
                'placeholder' => __('https://your-link.com', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'circle_info_icon_list',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'separator'   => 'before',
                'default'     => [
                    [
                        'circle_info_item_title'   => esc_html__('List Item #1', 'bdthemes-element-pack'),
                        'circle_info_item_details' => esc_html__('@1 Click edit button to change this text. Lorem agaca ipsum dolor sit amet. Ut elit tellus, luctus nec ullam corper mattis, pulvinar dapibus leo.', 'bdthemes-element-pack'),
                        'circle_info_item_icon'    => [
                            'value'   => 'far fa-smile',
                            'library' => 'fa-regular'],
                    ],
                    [
                        'circle_info_item_title'   => esc_html__('List Item #2', 'bdthemes-element-pack'),
                        'circle_info_item_details' => esc_html__('@2 Click edit button to change this text. Lorem agaca ipsum dolor sit amet. Ut elit tellus, luctus nec ullam corper mattis, pulvinar dapibus meo.', 'bdthemes-element-pack'),
                        'circle_info_item_icon'    => [
                            'value'   => 'fas fa-brain',
                            'library' => 'fa-solid'],
                    ],
                    [
                        'circle_info_item_title'   => esc_html__('List Item #3', 'bdthemes-element-pack'),
                        'circle_info_item_details' => esc_html__('@3 Click edit button to change this text. Lorem agaca ipsum dolor sit amet. Ut elit tellus, luctus nec ullam corper mattis, pulvinar dapibus leo.', 'bdthemes-element-pack'),
                        'circle_info_item_icon'    => [
                            'value'   => 'far fa-check-circle',
                            'library' => 'fa-regular'],
                    ],
                    [
                        'circle_info_item_title'   => esc_html__('List Item #4', 'bdthemes-element-pack'),
                        'circle_info_item_details' => esc_html__('@4 Click edit button to change this text. Lorem agaca ipsum dolor sit amet. Ut elit tellus, luctus nec ullam corper mattis, pulvinar dapibus meo.', 'bdthemes-element-pack'),
                        'circle_info_item_icon'    => [
                            'value'   => 'fas fa-cog',
                            'library' => 'fa-solid'],
                    ],
                    [
                        'circle_info_item_title'   => esc_html__('List Item #5', 'bdthemes-element-pack'),
                        'circle_info_item_details' => esc_html__('@5 Click edit button to change this text. Lorem agaca ipsum dolor sit amet. Ut elit tellus, luctus nec ullam corper mattis, pulvinar dapibus leo.', 'bdthemes-element-pack'),
                        'circle_info_item_icon'    => [
                            'value'   => 'fas fa-dice-d6',
                            'library' => 'fa-solid'],
                    ],
                    [
                        'circle_info_item_title'   => esc_html__('List Item #6', 'bdthemes-element-pack'),
                        'circle_info_item_details' => esc_html__('@6 Click edit button to change this text. Lorem agaca ipsum dolor sit amet. Ut elit tellus, luctus nec ullam corper mattis, pulvinar dapibus meo.', 'bdthemes-element-pack'),
                        'circle_info_item_icon'    => [
                            'value'   => 'fas fa-asterisk',
                            'library' => 'fa-solid'],
                    ],
                ],
                'title_field' => '{{{ circle_info_item_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layouts1',
            [
                'label' => esc_html__('Additional Info', 'element-pack'),
            ]
        );

        $this->add_control(
			'title_tags',
			[
				'label'   => __( 'Title HTML Tag', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'span',
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
			]
		);

        $this->add_control(
            'circle_info_size',
            [
                'label'     => __('Circle Size ', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 400,
                ],
                'range'     => [
                    'px' => [
                        'min' => 200,
                        'max' => 1500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-wrapper' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'circle_info_custom_margin',
            [
                'label' => __('Custom Margin', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'circle_info_margin',
            [
                'label'     => __('Margin', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition' => [
                    'circle_info_custom_margin' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'circle_info_icon_area_size',
            [
                'label'     => __('Icon Area Size', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'circle_info_icon_size',
            [
                'label'     => __('Icon Size', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle i, 
                     {{WRAPPER}} .bdt-circle-info .bdt-circle-info-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle, 
                     {{WRAPPER}} .bdt-circle-info .bdt-circle-info-icon'  => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'circle_info_event',
            [
                'label'   => __('Select Event ', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'mouseover',
                'options' => [
                    'click'     => __('Click', 'bdthemes-element-pack'),
                    'mouseover' => __('Hover', 'bdthemes-element-pack'),
                ],
            ]
        );

        $this->add_control(
            'circle_info_auto_mode',
            [
                'label' => __('Auto Mode', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'circle_info_auto_time',
            [
                'label'     => __('Time (ms)', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 3000,
                ],
                'range'     => [
                    'px' => [
                        'min' => 1000,
                        'max' => 10000,
                    ],
                ],
                'condition' => [
                    'circle_info_auto_mode' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'circle_info_icon_style',
            [
                'label' => __('Icon', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_mode_style');

        $this->start_controls_tab(
            'circle_info_tab_icon_normal',
            [
                'label' => __('Normal  ', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'circle_info_icon_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle i,  
                     {{WRAPPER}} .bdt-circle-info .bdt-circle-info-content-wrapper .bdt-circle-info-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle svg ,  
                     {{WRAPPER}} .bdt-circle-info .bdt-circle-info-content-wrapper .bdt-circle-info-icon svg'   => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'circle_info_icon_background',
            [
                'label'     => __('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle, 
                     {{WRAPPER}}  .bdt-circle-info .bdt-circle-info-content-wrapper .bdt-circle-info-item .bdt-circle-info-icon ' => 'background-color: {{VALUE}} ',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(), [
                'name'     => 'circle_info_icon_box_shadow',
                'label'    => __('Shadow', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle, {{WRAPPER}} .bdt-circle-info-content-wrapper .bdt-circle-info-item .bdt-circle-info-icon',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'circle_info_tab_icon_hover',
            [
                'label' => __('Hover  ', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'circle_info_icon_color_hover',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle:hover i, 
                     {{WRAPPER}} .bdt-circle-info .bdt-circle-info-content-wrapper .bdt-circle-info-icon:hover  i' => 'color: {{VALUE}} ',
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle:hover svg, 
                     {{WRAPPER}} .bdt-circle-info .bdt-circle-info-content-wrapper .bdt-circle-info-icon:hover svg'     => 'fill: {{VALUE}} ',
                ],
            ]
        );

        $this->add_control(
            'circle_info_icon_background_hover',
            [
                'label'     => __('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle:hover  '                             => 'background-color: {{VALUE}} ',
                    '{{WRAPPER}} .bdt-circle-info  .bdt-circle-info-content-wrapper .bdt-circle-info-item .bdt-circle-info-icon:hover' => 'background-color: {{VALUE}} ',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'circle_info_icon_box_shadow_hover',
                'label'    => __('Shadow', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle:hover, {{WRAPPER}} .bdt-circle-info-content-wrapper .bdt-circle-info-item .bdt-circle-info-icon:hover',

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'circle_info_tab_icon_active',
            [
                'label' => __('Active  ', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'circle_info_icon_color_active',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle.active i, 
                     {{WRAPPER}} .bdt-circle-info .bdt-circle-info-content-wrapper .bdt-circle-info-icon.active  i' => 'color: {{VALUE}} ',
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle.active svg, 
                     {{WRAPPER}} .bdt-circle-info .bdt-circle-info-content-wrapper .bdt-circle-info-icon.active svg' => 'fill: {{VALUE}} ',
                     '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-wrapper .bdt-info-sub-circle.active  i' => 'color: {{VALUE}} ',
                ],
            ]
        );

        $this->add_control(
            'circle_info_icon_background_active',
            [
                'label'     => __('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle.active' => 'background-color: {{VALUE}} ',
                    '{{WRAPPER}} .bdt-circle-info  .bdt-info-sub-circle.active' => 'background-color: {{VALUE}} ',
                    '{{WRAPPER}} .bdt-circle-info  .bdt-circle-info-content-wrapper .bdt-circle-info-item .bdt-circle-info-icon.active' => 'background-color: {{VALUE}} ',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'circle_info_icon_box_shadow_active',
                'label'    => __('Shadow', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle.active, {{WRAPPER}} .bdt-circle-info .bdt-info-sub-circle.active',

            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'circle_info_title_style',
            [
                'label' => __('Title', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_mode_style0');

        $this->start_controls_tab(
            'circle_info_tab_title_normal',
            [
                'label' => __('Normal  ', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'circle_info_title_color_normal',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#5f6671',
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item .bdt-circle-info-title, {{WRAPPER}} .bdt-circle-info .bdt-circle-info-content-wrapper .bdt-circle-info-item a ' => 'color: {{VALUE}} ',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'circle_info_title_typography',
                'selector' => '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item .bdt-circle-info-title, {{WRAPPER}} .bdt-circle-info .bdt-circle-info-content-wrapper .bdt-circle-info-item a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'circle_info_tab_title_hover', [
                'label' => __('Hover  ', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'circle_info_title_color_hover',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1e87f0',
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item .bdt-circle-info-title:hover, {{WRAPPER}} .bdt-circle-info .bdt-circle-info-content-wrapper .bdt-circle-info-item a:hover ' => 'color: {{VALUE}} ',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'circle_info_description_style',
            [
                'label' => __('Description', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_description_style');

        $this->start_controls_tab(
            'circle_info_tab_description_normal',
            [
                'label' => __('Normal  ', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'circle_info_description_color_normal',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#a3adb5',
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item .bdt-circle-info-desc ' => 'color: {{VALUE}} ',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'circle_info_description_typography',
                'selector' => '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item .bdt-circle-info-desc',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'circle_info_tab_description_hover',
            [
                'label' => __('Hover  ', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'circle_info_description_color_hover',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item .bdt-circle-info-desc:hover ' => 'color: {{VALUE}} ',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'circle_info_content_style',
            [
                'label' => __('Content', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_mode_content_style');

        $this->start_controls_tab(
            'circle_info_tab_content_normal',
            [
                'label' => __('Normal  ', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'circle_info_content_background_normal',
            [
                'label'     => __('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'circle_info_content_padding_normal',
            [
                'label'     => __('Padding', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'circle_item_border',
                'label'    => esc_html__('Border', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item',
            ]
        );

        $this->add_responsive_control(
            'circle_item_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'circle_info_tab_content_hover',
            [
                'label' => __('Hover  ', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'circle_info_content_background_hover',
            [
                'label'     => __('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'circle_item_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'circle_item_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

	    $this->start_controls_section(
		    'circle_info_additional_style',
		    [
			    'label' => __('Additional', 'bdthemes-element-pack'),
			    'tab'   => Controls_Manager::TAB_STYLE,
		    ]
	    );


	    $this->start_controls_tabs('circle_info_border_style');

	    $this->start_controls_tab(
		    'circle_info_border_style_1',
		    [
			    'label' => __('Border 1', 'bdthemes-element-pack'),
		    ]
	    );

	    $this->add_control(
		    'circle_info_border_style1',
		    [
			    'label'   => esc_html__( 'Border Style', 'bdthemes-element-pack' ),
			    'type'    => Controls_Manager::SELECT,
			    'options' => [
				    'none'  => esc_html__( 'None', 'bdthemes-element-pack' ),
				    'solid'  => esc_html__( 'Solid', 'bdthemes-element-pack' ),
				    'dotted' => esc_html__( 'Dotted', 'bdthemes-element-pack' ),
				    'dashed' => esc_html__( 'Dashed', 'bdthemes-element-pack' ),
				    'double' => esc_html__( 'Double', 'bdthemes-element-pack' ),
				    'groove' => esc_html__( 'Groove', 'bdthemes-element-pack' ),
			    ],
			    'default' => 'solid',
			    'selectors' => [
				    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-inner:before' => 'border-style: {{VALUE}} ',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'circle_info_border_width1',
		    [
			    'label'     => __('Border Width', 'bdthemes-element-pack'),
			    'type'      => Controls_Manager::DIMENSIONS,
			    'selectors' => [
				    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-inner:before' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			    ],
		    ]
	    );


	    $this->add_control(
		    'circle_info_border_color1',
		    [
			    'label'     => __('Border Color', 'bdthemes-element-pack'),
			    'type'      => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-inner:before' => 'border-color: {{VALUE}} ',
			    ],
		    ]
	    );


	    $this->end_controls_tab();


	    $this->start_controls_tab(
		    'circle_info_border_style_2',
		    [
			    'label' => __('Border 2', 'bdthemes-element-pack'),
		    ]
	    );

	    $this->add_control(
		    'circle_info_border_style2',
		    [
			    'label'   => esc_html__( 'Border Style', 'bdthemes-element-pack' ),
			    'type'    => Controls_Manager::SELECT,
			    'options' => [
				    'none'  => esc_html__( 'None', 'bdthemes-element-pack' ),
				    'solid'  => esc_html__( 'Solid', 'bdthemes-element-pack' ),
				    'dotted' => esc_html__( 'Dotted', 'bdthemes-element-pack' ),
				    'dashed' => esc_html__( 'Dashed', 'bdthemes-element-pack' ),
				    'double' => esc_html__( 'Double', 'bdthemes-element-pack' ),
				    'groove' => esc_html__( 'Groove', 'bdthemes-element-pack' ),
			    ],
			    'default' => 'solid',
			    'selectors' => [
				    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-inner:after' => 'border-style: {{VALUE}} ',
			    ],
		    ]
	    );

	    $this->add_responsive_control(
		    'circle_info_border_width2',
		    [
			    'label'     => __('Border Width', 'bdthemes-element-pack'),
			    'type'      => Controls_Manager::DIMENSIONS,
			    'selectors' => [
				    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-inner:after' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
			    ],
		    ]
	    );


	    $this->add_control(
		    'circle_info_border_color2',
		    [
			    'label'     => __('Border Color', 'bdthemes-element-pack'),
			    'type'      => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .bdt-circle-info .bdt-circle-info-inner:after' => 'border-color: {{VALUE}} ',
			    ],
		    ]
	    );


	    $this->end_controls_tab();

	    $this->end_controls_tabs();



	    $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if ($settings['circle_info_auto_mode'] == 'yes') {
            $autoMode = 'true';
            if ($settings['circle_info_auto_time']['size']) {
                $autoModeTime = $settings['circle_info_auto_time']['size'];
            } else {
                $autoModeTime = '0';
            }
        } else {
            $autoMode     = 'false';
            $autoModeTime = '0';
        }

        if ($settings['circle_info_event']) {
            $circleInfoEvent = $settings['circle_info_event'];
        } else {
	        $circleInfoEvent = false;
        }

        $this->add_render_attribute(
            [
                'circle_info' => [
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            "id"           => 'bdt-circle-info-' . $this->get_id(),
                            "circleMoving" => $autoMode,
                            "movingTime"   => $autoModeTime,
                            "mouseEvent"   => $circleInfoEvent,
                        ])),
                    ],
                ],
            ]
        );

        ?>

        <div class="bdt-circle-info" <?php echo $this->get_render_attribute_string('circle_info'); ?>>
            <div class="bdt-circle-info-wrapper" id="<?php echo 'bdt-circle-info-' . $this->get_id(); ?>">

                <div class="bdt-circle-info-inner">
                    <?php
                    $i = 1;
                    foreach ($settings['circle_info_icon_list'] as $index => $item):

                        $this->add_render_attribute('sub_circle', 'class', 'bdt-info-sub-circle', true);
                        if ($i == 1) {
                            $this->add_render_attribute('sub_circle', 'class', 'active');
                        }
                        $this->add_render_attribute('sub_circle', 'data-circle-index', $i++, true);
                        ?>

                        <div <?php echo $this->get_render_attribute_string('sub_circle'); ?>>
                            <?php if (!empty($item['circle_info_item_icon']['value'])): ?>

                                <?php Icons_Manager::render_icon($item['circle_info_item_icon'], ['aria-hidden' => 'true']); ?>
                            <?php endif;?>
                        </div>
                    <?php endforeach;?>
                </div>

                <div class="bdt-circle-info-content-wrapper">
                    <?php
                    $i = 1;
                    foreach ($settings['circle_info_icon_list'] as $index => $item):
                        
                        $this->add_render_attribute('circle_content', 'class', 'bdt-circle-info-item icci'. $i++, true); 
                        if ($i == 2) {
                            $this->add_render_attribute('circle_content', 'class', 'active');
                        }
                        $this->add_render_attribute('circle_title_tags', 'class', 'bdt-circle-info-title');

                        ?>

                        <div <?php echo $this->get_render_attribute_string('circle_content'); ?>>

                            <?php if (!empty($item['circle_info_item_icon']['value'])): ?>
                                <div class="bdt-circle-info-icon d-md-none">
                                    <?php Icons_Manager::render_icon($item['circle_info_item_icon'], ['aria-hidden' => 'true']);?>
                                </div>
                            <?php endif;?>

                            <?php
                            $link_key = 'link_' . $index;
                            if (!empty($item['circle_info_title_link']['url'])) {

                                $this->add_render_attribute($link_key, 'href', $item['circle_info_title_link']['url']);

                                if ($item['circle_info_title_link']['is_external']) {
                                    $this->add_render_attribute($link_key, 'target', '_blank');
                                }

                                if ($item['circle_info_title_link']['nofollow']) {
                                    $this->add_render_attribute($link_key, 'rel', 'nofollow');
                                }
                            } else {
                                $this->add_render_attribute($link_key, 'href', '#');
                            }
                            ?>

                            <div class="bdt-circle-info-content-inner">
                                <div>
                                    <a <?php echo $this->get_render_attribute_string($link_key); ?> >
                                        <<?php echo esc_html($settings['title_tags']); ?> <?php echo $this->get_render_attribute_string('circle_title_tags'); ?>>
                                            <?php echo $item['circle_info_item_title']; ?>
                                        </<?php echo esc_html($settings['title_tags']); ?>>
                                    </a>
                                </div>

                                <div class="bdt-circle-info-desc">
                                    <?php echo $item['circle_info_item_details']; ?>
                                </div>
                            </div>

                        </div>

                    <?php endforeach;?>

                </div>

            </div>
        </div>

        <?php
    }
}
