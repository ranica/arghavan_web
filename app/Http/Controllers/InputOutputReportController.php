<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputOutputReportController extends Controller
{
     //Page header
    public function Header($pdf) {
        // Logo
        $image_file = K_PATH_IMAGES.'logo_example.jpg';
        $pdf->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, 'R', false, false, 0, false, false, false);
       // $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, 'R', false, false, 0,     false, false, false);
        // Set font
        //$pdf->SetFont('dejavusans', 'B', 20);
        // Title
        //$pdf->Cell(0, 15, 'گزارشات ورود و خروج', 0, false, 'R', 0, '', 0, false, 'M', 'M');
        // Cell(30, 0, 'Descent-Center', 1, $ln=0, 'C', 0, '', 0, false, 'D', 'C');
    }

    // Page footer
    public function Footer($pdf) {
        // Position at 15 mm from bottom
        $pdf->SetY(-15);
        // Set font
        $pdf->SetFont('dejavusans', 'I', 8);
        // Page number
        $pdf->Cell(0, 10, 'Page '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
    // Colored table
    public function ColoredTable($pdf, $header,$data) {
        // Colors, line width and bold font
        $pdf->SetFillColor(230, 177, 172);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(255, 243, 242);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('dejavusans', 'B');
        // Header
        // $w = array(35, 35, 30, 20, 25, 20, 20);
        $w = array(20, 20, 25, 20, 30, 35, 35);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $pdf->Ln();
        // Color and font restoration
        $pdf->SetFillColor(255, 243, 242);
        $pdf->SetTextColor(0);
        $pdf->SetFont('dejavusans');
        // Data
        $fill = 0;
        foreach($data as $row) {
            $pdf->Cell($w[0], 6, $row->user->code, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[1], 6, $row->user->people->name, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[2], 6, $row->user->people->lastname, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[3], 6, $row->gatedirect->name, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[4], 6, $row->gatedevice->name, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[5], 6, $row->gatemessage->message, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[6], 6, miladiToPersianDateTime($row->gatedate), 'LR', 0, 'C', $fill);
            $pdf->Ln();
            $fill=!$fill;
        }
        $pdf->Cell(array_sum($w), 0, '', 'T');
    }
    /**
     * Download PDF
    */
    public function InputOutputPDF(Request $request)
    {
        if($request->ajax() || true)
        {
            $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetAuthor('riratech');
            $pdf->SetTitle('گزارش ترددها');
            $pdf->SetSubject('TCPDF Tutorial');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'گزارش'.' ورود و خروج', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // set some language dependent data:
            $lg = Array();
            $lg['a_meta_charset'] = 'UTF-8';
            $lg['a_meta_dir'] = 'rtl';
            $lg['a_meta_language'] = 'fa';
            $lg['w_page'] = 'page';

            // set some language-dependent strings (optional)
            $pdf->setLanguageArray($lg);

            // ---------------------------------------------------------

            // set font
            $pdf->SetFont('dejavusans', '', 8);


            // set default header data
            $pdf->setFooterData(array(0,64,0), array(0,64,128));

            // set LTR direction for english translation
            // $pdf->setRTL(false);

            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                require_once(dirname(__FILE__).'/lang/eng.php');
                $pdf->setLanguageArray($l);
            }

            // ---------------------------------------------------------

            // set default font subsetting mode
            $pdf->setFontSubsetting(true);

            // Add a page
            // This method has several options, check the source code documentation for more information.
            $pdf->AddPage();

            // column titles
            $header = array('تاریخ تردد', 'پیام', 'دستگاه', 'جهت', 'نام خانوادگی', 'نام','کد' );
            $traffic = static::getTrafficsPDF($request, null);

            // print colored table
            $this->ColoredTable($pdf, $header, $traffic);

            // close and output PDF document
            $pdf->Output('example_011.pdf', 'I');
        }
    }

    public static function getTrafficsPDF (Request $request, $id = null)
    {
        $relation = [
            'user',
            'user.people',
            'gatedevice',
            'gatepass',
            'gatedirect',
            'gatemessage',
        ];

        if((\Auth::user()->level_id) == 1)
        {
            $traffic = \App\Gatetraffic::with($relation);
        }
        elseif ((\Auth::user()->level_id) == 3) {
            $traffic = \App\Gatetraffic::with($relation)
                    ->where('user_id', \Auth::user()->id);
        }

        if (! is_null ($id))
        {
            $traffic->where('id', $id)
                    ->with($relation);
        }


        $traffic->orderBy('gatedate','DESC');
        return $traffic->get();
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
        $w = array(20, 20, 25, 20, 30, 35);
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
            $pdf->Cell($w[0], 6, $row->user_code, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[1], 6, $row->people_name, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[2], 6, $row->people_lastname, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[3], 6, $row->gatemessage_name, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[4], 6, $row->gatedirect_name, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[5], 6, miladiToPersianDateTime($row->gatetraffic_gatedate), 'LR', 0, 'C', $fill);
            $pdf->Ln();
            $fill=!$fill;
        }
        $pdf->Cell(array_sum($w), 0, '', 'T');
    }

    public function export()
    {
         $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 001');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);
           // set some language dependent data:
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';

        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($lg);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // set text shadow effect
        $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

        // Set some content to print
        $html = <<<EOD
<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;

            // Print text using writeHTMLCell()
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            // ---------------------------------------------------------

            // Close and output PDF document
            // This method has several options, check the source code documentation for more information.
            $pdf->Output('example_001.pdf', 'I');
    }

    public function pdf_export(Request $request)
    {
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 001');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'گزارش'.' ورود و خروج', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language dependent data:
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'rtl';
        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';

        // // set some language-dependent strings (optional)
        $pdf->setLanguageArray($lg);

        // set font
        $pdf->SetFont('dejavusans', '', 8);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        // column titles
        $header = array('مسیر تردد', 'پیام', 'تاریخ تردد', 'نام خانوادگی', 'نام','کد' );

        $traffic = static::searchMyTraffic($request);

        // print colored table
        $this->ColoredTableExport($pdf, $header, $traffic);

        // close and output PDF document
        $pdf->Output('report.pdf', 'I');
    }
    /**
     * { function_description }
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public static function searchMyTraffic(Request $request)
    {
        $group_id = $request->groupId;
        $code = $request->code;
        $gatemesage_id = $request->messageId;
        $gatedirect_id = $request->directId;
        $gatedevice_id = $request->deviceId;
        $gender_id = $request->genderId;
        $startDate = $request->beginDateTime;
        $endDate = $request->endDateTime;
        $commonRange_id = $request->commonrangeId;
        // IF filter = true : startDate and endDate
        // IF filter = false: Common range
        $filter = $request->type_filter;

        // if (! $filter){
        //     $dateFilter =  static::getDateFilter($commonRange_id);
        //     $startDate = $dateFilter['startOfDate'];
        //     $endDate = $dateFilter['endOfDate'];
        // }

        $res = \App\Gatetraffic::whereBetween('gatedate',[$startDate,$endDate]);
        $res = $res->join ('users', 'gatetraffics.user_id', 'users.id')
                   ->join ('people', 'people.id', 'users.people_id')
                   ->join ('genders', 'genders.id', 'people.gender_id')
                   ->join ('groups', 'groups.id', 'users.group_id')
                   ->join('gatedevices', 'gatedevices.id', 'gatetraffics.gatedevice_id')
                   ->join('gatepasses', 'gatepasses.id', 'gatetraffics.gatepass_id')
                   ->join('gatedirects', 'gatedirects.id', 'gatetraffics.gatedirect_id')
                   ->join('gatemessages', 'gatemessages.id', 'gatetraffics.gatemessage_id');

        if (! is_null($group_id) && ($group_id > 0)){
            $res = $res->where('users.group_id', $group_id);
        }

        if (! is_null($code)){
            $res = $res->where('users.code','like', "%$code%");
        }

        if (!is_null ($gatemesage_id)) {
            $res = $res->Where ('gatemessages.id', '=', $gatemesage_id);
        }

        if (!is_null ($gatedevice_id)) {
            $res = $res->Where ('gatedevices.id', '=', $gatedevice_id);
        }

        if (!is_null ($gatedirect_id)) {
            $res = $res->Where ('gatedirects.id', '=', $gatedirect_id);
        }

        if (!is_null ($gender_id)) {
            $res = $res->Where ('genders.id', '=', $gender_id);
        }

        $res = $res->select ('gatetraffics.gatedate as gatetraffic_gatedate',
                            'gatemessages.message as gatemessage_name',
                            'gatedirects.name as gatedirect_name',
                            'genders.gender as gender_name',
                            'groups.name as group_name',
                            'users.code as user_code',
                            'people.name as people_name',
                            'people.lastname as people_lastname',
                            'people.nationalId as people_nationalId'
                        )
                    // ->orderBy('gatetraffics.gatedate','DESC')
                    ->get();
        return $res;
    }
}
