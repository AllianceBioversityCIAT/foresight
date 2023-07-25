<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package foresight
 */

$search_query = get_search_query();
wp_safe_redirect(home_url('/search/?'.ALGOLIA_INDEX.'[query]='.$search_query));
exit;