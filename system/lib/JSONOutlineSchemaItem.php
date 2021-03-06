<?php
/**
 * JSONOutlineSchemaItem - a single item without an outline of items.
 */

class JSONOutlineSchemaItem {
  public $id;
  public $indent;
  public $location;
  public $order;
  public $parent;
  public $title;
  public $metadata;
  /**
   * Establish defaults for a new item
   */
  public function __construct() {
    $this->id = 'item-' . $this->generateUUID();
    $this->indent = 0;
    $this->location = NULL;
    $this->order = 0;
    $this->parent = NULL;
    $this->title = 'New item';
    $this->metadata = new stdClass();
  }
  /**
   * Load data from the location specified
   */
  public function readLocation() {
    if (file_exists($this->location)) {
      return file_get_contents($this->location);
    }
    return FALSE;
  }
  /**
   * Load data from the location specified
   */
  public function writeLocation($body) {
    if (file_exists($this->location)) {
      return file_put_contents($this->location, $body);
    }
    return FALSE;
  }
  /**
   * Generate a UUID
   */
  private function generateUUID() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),
        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,
        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,
        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
  }
}