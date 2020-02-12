<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;


class ReportTrafficPDFExport implements FromCollection
{
    use Exportable;
    public $startDate;
    public $endDate;

    public function __construct($request)
    {
        $this->code = $request->code;
        $this->group_id = $request->groupId;
        $this->type_filter = $request->type_filter;
        $this->commonrange_id = $request->commonrangeId;
        $this->gender_id = $request->genderId;
        $this->gatedevice_id = $request->deviceId;
        $this->gatemessage_id = $request->messageId;
        $this->gatedirect_id = $request->directId;
        $this->startDate = $request->beginDateTime;
        $this->endDate = $request->endDateTime;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       $this->createPDF();
    }

    /**
     * create pdf
     */
    public function createPDF()
    {
        $image_logo = public_path() . DIRECTORY_SEPARATOR . 'images' .
                                DIRECTORY_SEPARATOR . 'logo.jpg';

        define ('PDF_HEADER_STRING', "گزارشات ورود و خروج \n دانشگاه فرهنگیان ");
        define ('PDF_HEADER_TITLE', "گزارش تردد های کاربران ");
        define ('PDF_FONT_NAME_MAIN', 'dejavusans');
        define ('PDF_FONT_SIZE_MAIN', 10);

        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // $pdf->SetFont('dejavusans', 'B', 12);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('IPASS');
        $pdf->SetTitle('گزارشات تردد');
        $pdf->SetHeaderData(PDF_HEADER_LOGO,
                            PDF_HEADER_LOGO_WIDTH,
                            PDF_HEADER_TITLE.' 001',
                            PDF_HEADER_STRING,
                            array(0,64,255),
                            array(0,64,128));

        // Title
        $pdf->Cell(0, 15, 'گزارشات ورود و خروج', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        $pdf->Cell(30, 0, 'Descent-Center', 1, $ln=0, 'C', 0, '', 0, false, 'D', 'C');
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        // $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
       $pdf->setHeaderFont( Array('dejavusans', '', 8));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 8, '', true);
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
        $pdf->setLanguageArray($lg);
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        // column titles
        $header = array('کد کاربری', 'نام', 'نام خانوادگی', 'تاریخ تردد', 'پیام', 'مسیر تردد');
        $traffic = $this->reportGateTraffic();
        // print colored table
        $this->ColoredTableExport($pdf, $header, $traffic);
        // close and output PDF document
        $pdf->Output('report.pdf', 'I');
    }
     // Colored table
    public function ColoredTableExport($pdf, $header,$data) {
        // Colors, line width and bold font
        $pdf->SetFillColor(230, 177, 172);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(255, 243, 242);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('dejavusans', 'B');
        // Header
        $w = array(30, 30, 35, 40, 30, 20);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $pdf->Cell($w[$i], 6, $header[$i], 1, 0, 'C', 1);
        }
        $pdf->Ln();
        // Color and font restoration
        $pdf->SetFillColor(255, 243, 242);
        $pdf->SetTextColor(0);
        $pdf->SetFont('dejavusans');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $pdf->Cell($w[0], 6, $row->code, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[1], 6, $row->name, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[2], 6, $row->lastname, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[3], 6, miladiToPersianDateTime($row->gatedate), 'LR', 0, 'C', $fill);
            $pdf->Cell($w[4], 6, $row->message, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[5], 6, $row->direct, 'LR', 0, 'C', $fill);
            $pdf->Ln();
            $fill=!$fill;
        }
        $pdf->Cell(array_sum($w), 0, '', 'T');
    }

    public function reportGateTraffic()
    {
        $dateRange = [
                        $this->startDate,
                        $this->endDate
                    ];

        $fields = [
            'gatetraffics.gatedate',
            'gatemessages.message',
            'gatedirects.name as direct',
            'genders.gender as gender',
            'users.code',
            'people.name as name',
            'people.lastname as lastname',
            'people.nationalId'
        ];


        $res = \App\Gatetraffic::whereBetween('gatedate',$dateRange);
        $res = $res->join ('users', 'gatetraffics.user_id', 'users.id')
                   ->join ('people', 'people.id', 'users.people_id')
                   ->join ('genders', 'genders.id', 'people.gender_id')
                   ->join ('groups', 'groups.id', 'users.group_id')
                   ->join('gatedevices', 'gatedevices.id', 'gatetraffics.gatedevice_id')
                   ->join('gatepasses', 'gatepasses.id', 'gatetraffics.gatepass_id')
                   ->join('gatedirects', 'gatedirects.id', 'gatetraffics.gatedirect_id')
                   ->join('gatemessages', 'gatemessages.id', 'gatetraffics.gatemessage_id');


        if (! is_null($this->group_id) && ($this->group_id > 0)){
            $res = $res->where('users.group_id', $this->group_id);
        }

        if (! is_null($this->code)){
            $res = $res->where('users.code','like', "%$this->code%");
        }

        if (!is_null ($this->gatemessage_id)) {
            $res = $res->Where ('gatemessages.id', '=', $this->gatemesage_id);
        }

        if (!is_null ($this->gatedevice_id)) {
            $res = $res->Where ('gatedevices.id', '=', $this->gatedevice_id);
        }

        if (!is_null ($this->gatedirect_id)) {
            $res = $res->Where ('gatedirects.id', '=', $this->gatedirect_id);
        }

        if (!is_null ($this->gender_id)) {
            $res = $res->Where ('genders.id', '=', $this->gender_id);
        }
        $res = $res->select ($fields)
                   ->get();

        // $res = $res->map (function ($item) {
        //     return [
        //         $item['code'],
        //         $item['name'],
        //         $item['lastname'],
        //         $item['nationalId'],
        //         $item['gender'],
        //         $item['gatedate'],
        //         $item['message'],
        //         $item['direct']
        //     ];
        // });

      return $res;
    }
}

/**
 * Dont use class
 */
  class MYPDF extends TCPDF {

        //Page header
        public function Header() {
            // Logo
            $image_file = K_PATH_IMAGES.'logo_example.jpg';
            $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            // Set font
            $this->SetFont('helvetica', 'B', 20);
            // Title
            $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        }

        // Page footer
        public function Footer() {
            // Position at 15 mm from bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont('helvetica', 'I', 8);
            // Page number
            $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }

