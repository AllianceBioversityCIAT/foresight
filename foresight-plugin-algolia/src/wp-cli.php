<?php
/**
 * Add function to WP-CLI for post import for the first time
 */

if (!(defined('WP_CLI') && WP_CLI)) {
    return;
}

class Algolia_Command {
	
	public function reindex_post($args, $assoc_args) {
		global $algolia;
		$index = $algolia->initIndex('foresight_'.WP_ENV);
  
		$index->clearObjects()->wait();
  
		$paged = 1;
		$count = 0;
  
		do {
			$posts = new WP_Query([
				'post_type' => array('post', 'publication'),
				'post_status' => 'publish',
				'posts_per_page' => 100,
				'paged' => $paged,
			]);
  
			if (!$posts->have_posts()) {
				break;
			}
  
			$records = [];
  
			foreach ($posts->posts as $post) {
				if ($assoc_args['verbose']) {
					WP_CLI::line('Serializing ['.$post->post_title.']');
				}
				$record = (array) apply_filters('post_to_record', $post);
  
				if (!isset($record['objectID'])) {
					$record['objectID'] = implode('#', [$post->post_type, $post->ID]);
				}
  
				$records[] = $record;
				$count++;
			}
  
			if ($assoc_args['verbose']) {
				WP_CLI::line('Sending batch');
			}
  
			$index->saveObjects($records);
  
			$paged++;
  
		} while (true);
  
		WP_CLI::success("$count posts indexed in Algolia");
	}
  }
  

WP_CLI::add_command('algolia', 'Algolia_Command');