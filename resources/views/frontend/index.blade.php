<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="yandex-verification" content="1e0fa3e23b67d44c" />
        <title>Kit.team</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap&subset=cyrillic" rel="stylesheet">
        <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <header class="u-pt-medium u-pb-medium">
                <div class="container">
                @if (Route::has('login'))
                    <nav class="u-flex u-justify-end">
                        @auth
                        <a class="login active" href="{{ route('cp.index') }}">
                            <img src="/img/login.min.png" alt="Панель управления">
                        </a>
                        @else
                        <a class="login" href="{{ route('login') }}">
                            <img src="/img/login.min.png" alt="Авторизация">
                        </a>
                        @endauth
                    </nav>
                @endif
                </div>
            </header>

            <main>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="esquimau">
                                <img src="/img/esquimau.min.png" alt="Эскимос">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="content">
                                <a class="logo" href="{{ route('index') }}" title="Kit.team">
                                    <img src="/img/logo.min.png" alt="Kit.team">
                                </a>
                                <ul class="skill">
                                    <li>Регистрация доменов</li>
                                    <li>Хостинг</li>
                                    <li>Разработка сайтов</li>
                                    <li>Аудит и доработки по сайту</li>
                                    <li>Разработка дизайна</li>
                                    <li>Реклама в интернете</li>
                                </ul>
                                <ul class="contact">
                                    <li>
                                        <a href="tel:+73513993282" title="Позвонить">+7 (35139) 9-32-82</a>
                                    </li>
                                    <li>
                                        <a href="mailto:hello@kit.team" title="Написать">hello@kit.team</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="u-pt-small u-pb-small">
                <div class="container u-flex u-justify-around">
                    © 2007–2019 ООО «Копейские информационные технологии»
                </div>
            </footer>
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
