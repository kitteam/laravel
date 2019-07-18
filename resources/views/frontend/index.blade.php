<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="yandex-verification" content="1e0fa3e23b67d44c" />
        <title>Kit.team</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                background-image: url('/img/index-bg.png');
                background-repeat: no-repeat;
                background-position: center;
                background-size: contain;
                text-align: center;
                height: 100%;
                width: 100%;
            }

            @media screen and (min-width: 1024px) {
              .content {
                background-size: auto;
              }
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('cp.index') }}">Личный кабинет</a>
                    @else
                        <a href="{{ route('login') }}">Авторизация</a>
                        <a href="{{ route('register') }}">Регистрация</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                {{--
                 <div class="title m-b-md">
                 {{ config('app.name', 'Laravel') }}
                 </div>
                   --}}
            </div>
        </div>
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(48762848, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/48762848" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
        <script>
            window.replainSettings = { id: 'ddc7e056-95b4-418f-86ab-200c83e777f3' };
            (function(u){var s=document.createElement('script');s.type='text/javascript';s.async=true;s.src=u;
            var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
            })('https://widget.replain.cc/dist/client.js');
        </script>
    </body>
</html>
