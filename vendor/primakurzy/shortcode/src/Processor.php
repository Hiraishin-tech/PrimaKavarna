<?php

namespace primakurzy\Shortcode;

class Processor
{
	static function process($shortcodesFolder, $text)
	{
		$handlers = new \Thunder\Shortcode\HandlerContainer\HandlerContainer();
		
		$handlers->add('raw', function(\Thunder\Shortcode\Shortcode\ShortcodeInterface $s) {
			return $s->getContent();
		});
		$events = new \Thunder\Shortcode\EventContainer\EventContainer();
		$events->addListener(\Thunder\Shortcode\Events::FILTER_SHORTCODES, new \Thunder\Shortcode\EventHandler\FilterRawEventHandler(['raw']));
		$processor = new \Thunder\Shortcode\Processor\Processor(new \Thunder\Shortcode\Parser\RegularParser(), $handlers);
		$processor = $processor->withEventContainer($events);
		
		foreach (scandir($shortcodesFolder) as $filename) {
			$matches = array();
			if (preg_match('/^(.+)\\.php$/', $filename, $matches)) {
				$shortcodeKey = $matches[1];
				$handlers->add($shortcodeKey, function(\Thunder\Shortcode\Shortcode\ShortcodeInterface $shortcode) use ($shortcodesFolder, $filename, $processor) {
					
					ob_start();
					require $shortcodesFolder.'/'.$filename;
					$output = ob_get_contents();
					ob_end_clean();
					return $output;
				});
			}
		}
		
		return $processor->process($text);
	}
}
