<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    // Specify the table name (optional if the table name is the plural of the model name)
    protected $table = 'tickets';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'id',
        'priority',
        'title',
        'issue_type',
        'date',
        'issue_description',
        'documents',
    ];
}
