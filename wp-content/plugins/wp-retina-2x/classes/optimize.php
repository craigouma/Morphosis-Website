<?php
require_once(WR2X_PATH . '/vendor/autoload.php');

use Psr\Log\LoggerInterface;

class Meow_Logger implements LoggerInterface
{

  public $errors = [];

  public function reset() {
    $this->errors = [];
  }

  public function log($level, $message, array $context = []): void
  {
    if ( is_array( $message ) ) {
      $exception = $message['exception'];
      $this->errors[] = $exception->getMessage();
    }
    else {
      $this->errors[] = $message;
    }
  }

  public function critical($message, array $context = []): void
  {
    $this->log( $message, $context );
  }

  public function error($message, array $context = []): void
  {
    $this->log( $message, $context );
  }

  public function emergency($message, array $context = []): void
  {
    $this->log( $message, $context );
  }

  public function alert($message, array $context = []): void
  {
    $this->log( $message, $context );
  }

  public function warning($message, array $context = []): void
  {
    $this->log( $message, $context );
  }

  public function notice($message, array $context = []): void
  {
    $this->log( $message, $context );
  }

  public function info($message, array $context = []): void
  {
    $this->log( $message, $context );
  }

  public function debug($message, array $context = []): void
  {
    $this->log( $message, $context );
  }
}

class Meow_WR2X_Optimize
{

  private $core;
  private $optimizer;
  private $postmeta_key = '_wr2x_optimize';

  public function __construct($core)
  {
    $this->core = $core;
    $this->logger = new Meow_Logger();
    $factory = new \ImageOptimizer\OptimizerFactory([], $this->logger);
    $this->optimizer = $factory->get();
  }

  public function optimize_image($media_id)
  {
    $meta = wp_get_attachment_metadata($media_id);
    if (!isset($meta['file'])) return;

    $uploads = wp_upload_dir();
    if ($retina = $this->core->get_retina($uploads['basedir'] . '/' . $meta['file'])) {
      $meta['retina_file'] = substr($retina, strlen($uploads['basedir']) + 1);
    }

    $pathinfo = pathinfo($meta['file']);
    $basepath = trailingslashit($uploads['basedir']) . $pathinfo['dirname'];

    // Main
    $normal_file = trailingslashit($basepath) . $pathinfo['basename'];
    $optimized_result = $this->optimize($normal_file);

    if (!$optimized_result) {
      delete_post_meta($media_id, $this->postmeta_key);
      return;
    }
    update_post_meta($media_id, $this->postmeta_key, $optimized_result);

    if (isset($meta['retina_file'])) {
      $pathinfo = pathinfo($meta['retina_file']);
      $retina_file = trailingslashit($basepath) . $pathinfo['basename'];
      $retina_optimized_result = $this->optimize($retina_file);
    }

    // Thumbnails
    $sizes = $this->core->get_image_sizes();
    foreach ($sizes as $name => $attr) {
      $normal_file = "";
      $pathinfo = null;
      $retina_file = null;

      if (!isset($meta['sizes'][$name]) || !isset($meta['sizes'][$name]['file'])) {
        continue;
      }

      $normal_file = trailingslashit($basepath) . $meta['sizes'][$name]['file'];
      $pathinfo = pathinfo($normal_file);
      $retina_file = trailingslashit($pathinfo['dirname']) . $pathinfo['filename'] . $this->core->retina_extension() . $pathinfo['extension'];
      $normal_file_optimized_result = $this->optimize($normal_file);
      $retina_file_optimized_result = $this->optimize($retina_file);
    }

    // Update optimize issue status
    $this->core->update_optimise_issue_status( $media_id );
  }

  /**
   * Optimize the image and return the sizes before and after.
   * If the image does not exist, return false.
   *
   * @param string $filepath
   * @return array
   */
  private function optimize($filepath)
  {


    // $lines = [];
    // $output = exec( 'whereis ls', $lines );
    // $output = exec( 'whereis jpegtran', $lines );
    // $output = exec( 'jpegtran -v -h', $lines );

    if (!file_exists($filepath)) {
      return false;
    }
    try {
      $before_filesize = filesize($filepath);
      $this->optimizer->optimize( $filepath );
      if ( !empty( $this->logger->errors ) ) {
        $this->logger->reset();
        return false;
      }
      $after_filesize = filesize($filepath);
      return ['before' => $before_filesize, 'after' => $after_filesize];
    }
    catch (Exception $e) {
      return false;
    }
  }
}
