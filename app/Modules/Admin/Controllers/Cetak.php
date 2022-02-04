<?php 
    namespace App\Modules\Admin\Controllers;

    use App\Controllers\BaseController;
    use App\Modules\Admin\Models\NovelModel;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpWord\IOFactory; 
    use PhpOffice\PhpWord\PhpWord;
    use PhpOffice\PhpWord\Writer\Word2007;
    use FPDF;
    use CodeIgniter\Model;

    class Cetak extends BaseController{

        public function __construct(){
            $this -> model = new NovelModel();
        }
        
        public function pdf(){

            error_reporting(0);

            $pdf = new FPDF('l','mm', 'legal');
            $pdf -> AddPage('l' , 'legal' );
            $pdf -> SetFont('Arial','B',16);
            $pdf -> Cell(100, 7 , 'DATA Novel ' , 0 ,1 ,'C');
            $pdf -> Cell(10, 7 , '' , 0 ,1);
            $pdf -> SetFont('Arial', 'B', 10);
            $pdf -> Cell (40, 6, 'NO. ' , 1, 0);
            $pdf -> Cell (30, 6, 'SAMPUL ' , 1, 0);
            $pdf -> Cell (40, 6, 'NAMA BUKU ' , 1, 0);
            $pdf -> Cell (30, 6, 'NAMA PENULIS ' , 1, 1);
            $pdf -> SetFont( 'Arial','', 10);

            $data = $this->model->getNovel();

            $i=1;
            foreach ($data as $item) {
                $pdf -> Cell(40, 20, $i++, 1, 0);
                $img = base_url('img/' . $item['sampul']);
                $pdf -> Cell(30, 20, $pdf->Image($img, $pdf->GetX(), $pdf->GetY(), 17),1,0);
                $pdf -> Cell(40, 20, $item['judul'], 1, 0);
                $pdf -> Cell(30, 20, $item['penulis'], 1, 1);
            };
            $pdf->Output('D', 'Data_Novel.pdf');
        }

        public function word(){
            $word = new PhpWord();
            $sect = $word->addSection();
            $title = array('size'=> 16, 'bold'=>true);
            $sect->addText("Data Novel", $title);
            $sect->addTextBreak(1);
            $styleTable = array('borderSize'=>6,'borderColor'=>'006699','cellMargin'=>80);

            $styleCell = array('valign'=>'center');
            $fontHeader = array('bold'=>true);
            $noSpace = array('spaceAfter'=>0);
            $imgStyle = array('width'=>50,'height'=>50);
            $word->addTableStyle('mytable',$styleTable);
            $table = $sect->addTable('mytable');
            $table->addRow();
            $table->addCell(500, $styleCell)->addText('NO.', $fontHeader, $noSpace);
            $table->addCell(2000, $styleCell)->addText('SAMPUL', $fontHeader, $noSpace);
            $table->addCell(2000, $styleCell)->addText('NAMA BUKU', $fontHeader, $noSpace);
            $table->addCell(2000, $styleCell)->addText('NAMA PENULIS', $fontHeader, $noSpace);

            $data = $this->model->getNovel();

            $i=1;
            foreach ($data as $item) {
                $table->addRow();
                $table->addCell(2000, $styleCell)->addText($i++, array(), $noSpace);
                $table->addCell(1000, $styleCell)->addImage('img/'. $item['sampul'],$imgStyle);
                $table->addCell(2000, $styleCell)->addText($item['judul'], array(), $noSpace);
                $table->addCell(2000, $styleCell)->addText($item['penulis'], array(), $noSpace);
            }

            $writer = new Word2007($word);
            $filename = "data_novel.docx";
            header('Content-Type: application/msword');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            $writer->save('php://output');
        }

        public function excel(){
            $spreadsheet = new Spreadsheet();
            $spreadsheet-> setActiveSheetIndex(0)->setCellValue('A1','DATA NOVEL');
            $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(13);
            $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
            $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()
                        ->setCellValue('A3', 'NO.')
                        ->setCellValue('B3', 'SAMPUL')
                        ->setCellValue('C3', 'NAMA BUKU')
                        ->setCellValue('D3', 'NAMA PENULIS');
            $spreadsheet->getActiveSheet()->getStyle('A1:H3')->getFont()->setBold(true);

            $data = $this->model->getNovel();

            $i=1;
            $rowID = 4;
            foreach ($data as $item) {
                $spreadsheet->getActiveSheet()
                            ->setCellValue('A'.$rowID, $i++)
                            ->setCellValue('C'.$rowID, $item['judul'])
                            ->setCellValue('D'.$rowID, $item['penulis']);

                $foto = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $foto->setPath('img/'.$item['sampul']);
                $foto->setCoordinates('B'.$rowID);
                $foto->setOffsetX(5);
                $foto->setOffsetY(5);
                $foto->setWidth(100);
                $foto->setHeight(50);
                $foto->setWorksheet($spreadsheet->getActiveSheet());
                $spreadsheet->getActiveSheet()->getRowDimension($rowID)->setRowHeight(50);
                $rowID++;
            }

            $writer = new Xlsx($spreadsheet);

            $filename = 'Data_Novel';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');

            $writer->save('php://output');
        }
    }
?>