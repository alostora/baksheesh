<!-- المودال - فقط فتح وقفل -->
<div id="simpleContactModal"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; font-family: Arial, sans-serif;">
    <div
        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 25px; border-radius: 8px; width: 90%; max-width: 400px; box-shadow: 0 5px 20px rgba(0,0,0,0.2);">

        <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; color: #e74c3c; font-size: 18px;">معلومات التواصل</h3>
            <button onclick="closeSimpleModal()"
                style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
        </div>

        <div style="margin-bottom: 20px;">
            <p style="margin: 0 0 15px 0; color: #333; line-height: 1.5;">
                الاسم والهاتف مطلوبين حتى يمكننا التواصل معك
            </p>
        </div>

        <!-- الحقول مع نفس الـ onkeyup -->
        <div style="margin-bottom: 20px;">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; color: #333; font-weight: bold;">الاسم *</label>
                <input type="text" id="modal_payer_name" onkeyup="appendPayerName(this)"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;"
                    placeholder="أدخل اسمك">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; color: #333; font-weight: bold;">رقم الهاتف *</label>
                <input type="tel" id="modal_payer_phone" onkeyup="appendPayerPhone(this)"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;"
                    placeholder="مثال: 01012345678">
            </div>
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-end;">
            <button onclick="closeSimpleModal()"
                style="padding: 10px 20px; background: #95a5a6; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">إغلاق</button>
            <button onclick="closeSimpleModal()"
                style="padding: 10px 20px; background: #e74c3c; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px;">تم</button>
        </div>

    </div>
</div>

<script>
    // فقط 4 فانكشنات كما طلبت:

    // 1. فتح المودال
    function showSimpleModal() {
        document.getElementById('simpleContactModal').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    // 2. إغلاق المودال
    function closeSimpleModal() {
        document.getElementById('simpleContactModal').style.display = 'none';
        document.body.style.overflow = '';
    }
{{--
    // 3. السماع للاسم (جاهزة في صفحتك)
    function appendPayerName(e) {
        document.getElementById('payer_name').value = e.value;
    }

    // 4. السماع للهاتف (جاهزة في صفحتك)
    function appendPayerPhone(e) {
        document.getElementById('payer_phone').value = e.value;
    } --}}

    // إغلاق بالنقر خارج المودال
    document.getElementById('simpleContactModal').addEventListener('click', function(e) {
        if (e.target.id === 'simpleContactModal') {
            closeSimpleModal();
        }
    });

    // إغلاق بالزر ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('simpleContactModal').style.display === 'block') {
            closeSimpleModal();
        }
    });
</script>
