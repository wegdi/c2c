<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
require_once(SECURITY.'Security.php');
$security->LoginControl($guvenlik);


class FolderControl
{

  public function FolderAdd($modalArray, $basePath)
  {
      if (!file_exists($basePath)) {
          mkdir($basePath, 0755, true);
      }

      foreach ($modalArray as $folderName => $subFolders) {
          $folderPath = $basePath . $folderName . '/';
          if (!file_exists($folderPath)) {
              mkdir($folderPath, 0755, true);
          }

          foreach ($subFolders as $subFolder) {
              $subFolderPath = $folderPath . $subFolder . '/';
              if (!file_exists($subFolderPath)) {
                  mkdir($subFolderPath, 0755, true);
              }

              $subFilePath = $subFolderPath . $subFolder . '.php';
              if (!file_exists($subFilePath)) {
                  // Dosya yoksa, içeriği oluşturup dosyayı oluşturun
                  $content = '<?php' . PHP_EOL .
                  'require_once($_SERVER[\'DOCUMENT_ROOT\'].\'/config.php\');' . PHP_EOL .
                  'require_once(SECURITY.\'Security.php\');' . PHP_EOL .
                  '$security->LoginControl($guvenlik);' . PHP_EOL .
                  '?>'. PHP_EOL;

                  file_put_contents($subFilePath, $content);
              }
          }
      }
  }

}
$FolderAdd = new FolderControl();




?>
