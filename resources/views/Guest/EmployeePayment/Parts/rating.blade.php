<div class="comp_title">
    <h3>تقييم الموظف</h3>
</div>

<div class="employee_ratting">

    @if (count($employee->ratingForGuest))
    @foreach ($employee->ratingForGuest as $key => $employee_available_rating)
    <div class="ratting_row">
        <div class="">
            <label>
                @foreach ([1, 2] as $i)
                <?php $image = $i == 1 ? 'SadB' : 'HappyB'; ?>

                <img src="{{ url('guest/images/' . $image . '.png') }}" class="{{ $key . '__' . $i }}" name="{{ $employee_available_rating->employeeAvailableRating->id }}" value="{{ $i }}" onclick="postRate(this)" id="{{ $key . '__' . $i }}" style="font-size:50px;color:#fff; padding:5px; width:70px;height:70px; border-radius:100px;" />
                @endforeach
            </label>

        </div>
        <div class="ratting_name">
            <p style="font-size: medium; font-weight: bold; ">{{ $employee_available_rating->employeeAvailableRating->name_ar }}</p>
        </div>
    </div>
    @endforeach
    @endif

</div>
