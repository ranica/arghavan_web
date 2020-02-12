<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Orchestra\Parser\Xml\Facade as XmlParser;


class TestController extends Controller
{
    public function __construct ()
    {
    }

    public function testUploader(Request $request)
    {
        $code = $request->code;
        $name = $request->name;

     
        $path = $request->file('image')
            ->store('test-images');

        return $path;
    }


    public function readXML()
    {
        $name = 'xml_document_province.json';
        if( file_exists( public_path() . "/XML_files/" . $filename )){

        }
        $files = \File::files(public_path() . "/XML_files");
        $content = \File::get($files[0]);

        $jsonData = json_decode($content);

        dd($jsonData->province->data);


    }

    public function uploadImage(Request $request)
    {
        $files = \File::files(public_path() . "/upload_images");

        // GET FILES LIST [ok]
            // FOR-EACH [ok]
                // Get Student Code [ok]
                    // Find student record
                    // Resize & Save Image          [ok]
                    // Update student record
        foreach ($files as $file)
        {
            $originalFileName = $file->getFileName ();

            // Update student record
            $studentCode = pathinfo($file, PATHINFO_FILENAME);
            // $extension = pathinfo($file, PATHINFO_EXTENSION);

            // Find student record
            $data = \App\User::where('code', $studentCode)
                             ->get();

            // Generate output filename
            $outputFileName = str_random(60);
            $savePath = storage_path ('app\public\\' . $outputFileName . ".jpg");

           // dd($savePath);
            // get real filename
            $filename = $file->getRealPath();

            // Save resized image
            $image_resize = \Image::make($filename);
            $image_resize->resize (300, 300);
            $image_resize->save ($savePath);

            // Update record
            if (! is_null($data[0]))
            {
                $orginal_people = \App\People::where('id', $data[0]->people_id)
                                               ->get();
                $orginal_people[0]->update([
                    'picture' => $outputFileName . ".jpg",
                ]);
            }
        }

        return;

    }

    public function testMPDF()
    {
            $mpdf = new \Mpdf\Mpdf([
                'mode' => '+aCJK',
                'margin_left' => 32,
                'margin_right' => 25,
                'margin_top' => 27,
                'margin_bottom' => 25,
                'margin_header' => 16,
                'margin_footer' => 13,
                'autoArabic' => true,
                'autoLangToFont' => true
            ]);

            $header = array (
                'L' => array (
                    'content' => '<p lang="fa">گزارشات</p>',
                    'font-size' => 10,
                    'font-style' => 'B',
                    'font-family' => 'serif',
                    'color'=>'#000000'
                ),
                'C' => array (
                    'content' => '',
                    'font-size' => 10,
                    'font-style' => 'B',
                    'font-family' => 'serif',
                    'color'=>'#000000'
                ),
                'R' => array (
                    'content' => '',
                    'font-size' => 10,
                    'font-style' => 'B',
                    'font-family' => 'serif',
                    'color'=>'#000000'
                ),
                'line' => 1
            );
            $footer = array (
                'odd' => array (
                    'L' => array (
                        'content' => '',
                        'font-size' => 10,
                        'font-style' => 'B',
                        'font-family' => 'serif',
                        'color'=>'#000000'
                    ),
                    'C' => array (
                        'content' => '',
                        'font-size' => 10,
                        'font-style' => 'B',
                        'font-family' => 'serif',
                        'color'=>'#000000'
                    ),
                    'R' => array (
                        'content' => 'My document',
                        'font-size' => 10,
                        'font-style' => 'B',
                        'font-family' => 'serif',
                        'color'=>'#000000'
                    ),
                    'line' => 1,
                ),
                'even' => array ()
            );

            $mpdf->Bookmark('Start of the document');
            $mpdf->SetDirectionality('rtl');
            // $mpdf->autoLangToFont = true;
            $mpdf->SetHeader($header, 'O');
            // $mpdf->SetHeader('گزارشات|Center Text|{PAGENO}');
            $mpdf->SetFooter('تاریخ');
            $this->fontdata = array(
                    "sun-exta" => array(
                        'R' => "ayar.ttf",
                        // 'R' => "ayar.ttf",
                        // 'sip-ext' => 'sun-extb',
                    ),
                    // "sun-extb" => array(
                    //     'R' => "Sun-ExtB.ttf",
                    // ),
                );


            $html = '<p lang="fa"> مرجان قبادی فرد.
            این یک تست است</p>
            <div style="font-family:mingliu_hkscs;">
           Test Me
            </div>
            <table>
                <thead>
                    <td> <p lang="fa"> عنوان  </p></td>
                </thead>
                <tbody>
                    <tr>
                        <td> مرجان </td>
                    </tr>
                </tbody>
            </table>
            ';
            $mpdf->WriteHTML($html);

            $mpdf->Output();
    }
    // public function testUpload()
    // {
    // 	return view('test-upload');
    // }


    // public function uploadData(Request $request)
    // {
    //     if ($request->hasFile('image'))
    //     {
    //         $file = $request->file('image');
    //         dd($request);
	   //  	$result = $file->store('');

    //         // dd($result);

	   //  	return [ 'save' => $result,
	   //  			'url' => \Storage::url($result),
	   //  			'client' => $file->getClientOriginalName()
	   //  		];
    // 	}

    // 	return 'file not found';
    // }
    //
    public function tcp_pdf()
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

    }

