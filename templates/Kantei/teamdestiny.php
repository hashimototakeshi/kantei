<?php

require_once dirname(__FILE__) . '/createUserDataPdf.php';
$baseFolder = dirname(__FILE__) . '/tmp';
$tmpFolder = '';
while (1) {
    $str = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $rand_str = substr(str_shuffle(str_repeat($str, 10)), 0, 8);
    $tmpFolder = $baseFolder . '/' . $rand_str;
    if (mkdir($tmpFolder, 0777)) {
        break;
    }
}
$kanteiPdf = new kanteiPdf();
$kanteiPdf->execute($outputData, $tmpFolder);

$zip = new ZipArchive();
$zipFileName = $baseFolder . '/file_kantei_' . date('Ymds') . '.zip';
//直接コマンドでやると便利
chdir($tmpFolder);
exec("zip -r {$zipFileName} .");

// 上記で作ったZIPをダウンロードします。
header('Content-Type: application/zip');
header('Content-Transfer-Encoding: Binary');
//header("Content-Length: ".filesize($zipTmpDir.$zipFileName));
header('Content-Disposition: attachment; filename="' . basename($zipFileName) . '"');
// ファイルを出力する前に、バッファの内容をクリア（ファイルの破損防止）
ob_end_clean();
readfile($zipFileName);
// Zipファイル削除
unlink($zipFileName);
exec("rm -rf {$tmpFolder}");
exit;
