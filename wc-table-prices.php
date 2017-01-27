<?php
/**
 * Plugin Name: Woo Table Prices
 * Plugin URI:  http://NotmadeYet
 * Description: Woo Table Prices imports and exports shipping table table prices. **In development** 
 * Version:     1.0
 * License:     GPLv2 or later
 * Author:      gmocellin
 * Author URI:  https://github.com/gmocellin
 *
 * WooCommerce Woo Table Prices is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * WooCommerce Woo Table Prices is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WooCommerce Woo Shipping Table Prices. If not, see
 * <https://www.gnu.org/licenses/gpl-2.0.txt>.
 *
 * @package WooCommerce_Table_Prices
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
};

/**
 * Check if WooCommerce is active
 **/

if ( ! class_exists( 'WC_Table_Prices' ) ) :

class WC_Table_Prices {
        
    /**
    * Construct the plugin.
    */
    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'init' ) );
    }
    /**
    * Initialize the plugin.
    */
    public function init() {
        // Checks if WooCommerce is installed.
        if ( class_exists( 'WC_Integration' ) ) {
            $this->includes();

            add_filter( 'woocommerce_integrations', array( $this, 'add_integration' ) );
            add_filter( 'woocommerce_shipping_methods', array( $this, 'add_shipping_method' ) );
        } else {
            // throw an admin error if you like
        }
    }

    private function includes() {
        include_once dirname( __FILE__ ) . '/includes/shipping/class-wc-table-prices-shipping.php';
        include_once dirname( __FILE__ ) . '/includes/integrations/class-wc-table-prices-integration.php';
    }

    /**
     * Add a new integration to WooCommerce.
     */
    public function add_integration( $integrations ) {
        $integrations[] = 'WC_Table_Prices_Integration';
        return $integrations;
    }

    public function add_shipping_method( $methods ) {
        $methods['stp_shipping'] = 'WC_Table_Prices_Shipping'; 
        return $methods;
    }
}

$WC_Table_Prices = new WC_Table_Prices( __FILE__ );
endif;

