<?php
/**
 * Plugin Name: Slack-plugin
 * Description: Slack plugin
 * Author: Bryan
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'admin_menu', 'bsn_voeg_menu_toe' );

function bsn_voeg_menu_toe() {
    add_menu_page(
        'Slack Notifier instellingen', // titel van de pagina
        'Slack Notifier',              // tekst in het menu
        'manage_options',              // alleen beheerders mogen erbij
        'bsn-instellingen',            // slug, komt in de URL
        'bsn_toon_pagina'              // functie die de HTML maakt
    );
}

add_action( 'admin_init', 'bsn_registreer_instellingen' );

function bsn_registreer_instellingen() {
    register_setting( 'bsn_groep', 'bsn_methode', array(
        'sanitize_callback' => 'sanitize_text_field',
    ) );
}

function bsn_toon_pagina() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    $methode = get_option( 'bsn_methode', 'webhook' );
    ?>
    <div class="wrap">
        <h1>Slack Notifier</h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'bsn_groep' ); ?>
            <table class="form-table">
                <tr>
                    <th>Verzendmethode</th>
                    <td>
                        <select name="bsn_methode">
                            <option value="webhook" <?php selected( $methode, 'webhook' ); ?>>Incoming Webhook</option>
                            <option value="api" <?php selected( $methode, 'api' ); ?>>Slack Web API</option>
                        </select>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}