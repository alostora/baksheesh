<?php

namespace Guest\Observers;

use App\Mail\EmployeeBadRatingMail;
use App\Models\EmployeeRating;
use Illuminate\Support\Facades\Mail;

class EmployeeRatingObserver
{


     /**
      * Handle the User "created" event.
      *
      * @param  \Construcllo\Shared\Task\Models\Task $task
      * @return void
      */


     public function created(EmployeeRating $employeeRating)
     {
        //   if ($employeeRating->rating_value < 3) {

        //        $mailData = [
        //             'client_name' => $employeeRating->client->name,
        //             'company_name' => $employeeRating->company->name,
        //             'employee_name' => $employeeRating->employee->name,
        //             'rating_name' => $employeeRating->availableRating->name,
        //             'rating_value' => $employeeRating->rating_value,
        //             'url' => url('')
        //        ];

        //        Mail::to($employeeRating->client->email)->send(new EmployeeBadRatingMail($mailData));
        //   }
     }

     public function updated(EmployeeRating $employeeRating)
     {

        //   if ($employeeRating->wasChanged('rating_value')) {

        //        if ($employeeRating->rating_value < 3) {

        //             $mailData = [
        //                  'client_name' => $employeeRating->client->name,
        //                  'company_name' => $employeeRating->company->name,
        //                  'employee_name' => $employeeRating->employee->name,
        //                  'rating_name' => $employeeRating->availableRating->name,
        //                  'rating_value' => $employeeRating->rating_value,
        //                  'url' => url('')
        //             ];

        //             Mail::to($employeeRating->client->email)->send(new EmployeeBadRatingMail($mailData));
        //        }
        //   }
     }
}
