    <div class="logo_bg">
        <img class="img_logo" src="{{ url('guest/images/logo_tipo.png') }}" alt="logo" />
    </div>
    <div class="employee_bg">
        <div class="employee_img">
            <img src="{{ url('uploads/' . $company->file->new_name) }}" alt="employee logo" style="border-radius: 20px; width: 105px; height: 110px" />
        </div>
        <div class="employee_text">
            <div class="name">
                <p style="font-size: 10px; font-weight: 600; color: #9d9b9e">
                    الاسم
                </p>
                <p style="font-size: 16px; font-weight: 800; color: #2a0a0a">
                    {{ $company->name }}
                </p>
            </div>
            <div class="name">
                <p style="font-size: 10px; font-weight: 600; color: #9d9b9e">
                    النشاط
                </p>
                <p style="font-size: 14px; font-weight: 800; color: #2a0a0a">
                    {{ $company->company_field }}
                </p>
            </div>
            <div class="rate_allRate">
                <div class="name" style="text-align: center">
                    <p style="font-size: 10px; font-weight: 600; color: #9d9b9e">
                        اجمالي التقييمات
                    </p>
                    <p style="font-size: 16px; font-weight: 800; color: #2a0a0a">
                        135
                    </p>
                </div>
                <div class="name">
                    <p style="font-size: 10px; font-weight: 600; color: #9d9b9e">
                        التقييم
                    </p>
                    <p style="font-size: 16px; font-weight: 800; color: #2a0a0a">
                        @if ($company->companyTotalRating > 0 && $company->companyTotalRating <= 20) 1 @endif @if ($company->companyTotalRating >= 21 && $company->companyTotalRating <= 40) 2 @endif @if ($company->companyTotalRating >= 41 && $company->companyTotalRating <= 60) 3 @endif @if ($company->companyTotalRating >= 61 && $company->companyTotalRating <= 80) 4 @endif @if ($company->companyTotalRating >= 81 && $company->companyTotalRating <= 100) 5 @endif <span style="font-size: 14px; font-weight: 600; color: #9d9b9e"> /5</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
