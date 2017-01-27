<?php
/**
 * Integration Demo Integration.
 *
 *
 * @package  WooCommerce_Table_Prices/includes/integrations
 * @category Integration
 * @author   Giovane
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
};

if ( ! class_exists( 'WC_Table_Prices_Integration' ) ) :
class WC_Table_Prices_Integration extends WC_Integration {
    /**
     * Init and hook in the integration.
     */
    public function __construct() {
        global $woocommerce;
        $this->id                 = 'table-prices';
        $this->method_title       = __( 'Table Prices', 'woocommerce-table-prices' );
        $this->method_description = __( 'Table Prices Integration.', 'woocommerce-table-prices' );
        // Load the settings.
        $this->init_form_fields();
        $this->init_settings();
        // Define user set variables.
        $this->api_key          = $this->get_option( 'api_key' );
        $this->debug            = $this->get_option( 'debug' );
        // Actions.
        add_action( 'woocommerce_update_options_integration_' .  $this->id, array( $this, 'process_admin_options' ) );
    }
    /**
     * Initialize integration settings form fields.
     */
    public function init_form_fields() {
        $this->form_fields = array(
            'api_key' => array(
                'title'             => __( 'API Key', 'woocommerce-table-prices' ),
                'type'              => 'text',
                'description'       => __( 'Enter with your API Key. You can find this in "User Profile" drop-down (top right corner) > API Keys.', 'woocommerce-table-prices' ),
                'desc_tip'          => true,
                'default'           => ''
            ),
            'debug' => array(
                'title'             => __( 'Debug Log', 'woocommerce-table-prices' ),
                'type'              => 'checkbox',
                'label'             => __( 'Enable logging', 'woocommerce-table-prices' ),
                'default'           => 'no',
                'description'       => __( 'Log events such as API requests', 'woocommerce-table-prices' ),
            ),
        );
    }
}
endif;