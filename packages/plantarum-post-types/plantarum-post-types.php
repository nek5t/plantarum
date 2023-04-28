<?php
/**
 * Plugin Name: Plantarum Post Types
 * Description: Register custom content types and taxonomies for Plantarum.
 * Version: 1.0.0
 * Author: Eric Phillips
 * Text Domain: plantarum
 *
 * @package plantarum/plantarum-post-types
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once 'post-types/plantarum_plant.php';
require_once 'taxonomies/plantarum_family.php';