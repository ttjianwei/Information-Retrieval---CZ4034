<?php

class Spell {
	private $words, $unique, $counts = array();

	public function __construct() {
		$this->words = $this->words(strtolower(file_get_contents('big.txt')));
		$this->unique = array_flip($this->words);
		for($i = 0, $max = count($this->words); $i < $max; ++$i) {
			!empty($this->counts[$this->words[$i]]) ? ++$this->counts[$this->words[$i]] : $this->counts[$this->words[$i]] = 1;
		}
	}

	public static function create() {
		return new self;
	}

	public function check($word) {
		return $this->correction($word);
	}

	// The subset of words that appear in the dictionary of words
	private function known($words) {
		$return = array();
		foreach ($words as $word) {
			if (isset($this->unique[$word])) {
				$return[] = $word;
			}
		}
		return $return;
	}

	// Get words from string of text
	private function words($text) {
		$matches = array();
		preg_match_all('/\w+/', strtolower($text), $matches);
		return array_shift($matches);
	}

	// Probably of word
	private function probability($word) {
		return !empty($this->counts[$word]) ? $this->counts[$word] / array_sum($this->counts) : 0;
	}

	// Find the word with the highest probability
	private function findBest($words) {
		$p = array();
		foreach ($words as $word) {
			$p[$word] = $this->probability($word);
		}
		asort($p);
		return array_slice($p, count($p) - 1, 1);
	}

	// All edits that are one edit away from word
	private function edits1($word) {
		$letters = str_split('abcdefghijklmnopqrstuvwxyz');

		$splits = array();
		for ($i = 0, $max = strlen($word); $i < $max; ++$i) {
			$len = strlen($word);
			$splits[] = array(substr($word, 0, $i), substr($word, -1 * ($len - $i), $len - $i));
		}

		$deletes = array();
		$transposes = array();
		$replaces = array();
		$inserts = array();
		foreach ($splits as $split) {
			if ($split[1]) {
				$deletes[] = $split[0] . substr($split[1], 1);
			}
			if (strlen($split[1]) > 1) {
				$transposes[] = $split[0] . $split[1][1] . $split[1][0] . substr($split[1], 2);
			}
			if ($split[1]) {
				foreach ($letters as $letter) {
					$replaces[] = $split[0] . $letter . substr($split[1], 1);
				}
			}
			foreach ($letters as $letter) {
				$inserts[] = $split[0] . $letter . $split[1];
			}
		}

		return array_merge($deletes, $transposes, $replaces, $inserts);
	}

	// All edits that are two edits away from word
	private function edits2($word) {
		$words = array();

		$e1s = $this->edits1($word);

		foreach ($e1s as $e1) {
			$e2s = $this->edits1($e1);
			foreach ($e2s as $e2) {
				$words[] = $e2;
			}
		}
		return array_keys(array_flip($words));
	}

	// Most probably spelling correct for word
	private function correction($word) {
		$c = $this->candidates($word);
		$best = $this->findBest($c);
		return array_shift(array_keys($best));
	}

	// Generate possible spelling corrections for word
	private function candidates($word) {
		$known = $this->known(array($word));
		$edits1 = $this->known($this->edits1($word));
		$edits2 = $this->known($this->edits2($word));

		return $known ? $known : ($edits1 ? $edits1 : ($edits2 ? $edits2 : array($word)));
	}
}