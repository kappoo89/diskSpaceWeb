<?php

/**
 * Disk Status Class
 *
 * http://pmav.eu/stuff/php-disk-status/
 *
 * v1.0 - 17/Oct/2008
 * v1.1 - 22/Ago/2009 (Exceptions added.)
 */

class DiskStatus {

  const RAW_OUTPUT = true;

  private $diskPath;

  function __construct($diskPath) {
    $this->diskPath = $diskPath;
  }

  public function totalSpace($rawOutput = false) {
    $diskTotalSpace = @disk_total_space($this->diskPath);

    if ($diskTotalSpace === FALSE) {
      throw new Exception('totalSpace(): Invalid disk path.');
    }

    return $rawOutput ? $diskTotalSpace : $this->addUnits($diskTotalSpace);
  }

  public function freeSpace($rawOutput = false) {
    $diskFreeSpace = @disk_free_space($this->diskPath);

    if ($diskFreeSpace === FALSE) {
      throw new Exception('freeSpace(): Invalid disk path.');
    }

    return $rawOutput ? $diskFreeSpace : $this->addUnits($diskFreeSpace);
  }

  public function usedSpace($rawOutput = false) {

    $diskTotalSpace = @disk_total_space($this->diskPath);
    if ($diskTotalSpace === FALSE) {
      throw new Exception('totalSpace(): Invalid disk path.');
    }

    $diskFreeSpace = @disk_free_space($this->diskPath);
    if ($diskFreeSpace === FALSE) {
      throw new Exception('freeSpace(): Invalid disk path.');
    }    

	$diskUsedSpace = $diskTotalSpace - $diskFreeSpace;
	
	return $rawOutput ? $diskUsedSpace : $this->addUnits($diskUsedSpace);

  }


  public function getfolderSize($path, $rawOutput = false) {
  	$size = $this->foldersize($path);

	return $rawOutput ? $size : $this->addUnits($size);

  }

  public function foldersize($path) {
  	$total_size = 0;
    $files = @scandir($path);
    $cleanPath = rtrim($path, '/'). '/';

    foreach($files as $t) {
        if ($t<>"." && $t<>"..") {
            $currentFile = $cleanPath . $t;
            if (is_dir($currentFile)) {
                $size = $this->foldersize($currentFile);
                $total_size += $size;
            }
            else {
                $size = filesize($currentFile);
                $total_size += $size;
            }
        }   
    }

    return $total_size;
  }

  private function addUnits($bytes) {
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB' );

    for($i = 0; $bytes >= 1024 && $i < count($units) - 1; $i++ ) {
      $bytes /= 1024;
    }

    return round($bytes, 1).' '.$units[$i];
  }

}

?>
      