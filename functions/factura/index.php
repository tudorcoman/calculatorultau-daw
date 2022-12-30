<?php

require_once __DIR__ . '/vendor/autoload.php';

function configure_mpdf() {
    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];
    
    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];
    
    $mpdf= new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
        'margin_header' => 0,
        'margin_footer' => 0,
    
        'fontDir' => array_merge($fontDirs, [__DIR__ . '/fonts/']),
        'fontdata' => $fontData + [
            'mhei' => [
                'R' => 'mheilight.ttf'
            ],
            // 'arial' => [
            //     'R' => 'Arialn.ttf',
            //     'B' => 'ArialTh.ttf'
            // ],
            'helvetica' => [
                'R' => 'Helvetica.ttf'
            ]
        ]
    ]);

    $stylesheet = file_get_contents(__DIR__ . '/style.css');
    $mpdf->SetHTMLHeader('<div style="padding: 40px; text-align: center; background: #c3aef2;"></div>');
    $mpdf->SetHTMLFooter('<div style="padding: 25px; text-align: center; background: #c3aef2;"></div>');
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    return $mpdf; 
}

function get_title_desc($client_name, $billing_address) {
    $schelet_titlu = file_get_contents(__DIR__ . '/title.html');
    return sprintf($schelet_titlu, $client_name, $billing_address);
}

function get_totals_section($total) {
    $tva = 0.19 * $total; 
    $totals_schelet = file_get_contents(__DIR__ . "/totals.html");
    return sprintf($totals_schelet, $tva, $total);
}


function get_table_rows($left_bound, $right_bound, $product_names, $product_quantities, $product_unit_prices) {
    $colectie_tr = "";
    $tr_schelet = file_get_contents(__DIR__ . '/table_row.html');
    for($i = $left_bound; $i < $right_bound; $i ++) {
        $tr = sprintf($tr_schelet, $product_names[$i], $product_unit_prices[$i], $product_quantities[$i], $product_unit_prices[$i] * $product_quantities[$i]); 
        $colectie_tr .= $tr; 
    }
    return $colectie_tr;
}

function generate_invoice($number, $client_name, $billing_address, $product_names, $product_quantities, $product_unit_prices, $date_string) {
    $mpdf = configure_mpdf(); 

    $schelet = '<div class="header"></div><div class="continut">%s</div>'; 
    $content = ""; 

    $content .= get_title_desc($client_name, $billing_address);
    
    $tabel_schelet = file_get_contents(__DIR__ . '/tabel.html');
    
    $company_info_schelet = file_get_contents(__DIR__ . '/company_info.html');
    $company_info = sprintf($company_info_schelet, $number, $date_string);
    
    $total = 0.0; 
    for($i = 0; $i < count($product_names); $i ++) {
        $total = $total + $product_unit_prices[$i] * $product_quantities[$i];
    }

    if (count($product_names) > 7) {
        // avem nevoie de mai multe pagini pentru factura
        $colectie_tr = get_table_rows(0, 7, $product_names, $product_quantities, $product_unit_prices);
        $first_tabel = sprintf($tabel_schelet, $company_info, $colectie_tr);

        $content .= "<div>" . $tabel . "</div>"; 
        $mpdf->WriteHTML(sprintf($schelet, $content), \Mpdf\HTMLParserMode::HTML_BODY);

        for ($i = 7; $i < count($product_names); $i = $i + 17) {
            $colectie_tr = get_table_rows($i, min(count($product_names), $i + 17), $product_names, $product_quantities, $product_unit_prices);
            $tabel = sprintf($tabel_schelet, "", $colectie_tr);
            if ($i + 17 >= count($product_names)) {
                $content = "<div>" . $tabel . $totals . "</div>";
            } else {
                $content = "<div>" . $tabel . "</div>";
            }
            $mdf->AddPage();
            $mpdf->WriteHTML(sprintf($schelet, $content), \Mpdf\HTMLParserMode::HTML_BODY);
        }


    } else {
        $colectie_tr = get_table_rows(0, count($product_names), $product_names, $product_quantities, $product_unit_prices);
        $tabel = sprintf($tabel_schelet, $company_info, $colectie_tr);

        $totals = get_totals_section($total);
        $content .= "<div>" . $tabel . $totals . "</div>";
        $mpdf->WriteHTML(sprintf($schelet, $content), \Mpdf\HTMLParserMode::HTML_BODY);
    }

    return $mpdf->Output("", \Mpdf\Output\Destination::STRING_RETURN); 
}

?>
