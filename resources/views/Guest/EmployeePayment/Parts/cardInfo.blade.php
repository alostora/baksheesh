<div class="logo_bg">
    <img class="img_logo" src="{{ url('uploads/' . $employee->company->file->new_name) }}" alt="logo" />
</div>
<div class="employee_bg">
    <div class="employee_img">
        <img src="{{ url('uploads/' . $employee->file->new_name) }}" alt="employee logo" style="border-radius: 20px; width: 105px; height: 110px" />
    </div>
    <div class="employee_text">
        <div class="name">
            <p style="font-size: 10px; font-weight: 600; color: #9d9b9e">
                الاسم
            </p>
            <p style="font-size: 16px; font-weight: 800; color: #2a0a0a">
                {{ $employee->name }}
            </p>
        </div>
        <div class="name">
            <p style="font-size: 10px; font-weight: 600; color: #9d9b9e">
                الوظيفة
            </p>
            <p style="font-size: 14px; font-weight: 800; color: #2a0a0a">
                {{ $employee->employee_job_name }}
            </p>
        </div>
        <div class="rate_allRate">
            <div class="name" style="text-align: center">
                <p style="font-size: 10px; font-weight: 600; color: #9d9b9e">
                    اجمالي التقييمات
                </p>
                <p style="font-size: 16px; font-weight: 800; color: #2a0a0a">
                    {{$employee->ratingForGuest->count()}}
                </p>
            </div>
            <div class="name">
                <p style="font-size: 10px; font-weight: 600; color: #9d9b9e">
                    التقييم
                </p>
                <p style="font-size: 16px; font-weight: 800; color: #2a0a0a">
                    @if ($employee->employeeTotalRating <= 0 ) N/A @endif @if ($employee->employeeTotalRating > 0 && $employee->employeeTotalRating <= 20) 1 @endif @if ($employee->employeeTotalRating >= 21 && $employee->employeeTotalRating <= 40) 2 @endif @if ($employee->employeeTotalRating >= 41 && $employee->employeeTotalRating <= 60) 3 @endif @if ($employee->employeeTotalRating >= 61 && $employee->employeeTotalRating <= 80) 4 @endif @if ($employee->employeeTotalRating >= 81 && $employee->employeeTotalRating <= 100) 5 @endif <span style="font-size: 14px; font-weight: 600; color: #9d9b9e"> /5</span>
                </p>
            </div>
        </div>
    </div>
</div>
