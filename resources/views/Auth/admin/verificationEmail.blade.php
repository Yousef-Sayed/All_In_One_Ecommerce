<!DOCTYPE html>
@if (Session::get('lang') == 'ar')
    <html lang="{{ Session::get('lang') }}" dir="rtl">
@else
    <html lang="{{ Session::get('lang') }}" dir="ltr">
@endif
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('verifictionEmail/main.css') }}">
    <title>{{ __('words.subjectVervification') }}</title>
</head>
<body>
    <div class="Flex-sc-12n1bmd-0 dyYhBs">
    <div class="Step__Container-sc-1dk5pql-0 iWCkir Flex-sc-12n1bmd-0 dyYhBs" name="email">
        <div class="Step__Header-sc-1dk5pql-1 btnjUF Flex-sc-12n1bmd-0 dyYhBs">
            <span class="Step__Title-sc-1dk5pql-2 dvikSt Text__Font-sc-1pl1mx2-0 hldRYZ" color="slateDark">
                <span>{{ __('words.h1Verifiction') }}</span>
            </span>
        </div>
        <div class="Step__Content-sc-1dk5pql-3 kGDNfS Card-zm8gu9-0 cwXwuQ Flex-sc-12n1bmd-0 jonMIN">
            <div class="ConfirmEmail__Content-sc-1ijmmqy-0 ixzXkk Flex-sc-12n1bmd-0 hiXLVN">
                <div class="ConfirmEmail__VerifyImageContainer-sc-1ijmmqy-1 hpLkdE Flex-sc-12n1bmd-0 fPHrRF">
                    <svg class="ConfirmEmail__Spinner-sc-1ijmmqy-5 irbyrt Circle-cw5xla-0 jvXzrY" width="160" height="160"><circle r="75" cx="80" cy="80" width="160" stroke-width="2.5" fill="rgba(0,0,0,0)" stroke-dasharray="471.23889803846896 471.23889803846896" stroke="#f2802354"></circle><circle r="75" cx="80" cy="80" width="160" stroke-width="2.5" fill="rgba(0,0,0,0)" stroke-dasharray="306.3052837250048 471.23889803846896" stroke="#f28123"></circle></svg><svg class="ConfirmEmail__VerifyImage-sc-1ijmmqy-2 isJriN" xmlns="http://www.w3.org/2000/svg" width="67" height="49" viewBox="0 0 67 49"><g fill="none" fill-rule="evenodd" stroke="#f28123" stroke-linecap="square" stroke-width="2.4"><path d="M9.997 10.309l22.937 18.246 22.938-18.246"></path><path d="M2 6.09v36.82C2 45.167 3.88 47 6.2 47h54.6c2.32 0 4.2-1.832 4.2-4.09V6.09C65 3.833 63.12 2 60.8 2H6.2C3.88 2 2 3.832 2 6.09zm7.997 30.574l8.34-10.137m37.535 10.137l-8.34-10.137"></path></g></svg>
                    </div>
                    <span class="Text__Font-sc-1pl1mx2-0 haKgOL" color="slateDark">
                        <span>{{ __('words.weSent') }} <span class="Text__Font-sc-1pl1mx2-0 bJFRBi" color="slateDark"> {{ $request }}</span>
                        </br> {{ __('words.CheckYourEmail') }}</span>
                    </span>
            </div>
        </div></div>
    </div>
</body>
</html>
