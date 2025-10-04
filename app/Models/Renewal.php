<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renewal extends Model
{
    use HasFactory;

    protected $table = 'tbl_renewal';
    protected $primaryKey = 'renewal_id';
    public $timestamps = true;

    protected $fillable = [
        'scholar_id', 'renewal_cert_of_reg', 'renewal_grade_slip',
        'renewal_brgy_indigency', 'renewal_semester', 'renewal_acad_year',
        'date_submitted', 'renewal_status'
    ];
}
