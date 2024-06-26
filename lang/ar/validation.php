<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول الحقل',
    'accepted_if' => 'الحقل مقبول في حال ما إذا كان :other يساوي :value.',
    'active_url' => 'الحقل لا يُمثّل رابطًا صحيحًا',
    'after' => 'يجب على الحقل أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => 'الحقل يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي الحقل سوى على حروف',
    'alpha_dash' => 'يجب أن لا يحتوي الحقل على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي على حروفٍ وأرقامٍ فقط',
    'array' => 'يجب أن يكون الحقل ًمصفوفة',
    'before' => 'يجب على الحقل أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => 'الحقل يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
    'between' => [
        'array' => 'يجب أن يحتوي على عدد من العناصر بين :min و :max',
        'file' => 'يجب أن يكون حجم الملف بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة بين :min و :max.',
        'string' => 'يجب أن يكون عدد حروف النّص بين :min و :max',
    ],
    'boolean' => 'يجب أن تكون قيمة الحقل إما true أو false ',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل',
    'current_password' => 'كلمة المرور غير صحيحة',
    'date' => 'الحقل ليس تاريخًا صحيحًا',
    'date_equals' => 'لا يساوي الحقل مع :date.',
    'date_format' => 'لا يتوافق الحقل مع الشكل :format.',
    'declined' => 'يجب رفض الحقل',
    'declined_if' => 'الحقل مرفوض في حال ما إذا كان :other يساوي :value.',
    'different' => 'يجب أن يكون الحقلان و :other مُختلفان',
    'digits' => 'يجب أن يحتوي الحقل على :digits رقمًا/أرقام',
    'digits_between' => 'يجب أن يحتوي الحقل بين :min و :max رقمًا/أرقام',
    'dimensions' => 'الـ يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل قيمة مُكرّرة.',
    'doesnt_end_with' => 'الحقل يجب ألا ينتهي بواحدة من القيم التالية: :values.',
    'doesnt_start_with' => 'الحقل يجب ألا يبدأ بواحدة من القيم التالية: :values.',
    'email' => 'يجب أن يكون عنوان بريد إلكتروني صحيح البُنية',
    'ends_with' => 'الـ يجب ان ينتهي بأحد القيم التالية :value.',
    'enum' => 'الحقل غير صحيح',
    'exists' => 'الحقل لاغٍ',
    'file' => 'الـ يجب أن يكون من ملفا.',
    'filled' => 'الحقل إجباري',
    'gt' => [
        'array' => 'الـ يجب ان يحتوي علي اكثر من :value عناصر/عنصر.',
        'file' => 'الـ يجب ان يكون اكبر من :value كيلو بايت.',
        'numeric' => 'الـ يجب ان يكون اكبر من :value.',
        'string' => 'الـ يجب ان يكون اكبر من :value حروفٍ/حرفًا.',
    ],
    'gte' => [
        'array' => 'الـ يجب ان يحتوي علي :value عناصر/عنصر او اكثر.',
        'file' => 'الـ يجب ان يكون اكبر من او يساوي :value كيلو بايت.',
        'numeric' => 'الـ يجب ان يكون اكبر من او يساوي :value.',
        'string' => 'الـ يجب ان يكون اكبر من او يساوي :value حروفٍ/حرفًا.',
    ],
    'image' => 'يجب أن يكون الحقل صورةً',
    'in' => 'الحقل لاغٍ',
    'in_array' => 'الحقل غير موجود في :other.',
    'integer' => 'يجب أن يكون الحقل عددًا صحيحًا',
    'ip' => 'يجب أن يكون الحقل عنوان IP ذا بُنية صحيحة',
    'ipv4' => 'يجب أن يكون الحقل عنوان IPv4 ذا بنية صحيحة.',
    'ipv6' => 'يجب أن يكون الحقل عنوان IPv6 ذا بنية صحيحة.',
    'json' => 'يجب أن يكون الحقل نصا من نوع JSON.',
    'lowercase' => 'الحقل يجب ان يتكون من حروف صغيرة',
    'lt' => [
        'array' => 'الـ يجب ان يحتوي علي اقل من :value عناصر/عنصر.',
        'file' => 'الـ يجب ان يكون اقل من :value كيلو بايت.',
        'numeric' => 'الـ يجب ان يكون اقل من :value.',
        'string' => 'الـ يجب ان يكون اقل من :value حروفٍ/حرفًا.',
    ],
    'lte' => [
        'array' => 'الـ يجب ان يحتوي علي اكثر من :value عناصر/عنصر.',
        'file' => 'الـ يجب ان يكون اقل من او يساوي :value كيلو بايت.',
        'numeric' => 'الـ يجب ان يكون اقل من او يساوي :value.',
        'string' => 'الـ يجب ان يكون اقل من او يساوي :value حروفٍ/حرفًا.',
    ],
    'mac_address' => 'يجب أن يكون الحقل عنوان MAC ذا بنية صحيحة.',
    'max' => [
        'array' => 'يجب أن لا يحتوي الحقل على أكثر من :max عناصر/عنصر.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :max كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل مساوية أو أصغر لـ :max.',
        'string' => 'يجب أن لا يتجاوز طول نص :max حروفٍ/حرفًا',
    ],
    'max_digits' => 'الحقل يجب ألا يحتوي أكثر من :max أرقام.',
    'mimes' => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'min' => [
        'array' => 'يجب أن يحتوي الحقل على الأقل على :min عُنصرًا/عناصر',
        'file' => 'يجب أن يكون حجم الملف على الأقل :min كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل مساوية أو أكبر لـ :min.',
        'string' => 'يجب أن يكون طول نص على الأقل :min حروفٍ/حرفًا',
    ],
    'min_digits' => 'الحقل يجب أن يحتوي :min أرقام على الأقل.',
    'multiple_of' => 'الحقل يجب أن يكون من مضاعفات :value.',
    'not_in' => 'الحقل لاغٍ',
    'not_regex' => 'الحقل نوعه لاغٍ',
    'numeric' => 'يجب على الحقل أن يكون رقمًا',
    'password' => [
        'letters' => 'يجب ان يشمل حقل على حرف واحد على الاقل.',
        'mixed' => 'يجب ان يشمل حقل على حرف واحد بصيغة كبيرة على الاقل وحرف اخر بصيغة صغيرة.',
        'numbers' => 'يجب ان يشمل حقل على رقم واحد على الاقل.',
        'symbols' => 'يجب ان يشمل حقل على رمز واحد على الاقل.',
        'uncompromised' => 'حقل تبدو غير آمنة. الرجاء اختيار قيمة اخرى.',
    ],
    'present' => 'يجب تقديم الحقل',
    'prohibited' => 'الحقل محظور',
    'prohibited_if' => 'الحقل محظور في حال ما إذا كان :other يساوي :value.',
    'prohibited_unless' => 'الحقل محظور في حال ما لم يكون :other يساوي :value.',
    'prohibits' => 'الحقل يحظر :other من اي يكون موجود',
    'regex' => 'صيغة الحقل .غير صحيحة',
    'required' => 'الحقل مطلوب.',
    'required_array_keys' => 'الحقل يجب ان يحتوي علي مدخلات للقيم التالية :values.',
    'required_if' => 'الحقل مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_if_accepted' => 'The field is required when :other is accepted.',
    'required_unless' => 'الحقل مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with' => 'الحقل إذا توفّر :values.',
    'required_with_all' => 'الحقل إذا توفّر :values.',
    'required_without' => 'الحقل إذا لم يتوفّر :values.',
    'required_without_all' => 'الحقل إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق الحقل مع :other',
    'size' => [
        'array' => 'يجب أن يحتوي الحقل على :size عنصرٍ/عناصر بالظبط',
        'file' => 'يجب أن يكون حجم الملف :size كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل مساوية لـ :size',
        'string' => 'يجب أن يحتوي النص على :size حروفٍ/حرفًا بالظبط',
    ],
    'starts_with' => 'الحقل يجب ان يبدأ بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون الحقل نصآ.',
    'timezone' => 'يجب أن يكون نطاقًا زمنيًا صحيحًا',
    'unique' => 'قيمة الحقل مُستخدمة من قبل',
    'uploaded' => 'فشل في تحميل الـ',
    'uppercase' => 'The must be uppercase.',
    'url' => 'صيغة الرابط غير صحيحة',
    'uuid' => 'الحقل يجب ان ايكون رقم UUID صحيح.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name'                  => 'الاسم',
        'nameEn'                  => 'الاسم بالانجليزي',
        'nameAr'                  => ' الاسم بالعربي',
        'username'              => 'اسم المُستخدم',
        'email'                 => 'البريد الالكتروني',
        'discriptionAr'              => 'الوصـف بالعربي',
        'discriptionAR'              => 'الوصـف بالعربي',
        'discriptionEn'              => 'الوصـف بالانجـليزي',
        'quantity'              => 'الكـميه',
        'categoryId'              => 'الفئه',
        'catID'              => 'الفئه',
        'image'              => 'الصـوره',
        'first_name'            => 'الاسم',
        'last_name'             => 'اسم العائلة',
        'password'              => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city'                  => 'المدينة',
        'country'               => 'الدولة',
        'address'               => 'العنوان',
        'phone'                 => 'الهاتف',
        'mobile'                => 'الجوال',
        'age'                   => 'العمر',
        'sex'                   => 'الجنس',
        'gender'                => 'النوع',
        'day'                   => 'اليوم',
        'month'                 => 'الشهر',
        'year'                  => 'السنة',
        'hour'                  => 'ساعة',
        'minute'                => 'دقيقة',
        'second'                => 'ثانية',
        'content'               => 'المُحتوى',
        'description'           => 'الوصف',
        'excerpt'               => 'المُلخص',
        'date'                  => 'التاريخ',
        'time'                  => 'الوقت',
        'available'             => 'مُتاح',
        'size'                  => 'الحجم',
        'price'                 => 'السعر',
        'desc'                  => 'نبذه',
        'title'                 => 'العنوان',
        'q'                     => 'البحث',
        'link'                  => ' ',
        'slug'                  => ' ',
    ],

];
