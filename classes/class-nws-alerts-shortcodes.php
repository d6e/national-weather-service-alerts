<?php
/**
* NWS_Alerts Shortcodes
*
* @since 1.0.0
*/

class NWS_Alerts_Shortcodes {
    /**
    *
    *
    * The NWS_Alerts_Plugin shortcode handler
    *
    * @param array $atts an array containing the attributes specified in the shortcode_handler
    *
    * @return string
    */
    public static function shortcode_handler($atts) {
        $atts = shortcode_atts(array(
            'zip' => false,
            'city' => false,
            'state' => false,
            'county' => false,
            'location_title' => false,
            'display' => NWS_ALERTS_DISPLAY_DEFAULT,
            'scope' => NWS_ALERTS_SCOPE_COUNTY,
            'limit' => 0
        ), $atts);

        $scope = $atts['scope'];
        if ($scope !== NWS_ALERTS_SCOPE_NATIONAL && $scope !== NWS_ALERTS_SCOPE_STATE && $scope !== NWS_ALERTS_SCOPE_COUNTY) {
            $scope = NWS_ALERTS_SCOPE_COUNTY;
        }

        $nws_alerts_data = new NWS_Alerts(array(
            'zip' => $atts['zip'],
            'city' => $atts['city'],
            'state' => $atts['state'],
            'county' => $atts['county'],
            'scope' => $scope,
            'limit' => $atts['limit']
        ));

        return $nws_alerts_data->get_output_html($atts['display'], array(), array('location_title' => $atts['location_title']));
    }
}
