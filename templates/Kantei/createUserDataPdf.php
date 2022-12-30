<?php
// 画像のオリジナル
// https://docs.google.com/presentation/d/1qIcq2F0ZHyUU-xejW-QRwMLmr5mVwLZwY1vHX2p3Eac/edit#slide=id.p

class kanteiPdf
{
    function execute($outputData, $tmpFolder)
    {
        foreach ($outputData as $key => $targetData) {
            $this->create($targetData, $tmpFolder);
        }
    }

    function create($targetData, $path)
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'utf-8');
        //小塚ゴシックMを使うには「kozgopromedium」
        //小塚明朝Rを使うには「kozminproregular」
        $pdf->SetFont('kozminproregular');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->SetTextColor(0, 0, 0);
        $pdf->setFontSize(11);
//発行日
        $pdf->SetXY(150, 10);
        self::writeCell($pdf, '発行日' . date('Y年m月d日'), 150, 11);

//タイトル
        $pdf->SetXY(0, 30);
        self::writeCell($pdf, $targetData[0] . ' ' . $targetData[1] . 'さんの鑑定です', 0, 14, 'C');

        $pdf->SetX(5, 150);
        self::writeCell($pdf, "【あなたの27宿は】\n", 0, 9);
        self::writeCell($pdf, $targetData['syukuName'] . ' (' . $targetData['syukuYomi'] . ')', 0, 12);
        self::writeCell($pdf, $targetData['syukuDescription'], 0, 9);

        self::writeCell($pdf, "\n\n【あなたの干支は】\n", 0, 9);
        self::writeCell($pdf, $targetData['jukkanName'] . ' (' . $targetData['jukkanYomi'] . ')', 0, 12);
        self::writeCell($pdf, $targetData['jukkanDescription'], 0, 9);

        self::writeCell($pdf, "\n\n【あなたの支配星（ゼロスター）は】\n", 0, 9);
        self::writeCell($pdf, $targetData['zeroName'], 0, 12);
        self::writeCell($pdf, $targetData['zeroDescription'], 0, 9);

        self::writeCell($pdf, "\n\n【あなたの運命周期は】\n", 0, 9);
        self::writeCell($pdf, $targetData['lifeStepName'], 0, 12);
        self::writeCell($pdf, $targetData['lifeStepDescription'], 0, 9);

        $pdf->Image(dirname(__FILE__) . '/12years.png', 15, 150, 180, null, 'png');

        $outputFileName = mb_convert_encoding($targetData[0] . $targetData[1] . 'の鑑定', 'SJIS-WIN', 'UTF-8');
        $outputFileName = $targetData[0] . $targetData[1] . 'の鑑定';
        $pdf->Output($path . '/' . $outputFileName . '.pdf', 'F');
    }

    /**
     * @param $pdf TCPDF Object
     * @param $text string
     * @param $x  int
     * @param $fontsize int
     * @param $align string default 'L'
     * @param $h int line height
     */
    function writeCell($pdf, $text, $x, $fontsize, $align = 'L', $h = 0)
    {
        $pdf->SetFont('kozminproregular', '', $fontsize);
        $pdf->SetX($x + 15);
        $pdf->MultiCell(180, $h, $text, 0, $align, false, 1, '', '', true, 1);
    }
}
