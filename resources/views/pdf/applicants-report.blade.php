<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Applicants Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
        }
        .filters {
            margin-bottom: 20px;
            font-size: 11px;
        }
        .filters strong {
            display: inline-block;
            margin-right: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: center;
            font-size: 11px;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .no-data {
            text-align: center;
            padding: 50px;
            font-size: 14px;
            color: #666;
        }
        .remarks-approved {
            color: #28a745;
            font-weight: bold;
        }
        .remarks-rejected {
            color: #dc3545;
            font-weight: bold;
        }
        .remarks-pending {
            color: #ffc107;
            font-weight: bold;
        }
        .remarks-other {
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LYDO Scholarship Applicants Report</h1>
        <p>Tagoloan, Misamis Oriental</p>
        <p>Generated on: {{ date('F d, Y') }}</p>
    </div>

    @if(!empty($filters))
    <div class="filters">
        <strong>Applied Filters:</strong>
        {{ implode(' | ', $filters) }}
    </div>
    @endif

    @if($applicants->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 20%;">Full Name</th>
                <th style="width: 15%;">Email</th>
                <th style="width: 12%;">Contact Number</th>
                <th style="width: 10%;">Barangay</th>
                <th style="width: 10%;">Academic Year</th>
                <th style="width: 28%;">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applicants as $index => $applicant)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    {{ $applicant->applicant_fname }}
                    @if($applicant->applicant_mname)
                        {{ $applicant->applicant_mname }}
                    @endif
                    {{ $applicant->applicant_lname }}
                    @if($applicant->applicant_suffix)
                        {{ $applicant->applicant_suffix }}
                    @endif
                </td>
                <td>{{ $applicant->applicant_email }}</td>
                <td>{{ $applicant->applicant_contact_number }}</td>
                <td>{{ $applicant->applicant_brgy }}</td>
                <td class="text-center">{{ $applicant->applicant_acad_year }}</td>
                <td>
                    @php
                        $remarksClass = 'remarks-other';
                        $remarksValue = $applicant->remarks;
                        if (is_string($remarksValue)) {
                            $lowerRemarks = strtolower($remarksValue);
                            if (strpos($lowerRemarks, 'approved') !== false || strpos($lowerRemarks, 'passed') !== false) {
                                $remarksClass = 'remarks-approved';
                            } elseif (strpos($lowerRemarks, 'rejected') !== false || strpos($lowerRemarks, 'failed') !== false) {
                                $remarksClass = 'remarks-rejected';
                            } elseif (strpos($lowerRemarks, 'pending') !== false || strpos($lowerRemarks, 'review') !== false) {
                                $remarksClass = 'remarks-pending';
                            }
                        }
                    @endphp
                    <span class="{{ $remarksClass }}">
                        {{ $remarksValue ?: 'No remarks' }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total Applicants: {{ $applicants->count() }}</p>
        <p>Report generated by LYDO Scholarship System</p>
    </div>
    @else
    <div class="no-data">
        <p>No applicant records found matching the specified criteria.</p>
    </div>
    @endif
</body>
</html>
