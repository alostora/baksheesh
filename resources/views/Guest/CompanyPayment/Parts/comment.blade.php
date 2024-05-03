<div class="comp_title">
    <h3 id="note_header">أضف تعليق</h3>
</div>

<div class="addComment">
    <div class=" comment_row">
        <input type="text" dir="rtl" class="input_name" onkeyup="appendPayerName(this)">
        <label for="amount" class="label_name">الاسم</label>
    </div>
    <div class="comment_row">
        <input type="text" dir="rtl" class="input_name" onkeyup="appendPayerPhone(this)">
        <label for="amount" class="label_name">الجوال</label>
    </div>
    <div class="comment_row">
        <textarea class="input_name" dir="rtl" name="notes" id="notes" style="height:100px;border-radius: 20px;width:77%;"></textarea>
        <label for="notes" class="label_name">التعليق</label>
    </div>

    <div class="comment_row">
        <button class="btn" type="button" onclick="sendCompanyNote()">ارسال</button>
    </div>
    <br>
    <span id="noteErrorMsg" style="display:none;">من فضلك ادخل الاسم والجوال</span>
</div>
