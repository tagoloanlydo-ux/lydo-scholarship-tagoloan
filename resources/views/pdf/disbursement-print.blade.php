<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disbursement Report - Print</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 20px;
        }

        .header h1 {
            margin: 0 0 10px 0;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header .subtitle {
            font-size: 16px;
            margin: 5px 0;
            font-weight: normal;
        }

        .header .date {
            font-size: 14px;
            margin-top: 10px;
            font-style: italic;
        }

        .filters {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .filters strong {
            display: inline-block;
            margin-right: 10px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #333;
            padding: 8px 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #343a40;
            color: white;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            font-size: 10px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            background-color: #e9ecef;
            font-weight: bold;
        }

        .total-row td {
            border-top: 2px solid #333;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .no-data {
            text-align: center;
            padding: 50px;
            font-size: 14px;
            color: #666;
            font-style: italic;
        }

        @media print {
            body {
                padding: 15px;
            }

            .header {
                margin-bottom: 20px;
            }

            table {
                font-size: 10px;
            }

            th, td {
                padding: 6px 4px;
            }

            .footer {
                margin-top: 30px;
                page-break-inside: avoid;
            }
        }

        @page {
            margin: 0.5in;
            size: A4 landscape;
        }
    </style>
</head>
<body>
  <div class="header" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 30px; border-bottom: 3px solid #333; padding-bottom: 20px;">
    
    <!-- LEFT: Logo -->
    <div style="flex: 1; display: flex; justify-content: flex-start;">
        <img src="/images/LYDO.png" alt="LYDO Logo" style="height: 90px;">
    </div>

    <!-- CENTER: Text -->
    <div style="flex: 1.5; text-align: center;">
        <h1 style="margin: 0 0 10px 0; font-size: 24px; font-weight: bold; text-transform: uppercase;">
            LYDO Scholarship Disbursement Report
        </h1>
        <div class="subtitle" style="font-size: 16px; margin: 5px 0;">Tagoloan, Misamis Oriental</div>
        <div class="subtitle" style="font-size: 16px; margin: 5px 0;">Local Youth Development Office</div>
        <div class="date" style="font-size: 14px; margin-top: 10px; font-style: italic;">
            Generated on: {{ date('F d, Y \a\t h:i A') }}
        </div>
    </div>

    <!-- RIGHT: Empty for balance -->
    <div style="flex: 1;"></div>
</div>



    @if(!empty($filters))
    <div class="filters">
        <strong>Applied Filters:</strong>
        {{ implode(' | ', $filters) }}
    </div>
    @endif

    @if($disbursements->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 25%;">Scholar Name</th>
                <th style="width: 15%;">Barangay</th>
                <th style="width: 12%;">Academic Year</th>
                <th style="width: 13%;">Semester</th>
                <th style="width: 15%;">Amount</th>
                <th style="width: 15%;">Disbursement Date</th>
                <th style="width: 15%;">Signature</th>
            </tr>
        </thead>
        <tbody>
            @foreach($disbursements as $index => $disbursement)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $disbursement->full_name }}</td>
                <td class="text-center">{{ $disbursement->applicant_brgy }}</td>
                <td class="text-center">{{ $disbursement->disburse_acad_year }}</td>
                <td class="text-center">{{ $disbursement->disburse_semester }}</td>
                <td class="text-right">₱{{ number_format($disbursement->disburse_amount, 2) }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($disbursement->disburse_date)->format('M d, Y') }}</td>
                <td style="padding: 15px 6px; text-align: center;">
                <div style="border-bottom: 1px solid #ffffffff; width: 120px; margin: 0 auto;"></div> 
            </tr>
            @endforeach
            <!-- Total Row -->
            <tr class="total-row">
                <td colspan="6" class="text-right" style="font-weight: bold; font-size: 12px;">TOTAL AMOUNT:</td>
                <td class="text-right" style="font-weight: bold; font-size: 12px;">₱{{ number_format($disbursements->sum('disburse_amount'), 2) }}</td>
                <td class="text-center" style="font-weight: bold; font-size: 12px;">-</td>
            </tr>
        </tbody>
    </table>

    <!-- Signature Section -->
    <div class="signature-section" style="margin-top: 60px; page-break-inside: avoid;">
        <table style="width: 100%; border: none; margin-top: 40px;">
            <tr>
                <td style="width: 33%; text-align: center; border: none; padding: 20px;">
                    <div style="border-bottom: 1px solid #333; width: 200px; margin: 0 auto 10px auto;"></div>
                    <p style="margin: 5px 0; font-size: 11px; font-weight: bold;">Prepared By:</p>
                    <p style="margin: 5px 0; font-size: 10px;">LYDO Staff</p>
                    <p style="margin: 5px 0; font-size: 10px;">Date: ________________</p>
                </td>
                <td style="width: 33%; text-align: center; border: none; padding: 20px;">
                    <div style="border-bottom: 1px solid #333; width: 200px; margin: 0 auto 10px auto;"></div>
                    <p style="margin: 5px 0; font-size: 11px; font-weight: bold;">Verified By:</p>
                    <p style="margin: 5px 0; font-size: 10px;">LYDO Administrator</p>
                    <p style="margin: 5px 0; font-size: 10px;">Date: ________________</p>
                </td>
                <td style="width: 33%; text-align: center; border: none; padding: 20px;">
                    <div style="border-bottom: 1px solid #333; width: 200px; margin: 0 auto 10px auto;"></div>
                    <p style="margin: 5px 0; font-size: 11px; font-weight: bold;">Approved By:</p>
                    <p style="margin: 5px 0; font-size: 10px;">Municipal Mayor</p>
                    <p style="margin: 5px 0; font-size: 10px;">Date: ________________</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p><strong>Total Records:</strong> {{ $disbursements->count() }} | <strong>Report Period:</strong> All disbursements matching applied filters</p>
        <p>This is an official document of the LYDO Scholarship Program. Generated by the LYDO Scholarship Management System.</p>
        <p>For verification, please contact the Local Youth Development Office at Tagoloan, Misamis Oriental.</p>
    </div>
    @else
    <div class="no-data">
        <p>No disbursement records found matching the specified criteria.</p>
        <p>Please adjust your filters and try again.</p>
    </div>
    @endif

    <script>
        // Auto-print when page loads
        window.onload = function() {
            window.print();
        }

        // Close window after printing (optional)
        window.onafterprint = function() {
            // Uncomment the line below if you want the window to close after printing
            // window.close();
        }
    </script>
</body>
</html>
