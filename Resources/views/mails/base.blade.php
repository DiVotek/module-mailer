<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>@yield("title", config("name"))</title>
        <style>
            @font-face {
                font-family: 'Formular';
                src: url('https://fenix8-laravel.fnx.dp.ua/front/fonts/Formular.ttf');
                font-display: swap;
            }

            @font-face {
                font-family: 'FormularBold';
                src: url('https://fenix8-laravel.fnx.dp.ua/front/fonts/Formular-Bold.ttf');
                font-display: swap;
            }

            @font-face {
                font-family: 'FormularMedium';
                src: url('https://fenix8-laravel.fnx.dp.ua/front/fonts/Formular-Medium.ttf');
                font-display: swap;
            }
        </style>
    </head>
    @php
        use App\Models\Setting;
        $logo = settings(4);
        $logo = json_decode($logo);
        $headerLogo = "/storage" . $logo->header ?? "";
        $phones = settings(6);
        $phones = json_decode($phones ?? "");
        $address = json_decode(settings(8));
        $address = $address->{app("lang")->getDefaultLanguage()} ?? "";
        $schedule = json_decode(settings(9));
        $schedule = $schedule->{app("lang")->getDefaultLanguage()} ?? "";
        $social = settings(7);
        $social = json_decode($social ?? "");
        $name = settings(12);
        $styles = json_decode(settings(18) ?? "", true);
    @endphp

    <body
        style="
            background-color: #f6f6f6;
            color: #333;
            font-family: 'Formular', Helvetica, sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        "
    >
        <table
            class="body"
            border="0"
            cellpadding="0"
            cellspacing="0"
            style="
                border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                width: 100%;
                background: #fff;
                background-size: cover;
            "
        >
            <tr>
                <td>&nbsp;</td>
                <td
                    class="container"
                    style="
                        display: block;
                        margin: 0 auto !important;
                        max-width: 580px;
                        padding: 30px 10px;
                        width: 580px;
                    "
                >
                    <div
                        class="content"
                        style="
                            box-sizing: border-box;
                            display: block;
                            margin: 0 auto;
                            max-width: 560px;
                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
                            border-radius: 5px;
                            overflow: hidden;
                        "
                    >
                        <div
                            id="header"
                            style="
                                clear: both;
                                text-align: center;
                                width: 100%;
                                position: relative;
                                z-index: 1;
                                background: #fff;
                                padding: 20px 0;
                            "
                        >
                            <a href="{{ config("app.url") }}">
                                <x-core.image
                                    :src="$headerLogo"
                                    class="logo"
                                    absolute="true"
                                    style="
                                        border: none;
                                        -ms-interpolation-mode: bicubic;
                                        max-width: 100%;
                                        max-height: 75px;
                                    "
                                    width="100"
                                    height="100"
                                />
                            </a>
                        </div>
                        <table
                            class="main"
                            style="background: #fff; width: 100%"
                        >
                            <tr>
                                <td
                                    class="wrapper"
                                    style="
                                        box-sizing: border-box;
                                        padding: 20px;
                                    "
                                >
                                    <table
                                        border="0"
                                        cellpadding="0"
                                        cellspacing="0"
                                        style="
                                            border-collapse: separate;
                                            mso-table-lspace: 0pt;
                                            mso-table-rspace: 0pt;
                                            width: 100%;
                                        "
                                    >
                                        <tr>
                                            <td>
                                                <div id="body">
                                                    <h4
                                                        style="
                                                            font-size: 24px;
                                                            margin: 0 0 22px;
                                                            text-align: center;
                                                        "
                                                    >
                                                        {!! $title !!}
                                                    </h4>
                                                    @yield("body")
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div
                            class="footer"
                            style="
                                clear: both;
                                text-align: center;
                                width: 100%;
                                background: #fff;
                                position: relative;
                                z-index: 1;
                            "
                        >
                            <table
                                border="0"
                                cellpadding="0"
                                cellspacing="0"
                                style="
                                    border-collapse: separate;
                                    mso-table-lspace: 0pt;
                                    mso-table-rspace: 0pt;
                                    width: 100%;
                                "
                            >
                                <tr>
                                    <td
                                        class="content-block"
                                        colspan="3"
                                        style="
                                            color: #525252;
                                            font-size: 12px;
                                            text-align: center;
                                            padding: 10px;
                                        "
                                    >
                                        <x-core.socials />
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="content-block"
                                        colspan="3"
                                        style="
                                            color: #525252;
                                            font-size: 12px;
                                            text-align: center;
                                            padding: 10px;
                                        "
                                    >
                                        <x-core.phones />
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </body>
</html>
