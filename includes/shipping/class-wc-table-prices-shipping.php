<?php
/**
 *   Plugin Name: TP Method
 *   Plugin URI: 
 *   Description: Method based on shipping table prices
 *   Version: 1.0.0
 *   Author: giovane
 *   Author URI: 
 *
 * @package  WooCommerce_STable_Prices/includes/shipping
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WC_Table_Prices_Shipping' ) ) {
    class WC_Table_Prices_Shipping extends WC_Shipping_Method {
        /**
         * Constructor for your shipping class
         *
         * @access public
         * @return void
         */
        public function __construct() {
            $this->id                 = 'tp_method';
            $this->title       = __( 'TP Method', 'woocommerce-table-prices' );
            $this->method_title       = __( 'TP Method', 'woocommerce-table-prices' );
            $this->method_description = __( 'Method based on shipping table prices', 'woocommerce-table-prices'); // 
            $this->enabled            = "yes"; // This can be added as an setting but for this example its forced enabled
            $this->supports           = array(
                'shipping-zones',
                'instance-settings',
            );

            $this->init();
        }

        /**
         * Init your settings
         *
         * @access public
         * @return void
         */
        function init() {
            // Load the settings API
            $this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
            $this->init_settings(); // This is part of the settings API. Loads settings you previously init.

            // $this->enabled            = $this->get_option( 'enabled' );
            // $this->title              = $this->get_option( 'title' );
            // $this->origin_postcode    = $this->get_option( 'origin_postcode' );
            // $this->shipping_class_id  = (int) $this->get_option( 'shipping_class_id', '-1' );
            // $this->show_delivery_time = $this->get_option( 'show_delivery_time' );
            // $this->additional_time    = $this->get_option( 'additional_time' );
            // $this->fee                = $this->get_option( 'fee' );
            // $this->receipt_notice     = $this->get_option( 'receipt_notice' );
            // $this->own_hands          = $this->get_option( 'own_hands' );
            // $this->declare_value      = $this->get_option( 'declare_value' );
            // $this->custom_code        = $this->get_option( 'custom_code' );
            // $this->service_type       = $this->get_option( 'service_type' );
            // $this->login              = $this->get_option( 'login' );
            // $this->password           = $this->get_option( 'password' );
            // $this->minimum_height     = $this->get_option( 'minimum_height' );
            // $this->minimum_width      = $this->get_option( 'minimum_width' );
            // $this->minimum_length     = $this->get_option( 'minimum_length' );
            // $this->debug              = $this->get_option( 'debug' );

            // Save settings in admin if you have any defined
            add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options') );
        }

        public function init_form_fields() {
            $this->instance_form_fields = array(
                'enabled' => array(
                    'title'   => __( 'Enable/Disable', 'woocommerce-correios' ),
                    'type'    => 'checkbox',
                    'label'   => __( 'Enable this shipping method', 'woocommerce-correios' ),
                    'default' => 'yes',
                ),
                'title' => array(
                    'title'       => __( 'Title', 'woocommerce-correios' ),
                    'type'        => 'text',
                    'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce-correios' ),
                    'desc_tip'    => true,
                    'default'     => $this->method_title,
                )
            );
        }

        /**
         * calculate_shipping function.
         *
         * @access public
         * @param mixed $package
         * @return void
         */
        public function calculate_shipping( $package ) {
            // This is where you'll add your rates
            $rate = array(
                'id' => $this->id,
                'label' => $this->title,
                'cost' => '10.99',
                'calc_tax' => 'per_order'
            );

            // Register the rate
            $this->add_rate( $rate );
        }
    }
}