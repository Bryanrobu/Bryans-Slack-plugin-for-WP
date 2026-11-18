<?php
/**
 * Plugin Name: Bryans-plugin
 * Description: Slack plugin
 * Author: Bryan
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'admin_menu', 'bsn_voeg_menu_toe' );

function bsn_voeg_menu_toe() {
    add_options_page(
        'Slack Notifier instellingen', // titel van de pagina
        'Slack Notifier',              // tekst in het menu
        'manage_options',              // alleen beheerders mogen erbij
        'bsn-instellingen',            // slug, komt in de URL
        'bsn_toon_pagina'              // functie die de HTML maakt
    );
}